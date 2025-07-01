<?php

namespace App\Livewire\Admin;

use App\Models\Plan;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class EditPlan extends Component
{
    use WithFileUploads;

    public $plan;
    public $fr_title, $en_title, $fr_description, $en_description, $is_active;
    public $image2D; // Nouvelle image 2D
    public $images = []; // Nouvelles images 3D
    public $existing2DImage; // Image 2D existante
    public $existing3DImages = []; // Images 3D existantes
    public $imagesToDelete = []; // Images à supprimer
    public $step = 1; // Suivi des étapes

    public function mount(Plan $plan)
    {
        $this->plan = $plan;
        $this->fr_title = $plan->fr_title;
        $this->en_title = $plan->en_title;
        $this->fr_description = $plan->fr_description;
        $this->en_description = $plan->en_description;
        $this->is_active = $plan->published_at ? true : false;
        $this->loadExistingImages();
    }

    protected function loadExistingImages()
    {
        $allImages = $this->plan->images;
        foreach ($allImages as $image) {
            if ($image->type === '2d' || (isset($image->is_2d) && $image->is_2d)) {
                $this->existing2DImage = [
                    'id' => $image->id,
                    'path' => $image->name,
                    'original_name' => $image->original_name ?? 'Image 2D'
                ];
            } else {
                $this->existing3DImages[] = [
                    'id' => $image->id,
                    'path' => $image->name,
                    'original_name' => $image->original_name ?? 'Image 3D'
                ];
            }
        }
    }

    protected function rules()
    {
        return [
            'fr_title' => ['required', 'string', 'min:2', 'unique:plans,fr_title,' . $this->plan->id],
            'en_title' => ['required', 'string', 'min:2', 'unique:plans,en_title,' . $this->plan->id],
            'fr_description' => ['required', 'string', 'min:50'],
            'en_description' => ['required', 'string', 'min:50'],
            'is_active' => ['boolean'],
            'image2D' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'images.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    public function nextStep()
    {
        $this->validate([
            'fr_title' => ['required', 'string', 'min:2', 'unique:plans,fr_title,' . $this->plan->id],
            'en_title' => ['required', 'string', 'min:2', 'unique:plans,en_title,' . $this->plan->id],
            'fr_description' => 'required|string|min:50',
            'en_description' => 'required|string|min:50',
        ]);
        $this->step = 2;
    }

    public function previousStep()
    {
        $this->step = 1;
    }

    public function updatePlan()
    {
        $this->validate();

        try {
            $this->plan->update([
                'fr_title' => $this->fr_title,
                'en_title' => $this->en_title,
                'slug' => Str::slug($this->en_title) . '-' . uniqid(),
                'fr_description' => $this->fr_description,
                'en_description' => $this->en_description,
                'published_at' => $this->is_active ? now() : null,
                'user_id' => Auth::id(),
            ]);

            $this->handleImageDeletions();
            $this->handleNew2DImage();
            $this->handleNew3DImages();

            session()->flash('success', __('Plan updated successfully!'));
            return redirect()->route('admin.plans.index');
        } catch (\Exception $e) {
            Log::error('Error updating plan: ' . $e->getMessage());
            session()->flash('error', __('Error updating plan: ') . $e->getMessage());
        }
    }

    protected function handleImageDeletions()
    {
        if (!empty($this->imagesToDelete)) {
            foreach ($this->plan->images as $image) {
                if (in_array($image->id, $this->imagesToDelete)) {
                    if (Storage::disk('public')->exists($image->name)) {
                        Storage::disk('public')->delete($image->name);
                    }
                    $image->delete();
                }
            }
        }
    }

    protected function handleNew2DImage()
    {
        if ($this->image2D) {
            if ($this->existing2DImage && !in_array($this->existing2DImage['id'], $this->imagesToDelete)) {
                $oldImage = $this->plan->images()->find($this->existing2DImage['id']);
                if ($oldImage && Storage::disk('public')->exists($oldImage->name)) {
                    Storage::disk('public')->delete($oldImage->name);
                    $oldImage->delete();
                }
            }

            $filename = 'plan_2D_' . Str::slug($this->en_title) . '_' . uniqid() . '.' . $this->image2D->getClientOriginalExtension();
            $path = $this->image2D->storeAs('plans/images/2D', $filename, 'public');

            $this->plan->images()->create([
                'name' => $path,
                'original_name' => $this->image2D->getClientOriginalName(),
                'type' => '2d',
            ]);
        }
    }

    protected function handleNew3DImages()
    {
        if (!empty($this->images)) {
            foreach ($this->images as $image) {
                $filename = 'plan_3D_' . Str::slug($this->en_title) . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('plans/images/3D', $filename, 'public');
                $this->plan->images()->create([
                    'name' => $path,
                    'original_name' => $image->getClientOriginalName(),
                    'type' => '3d',
                ]);
            }
        }
    }

    public function removeExisting2DImage($imageId)
    {
        if (!in_array($imageId, $this->imagesToDelete)) {
            $this->imagesToDelete[] = $imageId;
        }
        $this->existing2DImage = null;
    }

    public function removeExisting3DImage($imageId)
    {
        if (!in_array($imageId, $this->imagesToDelete)) {
            $this->imagesToDelete[] = $imageId;
        }
        $this->existing3DImages = array_filter($this->existing3DImages, fn($img) => $img['id'] !== $imageId);
        $this->existing3DImages = array_values($this->existing3DImages);
    }

    public function removeNew2DImage()
    {
        $this->image2D = null;
    }

    public function removeImage($index)
    {
        if (isset($this->images[$index])) {
            unset($this->images[$index]);
            $this->images = array_values($this->images);
        }
    }

    public function render()
    {
        return view('livewire.admin.edit-plan');
    }
}
