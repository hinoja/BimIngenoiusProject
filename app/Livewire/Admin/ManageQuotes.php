<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Quote;
use Livewire\Component;
use Livewire\WithPagination;

class ManageQuotes extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $filterCategory = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $selectedQuote = null;
    public $perPage = 10; // Ajout de la variable perPage

    protected $queryString = [
        'search' => ['except' => ''],
        'filterCategory' => ['except' => ''],
        'sortField' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
        'perPage' => ['except' => 10], // Ajout dans queryString
    ];

      public function closeModal()
    {
        $this->reset();
        $this->dispatch('closeModal');
    }
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterCategory()
    {
        $this->resetPage();
    }

    public function showDetails($id)
    {
        $this->selectedQuote = Quote::with(['customer', 'category'])->findOrFail($id);
        $this->dispatch('openModal', 'detailsQuoteModal');
    }

    public function showDeleteForm($id)
    {
        $this->selectedQuote = Quote::findOrFail($id);
        $this->dispatch('openModal', 'deleteQuoteModal');
    }

    public function deleteQuote()
    {
        try {
            if ($this->selectedQuote) {
                $this->selectedQuote->delete();
                session()->flash('success', __('Quote deleted successfully!'));
                return redirect()->route('admin.quotes.index');
            }
        } catch (\Exception $e) {
            session()->flash('error', __('An error occurred: ') . $e->getMessage());
        }
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->filterCategory = '';
        $this->perPage = 10;
        $this->resetPage();
    }

    public function render()
    {
        $categories = Category::all();
        $quotes = Quote::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('project_city', 'like', '%' . $this->search . '%');

                    $q->orWhereHas('customer', function ($subq) {
                        $subq->where('email', 'like', '%' . $this->search . '%');
                    });
                });
            })
            ->when($this->filterCategory, function ($query) {
                $query->where('category_id', $this->filterCategory);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->with(['customer', 'category'])
            ->paginate($this->perPage); // Utilisation de perPage

        return view('livewire.admin.manage-quotes', [
            'quotes' => $quotes,
            'categories' => $categories
        ]);
    }
}
