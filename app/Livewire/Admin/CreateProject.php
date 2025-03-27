<?php

namespace App\Livewire\Admin;

use App\Models\Project;
use Livewire\Component;
use App\Enums\SizeEnums;
use App\Models\Category;
use App\Enums\StatusEnums;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class CreateProject extends Component
{
    use WithFileUploads;

    public $fr_title, $en_title, $fr_description, $en_description, $company, $country, $city, $address, $status, $size, $start_date, $end_date, $category_id;
    public $images = [];

    protected function rules()
    {
        return [
            'fr_title' => ['required', 'string', 'min:2', 'unique:projects,fr_title'],
            'en_title' => ['required', 'string', 'min:2', 'unique:projects,en_title'],
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

    public function addProject()
    {
        $this->validate();

        $project = Project::create([
            'fr_title' => $this->fr_title,
            'en_title' => $this->en_title,
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
                $filename = 'project_' . Str::slug($project->fr_title) . '_' . time() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs('projects/images', $filename, 'public');
                $project->images()->create([
                    'name' => $path,
                    'original_name' => $image->getClientOriginalName(),
                ]);
            }
        }

        session()->flash('success', __('Project created successfully!'));
        return redirect()->route('admin.projects.index');
    }

    public function render()
    {
        return view('livewire.admin.create-project', [
            'categories' => Category::orderBy('name')->get(),
            'statuses' => StatusEnums::cases(),
            'sizes' => SizeEnums::cases(),
        ]);
    }
}
