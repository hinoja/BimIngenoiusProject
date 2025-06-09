<?php

namespace App\Livewire\Admin;

use App\Models\Quote;
use App\Models\Customer;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AddQuote extends Component
{
    use WithFileUploads;
    
    // Informations du client
    public $customer_id;
    public $customer_name;
    public $customer_email;
    public $customer_phone;
    
    // Informations du devis
    public $title;
    public $category_id;
    public $details;
    public $budget;
    public $currency = 'EUR';
    public $project_city;
    public $file;
    
    // Gestion des étapes
    public $step = 1;
    public $totalSteps = 2;
    
    protected $rules = [
        // Étape 1 - Informations client
        'customer_id' => 'nullable',
        'customer_name' => 'required|string|max:255',
        'customer_email' => 'required|email|max:255',
        'customer_phone' => 'nullable|string|max:20',
        
        // Étape 2 - Informations devis
        'title' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'details' => 'required|string',
        'budget' => 'required|numeric|min:0',
        'currency' => 'required|string|max:10',
        'project_city' => 'required|string|max:100',
        'file' => 'nullable|file|max:10240', // 10MB max
    ];
    
    public function mount()
    {
        $this->step = 1;
    }
    
    public function nextStep()
    {
        if ($this->step === 1) {
            $this->validate([
                'customer_id' => 'nullable',
                'customer_name' => 'required|string|max:255',
                'customer_email' => 'required|email|max:255',
                'customer_phone' => 'nullable|string|max:20',
            ]);
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
    
    public function selectExistingCustomer($id)
    {
        $customer = Customer::findOrFail($id);
        $this->customer_id = $customer->id;
        $this->customer_name = $customer->name;
        $this->customer_email = $customer->email;
        $this->customer_phone = $customer->phone;
    }
    
    public function save()
    {
        $this->validate();
        
        DB::beginTransaction();
        
        try {
            // Créer ou récupérer le client
            if ($this->customer_id) {
                $customer = Customer::findOrFail($this->customer_id);
                // Mettre à jour les informations du client si nécessaire
                $customer->update([
                    'name' => $this->customer_name,
                    'email' => $this->customer_email,
                    'phone' => $this->customer_phone,
                ]);
            } else {
                $customer = Customer::create([
                    'name' => $this->customer_name,
                    'email' => $this->customer_email,
                    'phone' => $this->customer_phone,
                ]);
            }
            
            // Traiter le fichier s'il existe
            $filePath = null;
            if ($this->file) {
                $filePath = $this->file->store('quotes', 'public');
            }
            
            // Créer le devis
            Quote::create([
                'customer_id' => $customer->id,
                'category_id' => $this->category_id,
                'title' => $this->title,
                'details' => $this->details,
                'budget' => $this->budget,
                'currency' => $this->currency,
                'project_city' => $this->project_city,
                'file' => $filePath,
                'status' => 'pending',
            ]);
            
            DB::commit();
            
            session()->flash('success', __('Quote created successfully!'));
            return redirect()->route('admin.quotes.index');
            
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', __('An error occurred: ') . $e->getMessage());
        }
    }
    
    public function render()
    {
        $customers = Customer::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        
        return view('livewire.admin.add-quote', [
            'customers' => $customers,
            'categories' => $categories,
        ]);
    }
}