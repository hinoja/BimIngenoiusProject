<?php


namespace App\Livewire\Admin;

use App\Models\Project;
use Livewire\Component;
use App\Enums\SizeEnums;
use App\Models\Category;
use App\Enums\StatusEnums;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditProject extends Component
{
    use WithFileUploads;

    public $project;
    public $fr_title, $en_title, $fr_description, $en_description, $company, $country, $city, $address, $status, $size, $start_date, $end_date, $category_id;
    public $images = [];
    public $existingImages = [];
    public $step = 1;
    public $totalSteps = 4;

    public function mount(Project $project)
    {
        $this->project = $project;
        $this->fr_title = $project->fr_title;
        $this->en_title = $project->en_title;
        $this->fr_description = $project->fr_description;
        $this->en_description = $project->en_description;
        $this->company = $project->company;
        $this->country = $project->country;
        $this->city = $project->city;
        $this->address = $project->address;
        $this->status = $project->status;
        $this->size = $project->size;
        $this->start_date = $project->start_date->format('Y-m-d');
        $this->end_date = $project->end_date->format('Y-m-d');
        $this->category_id = $project->category_id;
        $this->existingImages = $project->images->toArray();
    }

    protected function rules()
    {
        return [
            'fr_title' => ['required', 'string', 'min:2', 'unique:projects,fr_title,' . $this->project->id],
            'en_title' => ['required', 'string', 'min:2', 'unique:projects,en_title,' . $this->project->id],
            'fr_description' => ['required', 'string', 'min:10'],
            'en_description' => ['required', 'string', 'min:10'],
            'company' => ['required', 'string', 'min:2'],
            'country' => ['required', 'string', 'min:2'],
            'city' => ['required', 'string', 'min:2'],
            'address' => ['required', 'string', 'min:5'],
            'status' => ['required', 'in:' . implode(',', array_map(fn($status) => $status->value, StatusEnums::cases()))],
            'size' => ['required', 'in:' . implode(',', array_map(fn($size) => $size->value, SizeEnums::cases()))],
            'start_date' => ['required', 'date', 'before_or_equal:end_date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'category_id' => ['required', 'exists:categories,id'],
            'images' => ['nullable', 'array'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    public function nextStep()
    {
        if ($this->step == 1) {
            $this->validateOnlyFields(['fr_title', 'en_title', 'fr_description', 'en_description']);
        } elseif ($this->step == 2) {
            $this->validateOnlyFields(['company', 'country', 'city', 'address']);
        } elseif ($this->step == 3) {
            $this->validateOnlyFields(['status', 'size', 'start_date', 'end_date', 'category_id']);
        }
        if ($this->step < $this->totalSteps) {
            $this->step++;
        }
    }

    public function previousStep()
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    public function updateProject()
    {
        $data = $this->validate();
        $this->project->update([
            'fr_title' => $this->fr_title,
            'en_title' => $this->en_title,
            'slug' => Str::slug($this->en_title),
            'fr_description' => $this->fr_description,
            'en_description' => $this->en_description,
            'company' => $this->company,
            'country' => $this->country,
            'city' => $this->city,
            'address' => $this->address,
            'status' => $this->status,
            'size' => $this->size,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'category_id' => $this->category_id,
        ]);

        if ($this->images) {
            foreach ($this->images as $image) {
                $filename = 'project_' . Str::slug($this->project->fr_title) . '_' . time() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs('projects/images', $filename, 'public');
                $this->project->images()->create([
                    'name' => $path,
                    'original_name' => $image->getClientOriginalName(),
                ]);
            }
        }

        session()->flash('success', __('Project updated successfully!'));
        return redirect()->route('admin.projects.index');
    }

    public function removeImage($index)
    {
        unset($this->images[$index]);
        $this->images = array_values($this->images);
    }

    public function deleteExistingImage($imageId)
    {
        $image = $this->project->images()->find($imageId);
        if ($image) {
            Storage::disk('public')->delete($image->name);
            $image->delete();
            $this->existingImages = array_filter($this->existingImages, fn($img) => $img['id'] !== $imageId);
        }
    }

    private function validateOnlyFields(array $fields)
    {
        $rules = array_intersect_key($this->rules(), array_flip($fields));
        $this->validate($rules);
    }

    public function render()
    {
        return view('livewire.admin.edit-project', [
            'categories' => Category::query()->orderBy('name')->get(),
            'statuses' => StatusEnums::cases(),
            'sizes' => SizeEnums::cases(),
        ]);
    }
}
