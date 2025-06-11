<?php

namespace App\Jobs;

use App\Mail\NewsletterMail;
use App\Models\Newsletter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;

class SendNewsletterBatchJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * La newsletter à envoyer.
     *
     * @var \App\Models\Newsletter
     */
    protected $newsletter;

    /**
     * La collection d'abonnés à qui envoyer la newsletter.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $subscribers;

    /**
     * Le nombre de tentatives pour ce job.
     *
     * @var int
     */
    public $tries = 3;

    /**
     * Créer une nouvelle instance du job.
     *
     * @param  \App\Models\Newsletter  $newsletter
     * @param  \Illuminate\Support\Collection  $subscribers
     * @return void
     */
    public function __construct(Newsletter $newsletter, Collection $subscribers)
    {
        $this->newsletter = $newsletter;
        $this->subscribers = $subscribers;
    }

    /**
     * Exécuter le job.
     *
     * @return void
     */
    public function handle()
    {
        $sentCount = 0;

        foreach ($this->subscribers as $subscriber) {
            try {
                Mail::to($subscriber->email)
                    ->send(new NewsletterMail($this->newsletter, $subscriber));

                $sentCount++;
            } catch (\Exception $e) {
                // Enregistrer l'erreur mais continuer avec les autres abonnés
                \Log::error('Failed to send newsletter to ' . $subscriber->email . ': ' . $e->getMessage());
            }
        }

        // Si c'est le dernier lot, marquer la newsletter comme envoyée
        if ($this->isLastBatch()) {
            $this->newsletter->update([
                'status' => Newsletter::STATUS_SENT,
                'sent_at' => now()
            ]);
        }
    }

    /**
     * Vérifier si c'est le dernier lot d'envoi.
     *
     * @return bool
     */
    protected function isLastBatch(): bool
    {
        // Cette méthode est simplifiée et pourrait être améliorée
        // pour une vérification plus précise du dernier lot
        return $this->newsletter->isSending() &&
               !SendNewsletterBatchJob::withChain([])
                   ->allOnQueue($this->queue)
                   ->count();
    }
}
