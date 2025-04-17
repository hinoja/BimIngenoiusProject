<?php

namespace App\Livewire\Admin;

use App\Models\Plan;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AddPlan extends Component
{
    use WithFileUploads;

    public $fr_title, $en_title, $fr_description, $en_description, $is_active = false;
    public $image2D; // Single 2D image
    public $images = []; // Multiple 3D images
    public $step = 1; // Two-step form tracker

    protected function rules()
    {
        return [
            'fr_title' => ['required', 'string', 'min:2', 'unique:plans,fr_title'],
            'en_title' => ['required', 'string', 'min:2', 'unique:plans,en_title'],
            'fr_description' => ['required', 'string', 'min:10'],
            'en_description' => ['required', 'string', 'min:10'],
            'is_active' => ['boolean'],
            'image2D' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'images.*' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    public function nextStep()
    {
        $this->validate([
           'fr_title' => ['required', 'string', 'min:2', 'unique:plans,fr_title'],
            'en_title' => ['required', 'string', 'min:2', 'unique:plans,en_title'],
            'fr_description' => 'required|string|min:10',
            'en_description' => 'required|string|min:10',
        ]);
        $this->step = 2;
    }

    public function previousStep()
    {
        $this->step = 1;
    }

    public function addPlan()
    {
        $this->validate();


        try {
            // Process 2D image first
            $image2DName = 'plan_2D_' . Str::slug($this->en_title) . '_' . uniqid() . '.' . $this->image2D->getClientOriginalExtension();
            $image2DPath = $this->image2D->storeAs('plans/images/2D', $image2DName, 'public');

            // Create plan with image2D
            $plan = Plan::create([
                'fr_title' => $this->fr_title,
                'en_title' => $this->en_title,
                'slug' => Str::slug($this->en_title) . '-' . uniqid(),
                'fr_description' => $this->fr_description,
                'en_description' => $this->en_description,
                'published_at' => $this->is_active ? now() : null,
                'user_id' => Auth::id(),
                'image2D' => $image2DPath // Include image2D path in initial creation
            ]);
            // Process 3D images if any
            if ($this->images) {
                foreach ($this->images as $image) {
                    $filename = 'plan_' . Str::slug($plan->fr_title) . '_' . time() . '_' . $image->getClientOriginalName();
                    $path = $image->storeAs('plans/images/3D', $filename, 'public');
                    $plan->images()->create([
                        'name' => $path,
                        'original_name' => $image->getClientOriginalName(),
                    ]);
                }
            }

            // // Process 3D images if any
            // if (!empty($this->images)) {
            //     $imagePaths = [];
            //     foreach ($this->images as $index => $image) {
            //         $filename = sprintf(
            //             'plan_3D_%s_%s_%d.%s',
            //             Str::slug($plan->fr_title),
            //             uniqid(),
            //             $index + 1,
            //             $image->getClientOriginalExtension()
            //         );
            //         $path = $image->storeAs('plans/images/3D', $filename, 'public');
            //         $imagePaths[] = $path;
            //     }
            //     $plan->update(['images' => json_encode($imagePaths)]);
            // }

            session()->flash('success', __('Plan created successfully!'));
            return redirect()->route('admin.plans.index');
        } catch (\Exception $e) {
            session()->flash('error', __('Error creating plan: ') . $e->getMessage());
            return null;
        }
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
        return view('livewire.admin.add-plan');
    }
}
