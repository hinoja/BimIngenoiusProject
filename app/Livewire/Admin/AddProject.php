<?php

namespace App\Livewire\Admin;

use App\Models\Tag;
use App\Models\Plan;
use App\Models\Project;
use Livewire\Component;
use App\Enums\SizeEnums;
use App\Models\Category;
use App\Enums\StatusEnums;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class AddProject extends Component
{
    use WithFileUploads;

    public $fr_title, $en_title, $fr_description, $en_description, $country, $city, $address, $status, $size, $start_date, $end_date, $category_id, $plan_id;
    public $images = [];
    public $selectedTags = [];
    public $step = 1;
    public $totalSteps = 5;

    protected function rules()
    {
        return [
            'fr_title' => ['required', 'string', 'min:2', 'unique:projects,fr_title'],
            'en_title' => ['required', 'string', 'min:2', 'unique:projects,en_title'],
            'fr_description' => ['required', 'string', 'min:10'],
            'en_description' => ['required', 'string', 'min:10'],
            'country' => ['required', 'string', 'min:2'],
            'city' => ['required', 'string', 'min:2'],
            'address' => ['required', 'string', 'min:5'],
            'status' => ['required', 'in:' . implode(',', array_map(fn($status) => $status->value, StatusEnums::cases()))],
            'size' => ['required', 'in:' . implode(',', array_map(fn($size) => $size->value, SizeEnums::cases()))],
            'start_date' => ['required', 'date', 'before_or_equal:end_date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'category_id' => ['required', 'exists:categories,id'],
            'plan_id' => ['nullable', 'exists:plans,id' ],
            'images' => ['nullable', 'array'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    public function nextStep()
    {
        if ($this->step == 1) {
            $this->validateOnlyFields(['fr_title', 'en_title', 'fr_description', 'en_description']);
        } elseif ($this->step == 2) {
            $this->validateOnlyFields(['country', 'city', 'address']);
        } elseif ($this->step == 3) {
            $this->validateOnlyFields(['status', 'size', 'start_date', 'end_date', 'category_id', 'plan_id']);
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

    public function updatedStatus($value)
    {
        // Réinitialiser plan_id si le statut n'est pas Idea
        if ($value !== StatusEnums::Idea->value) {
            $this->plan_id = null;
        }
    }

    public function addProject()
    {
        $data = $this->validate();

        $project = Project::create([
            'fr_title' => $this->fr_title,
            'en_title' => $this->en_title,
            'slug' => Str::slug($this->en_title),
            'fr_description' => $this->fr_description,
            'en_description' => $this->en_description,
            'country' => $this->country,
            'city' => $this->city,
            'address' => $this->address,
            'status' => $this->status,
            'size' => $this->size,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'category_id' => $this->category_id,
            'plan_id' => $this->status === StatusEnums::Idea->value ? $this->plan_id : null,
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

        if ($this->selectedTags) {
            $project->tags()->attach($this->selectedTags);
        }

        session()->flash('success', __('A project created with success!'));
        $this->dispatch('project-created', message: __('A project created with success!'));
        return redirect()->route('admin.projects.index');
    }

    public function removeImage($index)
    {
        unset($this->images[$index]);
        $this->images = array_values($this->images);
    }

    private function validateOnlyFields(array $fields)
    {
        $rules = array_intersect_key($this->rules(), array_flip($fields));
        $this->validate($rules);
    }

    public function render()
    {
        return view('livewire.admin.add-project', [
            'categories' => Category::query()->orderBy('fr_name', 'asc')->get(),
            'statuses' => StatusEnums::cases(),
            'sizes' => SizeEnums::cases(),
            'tags' => Tag::query(['id', 'name'])->get(),
            'plans' => Plan::query()->select('id', app()->getLocale() . '_title as title')->orderBy('created_at')->get(),
        ]);
    }
}
