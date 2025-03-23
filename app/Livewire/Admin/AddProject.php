<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Project;
use App\Models\Category;
use Livewire\WithPagination;
use App\Enums\SizeEnums;
use App\Enums\StatusEnums;

class AddProject extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    


    public function render()
    {
        return view('livewire.admin.add-project', [
            'projects' => Project::query()->orderBy('fr_title')->paginate(7),
            'categories' => Category::query()->orderBy('name')->get(),
            'statuses' => StatusEnums::cases(),
            'sizes' => SizeEnums::cases(),
        ]);
    }
}
