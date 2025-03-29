<?php

namespace App\Livewire\Admin;

use App\Models\Plan;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditPlan extends Component
{
    use WithFileUploads;

    public $plan;
    public $fr_title, $en_title, $fr_description, $en_description, $published_at;
    public $images = []; // Nouvelles images à uploader
    public $existingImages = []; // Images actuelles du plan
    public $imagesToDelete = []; // Images marquées pour suppression

    public function mount(Plan $plan)
    {
        $this->plan = $plan;
        $this->fr_title = $plan->fr_title;
        $this->en_title = $plan->en_title;
        $this->fr_description = $plan->fr_description;
        $this->en_description = $plan->en_description;
        $this->published_at = $plan->published_at ? true : false;
        $this->existingImages = $plan->images->toArray(); // Charger les images existantes
    }

    protected function rules()
    {
        return [
            'fr_title' => ['required', 'string', 'min:2', 'unique:plans,fr_title,' . $this->plan->id],
            'en_title' => ['required', 'string', 'min:2', 'unique:plans,en_title,' . $this->plan->id],
            'fr_description' => ['required', 'string', 'min:10'],
            'en_description' => ['required', 'string', 'min:10'],
            'published_at' => ['boolean'],
            'images.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    public function updatePlan()
    {
        $data = $this->validate();

        // Mise à jour des champs principaux
        $this->plan->update([
            'fr_title' => $this->fr_title,
            'en_title' => $this->en_title,
            'slug' => Str::slug($this->en_title),
            'fr_description' => $this->fr_description,
            'en_description' => $this->en_description,
            'published_at' => $this->published_at ? ($this->plan->published_at ?? now()) : null,
        ]);

        // Suppression des images marquées
        if (!empty($this->imagesToDelete)) {
            foreach ($this->plan->images as $image) {
                if (in_array($image->id, $this->imagesToDelete)) {
                    Storage::disk('public')->delete($image->name);
                    $image->delete();
                }
            }
            $this->existingImages = array_filter($this->existingImages, fn($img) => !in_array($img['id'], $this->imagesToDelete));
        }

        // Ajout des nouvelles images
        if (!empty($this->images)) {
            foreach ($this->images as $index => $image) {
                $filename = 'plan_' . Str::slug($this->fr_title) . '_' . time() . '_' . $index . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('plans/images', $filename, 'public');

                $this->plan->images()->create([
                    'name' => $path,
                    'original_name' => $image->getClientOriginalName(),
                ]);
            }
        }

        session()->flash('success', __('Plan mis à jour avec succès !'));
        return redirect()->route('admin.plans.index');
    }

    // Supprimer une image existante (avant soumission)
    public function removeExistingImage($imageId)
    {
        $this->imagesToDelete[] = $imageId;
    }

    // Supprimer une nouvelle image de la prévisualisation
    public function removeNewImage($index)
    {
        if (isset($this->images[$index])) {
            unset($this->images[$index]);
            $this->images = array_values($this->images); // Réindexer le tableau
        }
    }

    public function render()
    {
        return view('livewire.admin.edit-plan');
    }
}
