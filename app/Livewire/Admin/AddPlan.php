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

    public $fr_title, $en_title, $fr_description, $en_description, $is_active = false, $image;

    protected function rules()
    {
        return [
            'fr_title' => ['required', 'string', 'min:2', 'unique:plans,fr_title'],
            'en_title' => ['required', 'string', 'min:2', 'unique:plans,en_title'],
            'fr_description' => ['required', 'string', 'min:10'],
            'en_description' => ['required', 'string', 'min:10'],
            'is_active' => ['boolean'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    public function addPlan()
    {
        $data = $this->validate();

        $plan = Plan::create([
            'fr_title' => $this->fr_title,
            'en_title' => $this->en_title,
            'slug' => Str::slug($this->en_title),
            'fr_description' => $this->fr_description,
            'en_description' => $this->en_description,
            'published_at' => $this->is_active ? now() : null,
            'user_id' => Auth::user()->id, // Ajout de l'utilisateur connecté
        ]);

        if ($this->image) {
            $filename = 'plan_' . Str::slug($plan->fr_title) . '_' . time() . '.' . $this->image->getClientOriginalExtension();
            $path = $this->image->storeAs('plans/images', $filename, 'public');

            $plan->images()->create([
                'name' => $path,
                'original_name' => $this->image->getClientOriginalName(),
            ]);
        }

        session()->flash('success', __('Plan créé avec succès !'));
        return redirect()->route('admin.plans.index');
    }

    public function render()
    {
        return view('livewire.admin.add-plan');
    }
}
