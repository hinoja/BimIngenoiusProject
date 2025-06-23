<?php

namespace App\Jobs;

use App\Models\Newsletter;
use App\Models\Subscriber;
use App\Notifications\NewsletterNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class SendNewsletterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $newsletter;

    /**
     * Create a new job instance.
     */
    public function __construct(Newsletter $newsletter)
    {
        $this->newsletter = $newsletter;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Marquer la newsletter comme en cours d'envoi
            $this->newsletter->update(['status' => Newsletter::STATUS_SENDING]);

            // Récupérer tous les abonnés actifs
            $subscribers = Subscriber::where('status', 'active')->get();
            
            // Compter les abonnés
            $count = $subscribers->count();
            
            if ($count > 0) {
                // Envoyer la newsletter à tous les abonnés
                Notification::send($subscribers, new NewsletterNotification($this->newsletter));
                
                // Mettre à jour la newsletter
                $this->newsletter->update([
                    'status' => Newsletter::STATUS_SENT,
                    'sent_at' => now(),
                    'recipients_count' => $count
                ]);
                
                // Enregistrer les abonnés qui ont reçu cette newsletter
                $this->newsletter->subscribers()->attach(
                    $subscribers->pluck('id')->toArray(),
                    ['status' => 'sent', 'created_at' => now(), 'updated_at' => now()]
                );
            } else {
                $this->newsletter->update([
                    'status' => Newsletter::STATUS_FAILED,
                    'recipients_count' => 0
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error sending newsletter: ' . $e->getMessage());
            
            // Marquer la newsletter comme échouée
            $this->newsletter->update(['status' => Newsletter::STATUS_FAILED]);
            
            throw $e;
        }
    }
}

