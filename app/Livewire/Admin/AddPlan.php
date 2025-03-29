<?php

namespace App\Livewire\Admin;

use App\Models\Plan;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class AddPlan extends Component
{
    use WithFileUploads;

    public $fr_title, $en_title, $fr_description, $en_description, $is_active = false;
    public $images = []; // Tableau pour stocker plusieurs images

    protected function rules()
    {
        return [
            'fr_title' => ['required', 'string', 'min:2', 'unique:plans,fr_title'],
            'en_title' => ['required', 'string', 'min:2', 'unique:plans,en_title'],
            'fr_description' => ['required', 'string', 'min:10'],
            'en_description' => ['required', 'string', 'min:10'],
            'is_active' => ['boolean'],
            'images.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Validation pour chaque image
        ];
    }

    public function addPlan()
    {
        $data = $this->validate();

        // Création du plan
        $plan = Plan::create([
            'fr_title' => $this->fr_title,
            'en_title' => $this->en_title,
            'slug' => Str::slug($this->en_title),
            'fr_description' => $this->fr_description,
            'en_description' => $this->en_description,
            'published_at' => $this->is_active ? now() : null,
            'user_id' => Auth::user()->id,
        ]);

        // Gestion des images multiples
        if (!empty($this->images)) {
            foreach ($this->images as $index => $image) {
                $filename = 'plan_' . Str::slug($plan->fr_title) . '_' . time() . '_' . $index . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('plans/images', $filename, 'public');

                $plan->images()->create([
                    'name' => $path,
                    'original_name' => $image->getClientOriginalName(),
                ]);
            }
        }

        session()->flash('success', __('Plan créé avec succès !'));
        return redirect()->route('admin.plans.index');
    }

    // Méthode pour supprimer une image de la prévisualisation
    public function removeImage($index)
    {
        if (isset($this->images[$index])) {
            unset($this->images[$index]);
            $this->images = array_values($this->images); // Réindexer le tableau
        }
    }

    public function render()
    {
        return view('livewire.admin.add-plan');
    }
}
