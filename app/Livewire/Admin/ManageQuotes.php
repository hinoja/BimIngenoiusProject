<?php

namespace App\Livewire\Admin;

use App\Mail\QuoteResponseMail;
use App\Models\Category;
use App\Models\Quote;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class ManageQuotes extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $filterCategory = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $selectedQuote = null;
    public $perPage = 10;
    public $response = '';
    public $responseBudget = null;
    public $responseCurrency = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'filterCategory' => ['except' => ''],
        'sortField' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
        'perPage' => ['except' => 10],
    ];

    protected $rules = [
        'response' => 'required|string|min:10|max:5000',
        'responseBudget' => 'nullable|numeric|min:0|max:10000000',
        'responseCurrency' => 'nullable|string'
    ];

    protected $listeners = [
        'trix-value-updated' => 'updateResponse',
    ];

    public function updateResponse($value)
    {
        $this->response = $value;
    }

    public function resetInputFields()
    {
        $this->response = '';
        $this->responseBudget = null;
        $this->responseCurrency = '';
        $this->selectedQuote = null;
        $this->resetValidation();
    }
    // Ajouter autorisation

    public function closeModal()
    {
        $this->resetInputFields();
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
        $this->selectedQuote->file_name = $this->selectedQuote->file ? basename($this->selectedQuote->file) : null;
        $this->dispatch('openDetailsModal');
    }

    public function showDeleteForm($id)
    {
        $this->selectedQuote = Quote::findOrFail($id);
        $this->dispatch('openModal', modalId: 'deleteQuoteModal');
    }

    public function showResponseForm($id)
    {
        $this->selectedQuote = Quote::findOrFail($id);
        $this->responseCurrency = $this->selectedQuote->currency;
        $this->dispatch('openResponseModal');
    }

    public function deleteQuote()
    {
        try {
            if ($this->selectedQuote) {
                if ($this->selectedQuote->file) {
                    Storage::disk('public')->delete($this->selectedQuote->file);
                }
                $this->selectedQuote->delete();
                session()->flash('success', __('Quote deleted successfully!'));

                $this->closeModal();
                return redirect()->route('admin.quotes.index');
            }
        } catch (\Exception $e) {
            session()->flash('error', __('An error occurred: ') . $e->getMessage());
        }
    }

    public function submitResponse()
    {
        $this->validate();

        try {
            $this->selectedQuote->update([
                'response' => $this->response,
                'response_budget' => $this->responseBudget,
                'response_currency' => $this->responseBudget ? $this->responseCurrency : null,
                'response_at' => now(),
            ]);

            $this->closeModal();
            // Uncomment when email functionality is needed
            // Mail::to($this->selectedQuote->customer->email)->send(new QuoteResponseMail($this->selectedQuote));
            session()->flash('success', __('Response submitted successfully!'));
            return redirect()->route('admin.quotes.index');
        } catch (\Exception $e) {
            session()->flash('error', __('An error occurred: ') . $e->getMessage());
        }
    }

    public function downloadFile($id)
    {
        try {
            $quote = Quote::findOrFail($id);

            if (empty($quote->file)) {
                $this->dispatch('alert', type: 'error', message: __('No file associated with this quote.'));
                return;
            }

            // Normaliser le chemin du fichier (supprimer les doubles slashes)
            $filePath = str_replace('//', '/', $quote->file);

            // Vérifier si le fichier existe dans storage/app/public
            if (Storage::disk('public')->exists($filePath)) {
                $fullPath = Storage::disk('public')->path($filePath);
                return response()->download($fullPath, $this->generateDownloadName($quote));
            }

            // Alternative : vérifier directement le chemin physique
            $fullPath = storage_path('app/public/' . $filePath);
            if (file_exists($fullPath)) {
                return response()->download($fullPath, $this->generateDownloadName($quote));
            }
            session()->flash('error', __('File not found. Path: :path', ['path' => $filePath]));
        } catch (\Exception $e) {
            session()->flash('error', __('An error occurred: ') . $e->getMessage());
        }
    }

    protected function generateDownloadName(Quote $quote): string
    {
        $extension = pathinfo($quote->file, PATHINFO_EXTENSION);
        $slug = Str::slug($quote->title);
        return "quote-{$quote->id}-{$slug}.{$extension}";
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
                        ->orWhere('project_city', 'like', '%' . $this->search . '%')
                        ->orWhereHas('customer', function ($subq) {
                            $subq->where('email', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->when($this->filterCategory, function ($query) {
                $query->where('category_id', $this->filterCategory);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->with(['customer', 'category'])
            ->paginate($this->perPage);

        return view('livewire.admin.manage-quotes', [
            'quotes' => $quotes,
            'categories' => $categories,
        ]);
    }
}
