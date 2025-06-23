<?php

namespace App\Livewire\Admin;

use App\Models\Quote;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class ShowQuote extends Component
{
    public Quote $quote;
    
    public function mount(Quote $quote)
    {
        $this->quote = $quote;
    }
    
    public function changeStatus()
    {
        $this->dispatch('openModal', 'changeStatusModal');
    }
    
    public function updateStatus($status)
    {
        $this->quote->status = $status;
        $this->quote->save();
        
        $this->dispatch('closeModal', 'changeStatusModal');
        $this->dispatch('alert', [
            'type' => 'success',
            'message' => __('Quote status updated successfully!')
        ]);
    }
    
    public function confirmDelete()
    {
        $this->dispatch('openModal', 'deleteQuoteModal');
    }
    
    public function deleteQuote()
    {
        // Delete file if exists
        if ($this->quote->file && Storage::exists($this->quote->file)) {
            Storage::delete($this->quote->file);
        }
        
        $this->quote->delete();
        
        $this->dispatch('closeModal', 'deleteQuoteModal');
        $this->dispatch('alert', [
            'type' => 'success',
            'message' => __('Quote deleted successfully!')
        ]);
        
        return redirect()->route('admin.quotes.index');
    }
    
    public function render()
    {
        return view('livewire.admin.show-quote');
    }
}