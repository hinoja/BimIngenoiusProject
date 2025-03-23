<?php

namespace App\Livewire\Admin;

use Carbon\Carbon;
use App\Models\Project;
use Livewire\Component;
use App\Enums\SizeEnums;
use App\Models\Category;
use App\Enums\StatusEnums;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ManageProjets extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $fr_title, $en_title, $fr_description, $en_description, $company, $country, $city, $address, $status, $size, $start_date, $end_date, $category_id;
    public $selectedProjectId, $deleteId, $selectedProject;
    public $isEditing = false;
    public $images = []; // Pour l'upload des nouvelles images
    public $existingImages = []; // Pour stocker les images existantes lors de l'édition



    protected function rules()
    {
        return [
            'fr_title' => ['required', 'string', 'min:2', $this->isEditing ? 'unique:projects,fr_title,' . $this->selectedProjectId : 'unique:projects,fr_title'],
            'en_title' => ['required', 'string', 'min:2', $this->isEditing ? 'unique:projects,en_title,' . $this->selectedProjectId : 'unique:projects,en_title'],
            'fr_description' => ['required', 'string', 'min:10'],
            'en_description' => ['required', 'string', 'min:10'],
            'company' => ['required', 'string', 'min:2'],
            'country' => ['required', 'string', 'min:2'],
            'city' => ['required', 'string', 'min:2'],
            'address' => ['required', 'string', 'min:5'],
            'status' => ['required', 'in:' . implode(',', array_map(fn($status) => $status->value, StatusEnums::cases()))],
            'size' => ['required', 'in:' . implode(',', array_map(fn($size) => $size->value, SizeEnums::cases()))],
            'start_date' => [
                'required',
                'date',
                'before_or_equal:end_date',
                function ($attribute, $value, $fail) {
                    try {
                        if (Carbon::parse($value)->isBefore(now()->subYears(10))) {
                            $fail(__('The start date cannot be older than 10 years'));
                        }
                    } catch (\Exception $e) {
                        $fail(__('Invalid date format'));
                    }
                }
            ],
            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date',
                function ($attribute, $value, $fail) {
                    try {
                        if (Carbon::parse($value)->isAfter(now()->addYears(5))) {
                            $fail(__('The end date cannot be more than 5 years in the future'));
                        }
                    } catch (\Exception $e) {
                        $fail(__('Invalid date format'));
                    }
                }
            ],
            'category_id' => ['required', 'exists:categories,id'],
            'images' => ['nullable', 'array'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    protected $messages = [
        'fr_title.required' => 'Le titre en français est obligatoire',
        'fr_title.unique' => 'Ce titre en français existe déjà',
        'en_title.required' => 'Le titre en anglais est obligatoire',
        'en_title.unique' => 'Ce titre en anglais existe déjà',
        'fr_description.required' => 'La description en français est obligatoire',
        'en_description.required' => 'La description en anglais est obligatoire',
        'company.required' => 'Le nom de l\'entreprise est obligatoire',
        'country.required' => 'Le pays est obligatoire',
        'city.required' => 'La ville est obligatoire',
        'address.required' => 'L\'adresse est obligatoire',
        'status.required' => 'Le statut est obligatoire',
        'size.required' => 'La taille est obligatoire',
        'start_date.required' => 'La date de début est obligatoire',
        'end_date.required' => 'La date de fin est obligatoire',
        'category_id.required' => 'La catégorie est obligatoire',
        'images.*.image' => 'Le fichier doit être une image',
        'images.*.mimes' => 'L\'image doit être au format : jpeg, png, jpg, gif',
        'images.*.max' => 'L\'image ne doit pas dépasser 2 Mo',
    ];



    public function closeModal()
    {

        $this->resetForm();
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatch('closeModal');
    }

    public function showCreateForm()
    {
        $this->isEditing = false;
        $this->resetForm();
        $this->dispatch('openModal');
    }

    public function showEditForm($id)
    {
        $project = Project::with('images')->findOrFail($id);
        $this->isEditing = true;
        $this->selectedProjectId = $project->id;
        $this->fr_title = $project->fr_title;
        $this->en_title = $project->en_title;
        $this->fr_description = $project->fr_description;
        $this->en_description = $project->en_description;
        $this->company = $project->company;
        $this->country = $project->country;
        $this->city = $project->city;
        $this->address = $project->address;
        $this->status = $project->status->value;
        $this->size = $project->size->value;
        $this->start_date = $project->start_date->format('Y-m-d');
        $this->end_date = $project->end_date->format('Y-m-d');
        $this->category_id = $project->category_id;
        $this->existingImages = $project->images->toArray();
        $this->dispatch('openEditModal');
    }

    public function showDetails($id)
    {
        $this->selectedProject = Project::with(['category', 'images'])->findOrFail($id);
        $this->dispatch('openDetailsModal');
    }

    public function addProject()
    {
        try {
            // Validation des données
            $this->validate();

            // Création du projet
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
            // Enregistrement des images
            if ($this->images) {
                foreach ($this->images as $image) {
                    $filename = 'project_' . Str::slug($project->fr_title) . '_' . time() . '_' . $image->getClientOriginalName();
                    $path = $image->storeAs('projects/images', $filename, 'public');

                    $project->images()->create([
                        'name' => $path,
                        'original_name' => $image->getClientOriginalName()
                    ]);
                    // $project->images()->create([
                    //     'name' => $path, // Correction : utilisation de 'name' au lieu de 'path'
                    //     'imageable_type' => Project::class,
                    //     'imageable_id' => $project->id,
                    // ]);
                }
            }


            // Notification de succès
            $this->dispatch('notify', [
                'type' => 'success',
                'icon' => 'check-circle',
                'title' => __('Success'),
                'message' => __('Project created successfully!'),
            ]);

            // Fermeture du modal
            $this->closeModal();
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Gestion des erreurs de validation
            $this->dispatch('notify', [
                'type' => 'error',
                'icon' => 'exclamation-triangle',
                'title' => __('Validation Error'),
                'message' => __('Please check the form for errors.'),
            ]);
        } catch (\Exception $e) {
            // Gestion des autres erreurs
            $this->dispatch('notify', [
                'type' => 'error',
                'icon' => 'exclamation-triangle',
                'title' => __('Error'),
                'message' => __('An error occurred: ') . $e->getMessage(),
            ]);
        }
    }
    public function notify($type, $message)
    {
        $this->dispatch('showToast', $type, $message);
    }

    public function updateProject()
    {
        try {
            $this->rules['fr_title'] = ['required', 'string', 'min:2', 'unique:projects,fr_title,' . $this->selectedProjectId];
            $this->rules['en_title'] = ['required', 'string', 'min:2', 'unique:projects,en_title,' . $this->selectedProjectId];
            $this->validate();

            $project = Project::findOrFail($this->selectedProjectId);
            $project->update([
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

            // Gestion des nouvelles images
            if ($this->images) {
                foreach ($this->images as $image) {
                    $path = $image->store('images/projects', 'public');
                    $project->images()->create([
                        'name' => $path,
                        'imageable_type' => Project::class,
                        'imageable_id' => $project->id,
                    ]);
                }
            }

            $this->dispatch('showToast', 'success', __('Project updated successfully!'));
            $this->closeModal();
        } catch (\Exception $e) {
            $this->dispatch('showToast', 'error', __('An error occurred while updating the project: ') . $e->getMessage());
        }
    }

    public function deleteImage($imageId)
    {
        try {
            $image = \App\Models\Image::findOrFail($imageId);
            Storage::disk('public')->delete($image->name);
            $image->delete();

            $this->existingImages = array_filter($this->existingImages, fn($img) => $img['id'] !== $imageId);
            $this->dispatch('notify', [
                'type' => 'success',
                'message' => __('Image deleted successfully!'),
                'duration' => 3000
            ]);
        } catch (\Exception $e) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => __('Error deleting image: ') . $e->getMessage(),
                'duration' => 5000
            ]);
        }
    }

    public function showDeleteForm($id)
    {
        $project = Project::findOrFail($id);
        $this->deleteId = $project->id;
        $this->fr_title = $project->fr_title;
        $this->dispatch('openDeleteModal');
    }


    public function destroyProject()
    {
        try {
            $project = Project::findOrFail($this->deleteId);
            // Supprimer les images associées
            foreach ($project->images as $image) {
                Storage::disk('public')->delete($image->name);
                $image->delete();
            }
            $project->delete();

            $this->dispatch('showToast', 'success', __('Project deleted successfully!'));
            $this->closeModal();
            $this->resetPage();
        } catch (\Exception $e) {
            $this->dispatch('showToast', 'error', __('An error occurred while deleting the project: ') . $e->getMessage());
        }
    }
    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function resetForm()
    {

        $this->reset([
            'fr_title',
            'en_title',
            'fr_description',
            'en_description',
            'company',
            'country',
            'city',
            'address',
            'status',
            'size',
            'start_date',
            'end_date',
            'category_id',
            'images',
            'existingImages'
        ]);
        $this->images = [];
    }


    public function render()
    {
        return view('livewire.admin.manage-projets', [
            'projects' => Project::with('images')->orderBy('created_at')->paginate(7),
            'categories' => Category::query()->orderBy('name')->get(),
            'statuses' => StatusEnums::cases(),
            'sizes' => SizeEnums::cases(),
        ]);
    }
}
