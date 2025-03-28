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
    public $fr_title, $en_title, $fr_description, $en_description, $is_active, $image, $existingImage;

    public function mount(Plan $plan)
    {
        $this->plan = $plan;
        $this->fr_title = $plan->fr_title;
        $this->en_title = $plan->en_title;
        $this->fr_description = $plan->fr_description;
        $this->en_description = $plan->en_description;
        $this->is_active = $plan->published_at ? true : false; // Si published_at existe, is_active est true
        $this->existingImage = $plan->image;
    }

    protected function rules()
    {
        return [
            'fr_title' => ['required', 'string', 'min:2', 'unique:plans,fr_title,' . $this->plan->id],
            'en_title' => ['required', 'string', 'min:2', 'unique:plans,en_title,' . $this->plan->id],
            'fr_description' => ['required', 'string', 'min:10'],
            'en_description' => ['required', 'string', 'min:10'],
            'is_active' => ['boolean'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    public function updatePlan()
    {
        $data = $this->validate();

        $this->plan->update([
            'fr_title' => $this->fr_title,
            'en_title' => $this->en_title,
            'slug' => Str::slug($this->en_title),
            'fr_description' => $this->fr_description,
            'en_description' => $this->en_description,
            'published_at' => $this->is_active ? ($this->plan->published_at ?? now()) : null,
        ]);

        if ($this->image) {
            // Supprimer l'image existante si elle existe
            if ($this->existingImage) {
                Storage::disk('public')->delete($this->existingImage);
            }
            $filename = 'plan_' . Str::slug($this->fr_title) . '_' . time() . '.' . $this->image->getClientOriginalExtension();
            $path = $this->image->storeAs('plans/images', $filename, 'public');
            $this->plan->update(['image' => $path]);
        }

        session()->flash('success', __('Plan mis à jour avec succès !'));
        return redirect()->route('admin.plans.index');
    }

    public function render()
    {
        return view('livewire.admin.edit-plan');
    }
}
