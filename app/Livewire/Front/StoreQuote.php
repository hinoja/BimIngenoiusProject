<?php

namespace App\Livewire\Front;

use App\Models\{Plan, Project, Category, Customer};
use App\Models\User;
use App\Models\Quote;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Front\NewQuoteNotification;

class StoreQuote extends Component
{
    use WithFileUploads;

    // Propriétés du formulaire
    public $civility, $first_name, $last_name, $email, $phone, $zip_code, $city;
    public $title, $details, $budget, $currency, $project_city, $category;
    public $file;
    public $subscribe = false;

    // Données de référence
    public $civilities, $currencies, $categories;

    // État du composant
    public $quotable;
    public $isLoading = false;
    public $currentStep = 1;

    public function mount(Plan|Project $quotable)
    {
        $this->civilities = Quote::CIVILITY;
        $this->currencies = config('currencies');
        $this->categories = Category::query()->get(['id', app()->getLocale() . '_name as name']);
        $this->quotable = $quotable;
    }

    protected function rules()
    {
        $rules = [
            'civility' => 'required|in:' . implode(',', array_keys($this->civilities)),
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'zip_code' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'details' => 'required|string|min:10|max:5000',
            'budget' => 'required|numeric|min:0',
            'currency' => 'required|in:' . implode(',', array_keys($this->currencies)),
            'project_city' => 'nullable|string|max:255',
            'category' => 'required|exists:categories,id',
            'file' => 'nullable|file|max:10240|mimes:pdf,doc,docx,jpg,jpeg,png,xls,xlsx',
            'subscribe' => 'boolean',
        ];

        // Validation par étape
        if ($this->currentStep == 1) {
            return array_intersect_key($rules, array_flip([
                'civility', 'first_name', 'last_name', 'email', 'phone', 'zip_code', 'city'
            ]));
        } elseif ($this->currentStep == 2) {
            return array_intersect_key($rules, array_flip([
                'title', 'details', 'budget', 'currency', 'project_city', 'category'
            ]));
        }
        return $rules;
    }

    protected function messages()
    {
        return [
            'civility.required' => __('Please select a civility.'),
            'first_name.required' => __('First name is required.'),
            'last_name.required' => __('Last name is required.'),
            'email.required' => __('Email is required.'),
            'email.email' => __('Please enter a valid email address.'),
            'phone.required' => __('Phone number is required.'),
            'zip_code.required' => __('Zip code is required.'),
            'city.required' => __('City is required.'),
            'title.required' => __('Project title is required.'),
            'details.required' => __('Project details are required.'),
            'details.min' => __('Project details must be at least 10 characters.'),
            'budget.required' => __('Budget is required.'),
            'budget.numeric' => __('Budget must be a number.'),
            'currency.required' => __('Currency is required.'),
            'category.required' => __('Category is required.'),
            'file.max' => __('File size must not exceed 10MB.'),
            'file.mimes' => __('File must be of type: PDF, DOC, DOCX, JPG, PNG, XLS, XLSX.'),
        ];
    }

    public function updatedFile()
    {
        $this->validateOnly('file');
    }

    public function nextStep()
    {
        $this->validate();
        if ($this->currentStep < 3) {
            $this->currentStep++;
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    public function store()
    {
        $this->isLoading = true;

        try {
            $validatedData = $this->validate();

            $validatedData['quotable_id'] = $this->quotable->id;
            $validatedData['quotable_type'] = get_class($this->quotable);

            $customer = $this->createOrUpdateCustomer($validatedData);

            $quote = $this->createQuote($customer, $validatedData);

            if ($this->file) {
                $this->handleFileUpload($quote);
            }

            $this->sendNotifications($customer, $quote);

            session()->flash('success', __('Your quote has been submitted successfully! You will receive a confirmation email shortly.'));

            $route = $this->quotable instanceof Project ? 'front.projects.show' : 'front.plans.show';
            $this->redirectRoute($route, $this->quotable);

        } catch (\Exception $e) {
            session()->flash('error', __('An error occurred while submitting your quote. Please try again.'));
        } finally {
            $this->isLoading = false;
        }
    }

    private function createOrUpdateCustomer(array $data): Customer
    {
        return Customer::query()->updateOrCreate(
            ['email' => $data['email']],
            [
                'civility' => $data['civility'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'phone' => $data['phone'],
                'zip_code' => $data['zip_code'],
                'city' => $data['city'],
            ]
        );
    }

    private function createQuote(Customer $customer, array $data): Quote
    {
        $quoteData = [
            'title' => $data['title'],
            'details' => $data['details'],
            'budget' => $data['budget'],
            'currency' => $data['currency'],
            'project_city' => $data['project_city'],
            'category_id' => $data['category'],
            'quotable_id' => $data['quotable_id'],
            'quotable_type' => $data['quotable_type'],
        ];

        return $customer->quotes()->create($quoteData);
    }

    private function handleFileUpload(Quote $quote): void
    {
        $filename = Str::slug($quote->title) . '_' . time() . '.' . $this->file->getClientOriginalExtension();
        $filePath = $this->file->storeAs('quotes', $filename, 'public');
        $quote->update(['file' => $filePath]);
    }

    private function sendNotifications(Customer $customer, Quote $quote): void
    {
        try {
            $admin = User::query()->firstWhere('role_id', 1);
            if ($admin) {
                Notification::send([$customer, $admin], new NewQuoteNotification($quote));
            }
        } catch (\Exception $e) {
            // \Log::error('Notification error: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.front.store-quote');
    }
}
