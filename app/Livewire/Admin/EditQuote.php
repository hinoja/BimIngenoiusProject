<?php

namespace App\Livewire\Admin;

use App\Models\Quote;
use App\Models\Category;
use App\Models\Customer;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditQuote extends Component
{
    use WithFileUploads;
    
    public Quote $quote;
    public $title;
    public $details;
    public $budget;
    public $currency;
    public $project_city;
    public $category_id;
    public $status;
    public $newFile;
    
    // Customer fields
    public $customer_name;
    public $customer_email;
    public $customer_phone;
    public $customer_company;
    public $customer_address;
    public $customer_city;
    public $customer_country;
    public $customer_postal_code;
    
    protected $rules = [
        'title' => 'required|string|max:255',
        'details' => 'required|string',
        'budget' => 'required|numeric|min:0',
        'currency' => 'required|string|max:10',
        'project_city' => 'required|string|max:100',
        'category_id' => 'required|exists:categories,id',
        'status' => 'required|in:pending,approved,rejected,completed',
        'newFile' => 'nullable|file|max:10240',
        
        'customer_name' => 'required|string|max:255',
        'customer_email' => 'required|email|max:255',
        'customer_phone' => 'nullable|string|max:20',
        'customer_company' => 'nullable|string|max:255',
        'customer_address' => 'nullable|string|max:255',
        'customer_city' => 'nullable|string|max:100',
        'customer_country' => 'nullable|string|max:100',
        'customer_postal_code' => 'nullable|string|max:20',
    ];
    
    public function mount(Quote $quote)
    {
        $this->quote = $quote;
        $this->title = $quote->title;
        $this->details = $quote->details;
        $this->budget = $quote->budget;
        $this->currency = $quote->currency;
        $this->project_city = $quote->project_city;
        $this->category_id = $quote->category_id;
        $this->status = $quote->status;
        
        // Customer data
        $this->customer_name = $quote->customer->name;
        $this->customer_email = $quote->customer->email;
        $this->customer_phone = $quote->customer->phone;
        $this->customer_company = $quote->customer->company;
        $this->customer_address = $quote->customer->address;
        $this->customer_city = $quote->customer->city;
        $this->customer_country = $quote->customer->country;
        $this->customer_postal_code = $quote->customer->postal_code;
    }
    
    public function updateQuote()
    {
        $this->validate();
        
        // Update customer information
        $customer = $this->quote->customer;
        $customer->name = $this->customer_name;
        $customer->email = $this->customer_email;
        $customer->phone = $this->customer_phone;
        $customer->company = $this->customer_company;
        $customer->address = $this->customer_address;
        $customer->city = $this->customer_city;
        $customer->country = $this->customer_country;
        $customer->postal_code = $this->customer_postal_code;
        $customer->save();
        
        // Handle file upload if a new file is provided
        if ($this->newFile) {
            // Delete old file if exists
            if ($this->quote->file && Storage::exists($this->quote->file)) {
                Storage::delete($this->quote->file);
            }
            
            // Store new file
            $filePath = $this->newFile->store('quotes');
            $this->quote->file = $filePath;
        }
        
        // Update quote information
        $this->quote->title = $this->title;
        $this->quote->details = $this->details;
        $this->quote->budget = $this->budget;
        $this->quote->currency = $this->currency;
        $this->quote->project_city = $this->project_city;
        $this->quote->category_id = $this->category_id;
        $this->quote->status = $this->status;
        $this->quote->save();
        
        $this->dispatch('alert', [
            'type' => 'success',
            'message' => __('Quote updated successfully!')
        ]);
        
        return redirect()->route('admin.quotes.show', $this->quote);
    }
    
    public function deleteFile()
    {
        if ($this->quote->file && Storage::exists($this->quote->file)) {
            Storage::delete($this->quote->file);
            $this->quote->file = null;
            $this->quote->save();
            
            $this->dispatch('alert', [
                'type' => 'success',
                'message' => __('File deleted successfully!')
            ]);
        }
    }
    
    public function render()
    {
        $categories = Category::all();
        
        return view('livewire.admin.edit-quote', [
            'categories' => $categories,
        ]);
    }
}