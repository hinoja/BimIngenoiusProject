<?php

namespace App\Livewire\Front;

use App\Models\Plan;
use App\Models\User;
use App\Models\Quote;
use Livewire\Component;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Support\Arr;
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

    public $plan;

    public function mount($plan = null)
    {
        $this->civilities = Quote::CIVILITY;
        $this->currencies = config('currencies');
        $this->categories = Category::query()->get(['id', 'fr_name', 'en_name']);

        $this->plan = $plan;
    }

    public function rules()
    {
        return (new StoreQuoteRequest())->rules();
    }

    public function store()
    {
        $validatedData = $this->validate();
        $validatedData['plan_id'] = $this->plan->id;
        // dd($validatedData);

        $customer = $this->createOrUpdateCustomer($validatedData);

        $quote = $this->createQuote($customer, $validatedData);

        if ($this->file) {
            $this->handleFileUpload($quote);
        }

        $this->sendNotifications($customer, $quote);

        session()->flash('success', __('Your quote has been submitted successfully! You will receive a confirmation email shortly.'));

        $this->redirectRoute('front.plans.show', $this->plan);
    }

    private function createOrUpdateCustomer(array $data): Customer
    {
        return Customer::query()->firstOrCreate(
            ['email' => $data['email']],
            array_intersect_key($data, array_flip(['civility', 'first_name', 'last_name', 'phone', 'zip_code', 'city']))
        );
    }

    private function createQuote(Customer $customer, array $data): Quote
    {
        $quoteData = [
            'title'        => $data['title'],
            'details'      => $data['details'],
            'budget'       => $data['budget'],
            'currency'     => $data['currency'],
            'project_city' => $data['project_city'],
            'category_id'  => $data['category'],
            'plan_id'      => $this->plan->id
        ];

        return $customer->quotes()->create($quoteData);
    }

    private function handleFileUpload(Quote $quote): void
    {
        $filename = Str::slug($quote->title) . '.' . $this->file->getClientOriginalExtension();
        $quote->update(['file' => $this->file->storeAs('quotes/', $filename, 'public')]);
    }

    private function sendNotifications(Customer $customer, Quote $quote): void
    {
        $admin = User::query()->firstWhere('role_id', 1);
        Notification::send([$customer, $admin], new NewQuoteNotification($quote));
    }

    public function render()
    {
        return view('livewire.front.store-quote');
    }
}
