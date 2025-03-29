<?php

namespace App\Livewire\Front;

use App\Models\User;
use App\Models\Quote;
use Livewire\Component;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\Front\StoreQuoteRequest;
use App\Notifications\Front\NewQuoteNotification;

class StoreQuote extends Component
{
    use WithFileUploads;

    public $civility;
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $zip_code;
    public $city;

    public $title;
    public $details;
    public $budget;
    public $currency;
    public $project_city;
    public $category;
    public $file;

    public $civilities;
    public $currencies;
    public $categories;

    public function mount()
    {
        $this->civilities = Quote::CIVILITY;
        $this->currencies = config('currencies');
        $this->categories = Category::query()->get(['id', 'name']);
    }

    public function rules()
    {
        return (new StoreQuoteRequest())->rules();
    }

    public function store()
    {
        $validatedData = $this->validate();
        
        $customer = Customer::query()->firstOrCreate(
            ['email' => $validatedData['email']],
            [
                'civility' => $validatedData['civility'],
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'phone' => $validatedData['phone'],
                'zip_code' => $validatedData['zip_code'],
                'city' => $validatedData['city'],
            ]
        );

        $quote = $customer->quotes()->create([
            'title' => $validatedData['title'],
            'details' => $validatedData['details'],
            'budget' => $validatedData['budget'],
            'currency' => $validatedData['currency'],
            'project_city' => $validatedData['project_city'],
            'category_id' => $validatedData['category'],
            'file' => $validatedData['file'] ?? null,
        ]);
        
        if ($this->file) {
            $filename = Str::slug($quote->title) . '.' . $this->file->getClientOriginalExtension();
            $validatedData['file'] = $this->file->storeAs('quotes/', $filename, 'public');
        }

        Notification::send([$customer, User::query()->firstWhere('role_id', 1)], new NewQuoteNotification($quote));
        
        session()->flash('success', __('Your quote has been submitted successfully! You will receive an email as soon as possible.'));

        $this->redirectRoute('front.quote.form');
    }

    public function render()
    {
        return view('livewire.front.store-quote');
    }
}
