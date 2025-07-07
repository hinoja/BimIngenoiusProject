<div>
    <div class="quote-form-container">
        @push('css')
            <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
            <style>
                /* Variables CSS pour cohérence */
                :root {
                    --primary-color: #b3b158;
                    --secondary-color: #764ba2;
                    --text-dark: #2d3748;
                    --text-light: #718096;
                    --bg-light: #f7fafc;
                    --bg-white: #ffffff;
                    --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
                    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                    --border-radius: 12px;
                    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                }

                .quote-form-container {
                    max-width: 800px;
                    margin: 2rem auto;
                    padding: 2rem;
                    background: var(--bg-white);
                    border-radius: var(--border-radius);
                    box-shadow: var(--shadow-md);
                    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
                    animation: slideIn 0.6s ease-out;
                }

                .quote-form-header {
                    text-align: center;
                    padding: 1.5rem;
                    background: linear-gradient(135deg, var(--primary-color), #8b6914);
                    border-radius: var(--border-radius);
                    color: #fff;
                    margin-bottom: 2rem;
                    position: relative;
                    overflow: hidden;
                }

                .quote-form-header h4 {
                    font-size: 1.75rem;
                    font-weight: 700;
                    margin: 0;
                }

                .quote-form-header p {
                    font-size: 1rem;
                    opacity: 0.9;
                    margin: 0.5rem 0 0;
                }

                .progress-indicator {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    gap: 1rem;
                    margin-bottom: 2rem;
                }

                .progress-step {
                    width: 2.5rem;
                    height: 2.5rem;
                    border-radius: 50%;
                    background: #e0e0e0;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 0.9rem;
                    font-weight: 600;
                    color: var(--text-light);
                    transition: var(--transition);
                }

                .progress-step.active {
                    background: var(--primary-color);
                    color: #fff;
                    transform: scale(1.1);
                    box-shadow: 0 4px 12px rgba(179, 177, 88, 0.4);
                }

                .progress-step.completed {
                    background: var(--secondary-color);
                    color: #fff;
                    box-shadow: 0 4px 12px rgba(118, 75, 162, 0.4);
                }

                .progress-line {
                    width: 3rem;
                    height: 4px;
                    background: #e0e0e0;
                    border-radius: 2px;
                    transition: var(--transition);
                }

                .progress-line.active {
                    background: var(--primary-color);
                }

                .form-section {
                    padding: 1.5rem;
                    background: var(--bg-light);
                    border-radius: var(--border-radius);
                    margin-bottom: 1.5rem;
                    animation: fadeInUp 0.6s ease-out;
                }

                .section-title {
                    font-size: 1.25rem;
                    font-weight: 600;
                    color: var(--text-dark);
                    margin-bottom: 1rem;
                    display: flex;
                    align-items: center;
                    gap: 0.75rem;
                }

                .section-icon {
                    width: 2rem;
                    height: 2rem;
                    border-radius: 50%;
                    background: var(--primary-color);
                    color: #fff;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 1rem;
                }

                .form-row {
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    gap: 1rem;
                }

                .form-row.budget-row {
                    grid-template-columns: 2fr 1fr;
                }

                .form-group {
                    margin-bottom: 1.5rem;
                }

                .form-label {
                    font-weight: 600;
                    color: var(--text-dark);
                    font-size: 0.9rem;
                    margin-bottom: 0.5rem;
                    display: block;
                }

                .form-label.required::after {
                    content: '*';
                    color: #e74c3c;
                    margin-left: 4px;
                }

                .form-input {
                    width: 100%;
                    padding: 0.75rem;
                    border: 1px solid #ced4da;
                    border-radius: var(--border-radius);
                    font-size: 0.95rem;
                    transition: var(--transition);
                    background: #fff;
                }

                .form-input:focus {
                    outline: none;
                    border-color: var(--primary-color);
                    box-shadow: 0 0 0 3px rgba(179, 177, 88, 0.2);
                }

                .form-input.is-invalid {
                    border-color: #dc3545;
                    background: #fff6f6;
                }

                .trix-content {
                    min-height: 120px;
                    max-height: 300px;
                    overflow-y: auto;
                }

                trix-editor.form-input {
                    border: 1px solid #ced4da;
                    border-radius: var(--border-radius);
                }

                trix-editor.is-invalid {
                    border-color: #dc3545;
                    box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.2);
                }

                trix-editor:focus {
                    border-color: var(--primary-color);
                    box-shadow: 0 0 0 3px rgba(179, 177, 88, 0.2);
                }

                .file-upload-area {
                    border: 2px dashed var(--primary-color);
                    border-radius: var(--border-radius);
                    padding: 1.5rem;
                    text-align: center;
                    background: rgba(179, 177, 88, 0.05);
                    transition: var(--transition);
                    cursor: pointer;
                    min-height: 100px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                .file-upload-area:hover {
                    background: rgba(179, 177, 88, 0.1);
                    transform: translateY(-2px);
                }

                .file-upload-area input[type="file"] {
                    position: absolute;
                    opacity: 0;
                    width: 100%;
                    height: 100%;
                    cursor: pointer;
                    top: 0;
                    left: 0;
                }

                .file-upload-content {
                    pointer-events: none;
                }

                .file-upload-icon {
                    font-size: 2rem;
                    color: var(--primary-color);
                    margin-bottom: 0.5rem;
                }

                .file-upload-text {
                    font-size: 0.95rem;
                    color: var(--text-dark);
                    font-weight: 600;
                }

                .file-upload-hint {
                    font-size: 0.85rem;
                    color: var(--text-light);
                }

                .file-selected .file-upload-icon {
                    color: #28a745;
                }

                .file-selected {
                    border-color: #28a745;
                    background: rgba(40, 167, 69, 0.1);
                }

                .checkbox-container {
                    display: flex;
                    align-items: center;
                    gap: 0.75rem;
                    padding: 1rem;
                    background: var(--bg-light);
                    border-radius: var(--border-radius);
                }

                .checkbox-container input[type="checkbox"] {
                    transform: scale(1.2);
                    accent-color: var(--primary-color);
                }

                .checkbox-container label {
                    font-size: 0.9rem;
                    color: var(--text-dark);
                }

                .error-message {
                    color: #dc3545;
                    font-size: 0.85rem;
                    margin-top: 0.5rem;
                    display: flex;
                    align-items: center;
                    gap: 0.5rem;
                    animation: shake 0.5s ease-in-out;
                }

                .success-alert, .error-alert {
                    padding: 1rem;
                    border-radius: var(--border-radius);
                    margin-bottom: 1.5rem;
                    display: flex;
                    align-items: center;
                    gap: 0.75rem;
                    font-weight: 500;
                }

                .success-alert {
                    background: linear-gradient(135deg, #28a745, #218838);
                    color: #fff;
                    box-shadow: var(--shadow-sm);
                }

                .error-alert {
                    background: linear-gradient(135deg, #dc3545, #c82333);
                    color: #fff;
                    box-shadow: var(--shadow-sm);
                }

                .submit-section {
                    text-align: center;
                    margin-top: 2rem;
                    padding: 1.5rem;
                    background: var(--bg-light);
                    border-radius: var(--border-radius);
                    border-top: 3px solid var(--primary-color);
                }

                .submit-btn {
                    background: linear-gradient(135deg, var(--primary-color), #8b6914);
                    color: #fff;
                    border: none;
                    padding: 0.75rem 2rem;
                    border-radius: var(--border-radius);
                    font-size: 1rem;
                    font-weight: 600;
                    cursor: pointer;
                    transition: var(--transition);
                    display: inline-flex;
                    align-items: center;
                    gap: 0.5rem;
                    box-shadow: var(--shadow-sm);
                }

                .submit-btn:hover:not(:disabled) {
                    background: linear-gradient(135deg, #8b6914, var(--primary-color));
                    transform: translateY(-2px);
                    box-shadow: var(--shadow-md);
                }

                .submit-btn:disabled {
                    opacity: 0.6;
                    cursor: not-allowed;
                }

                .loading-spinner {
                    width: 1rem;
                    height: 1rem;
                    border: 2px solid #fff;
                    border-top: 2px solid transparent;
                    border-radius: 50%;
                    animation: spin 1s linear infinite;
                }

                @keyframes spin {
                    0% { transform: rotate(0deg); }
                    100% { transform: rotate(360deg); }
                }

                .floating-icons {
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    pointer-events: none;
                    z-index: 1;
                }

                .floating-icon {
                    position: absolute;
                    opacity: 0.1;
                    font-size: 1.5rem;
                    color: var(--secondary-color);
                    animation: float 10s ease-in-out infinite;
                }

                @keyframes float {
                    0%, 100% { transform: translateY(0); }
                    50% { transform: translateY(-15px); }
                }

                @keyframes slideIn {
                    from { opacity: 0; transform: translateY(20px); }
                    to { opacity: 1; transform: translateY(0); }
                }

                @keyframes fadeInUp {
                    from { opacity: 0; transform: translateY(15px); }
                    to { opacity: 1; transform: translateY(0); }
                }

                @keyframes shake {
                    0%, 100% { transform: translateX(0); }
                    25% { transform: translateX(-5px); }
                    75% { transform: translateX(5px); }
                }

                @media (max-width: 768px) {
                    .quote-form-container {
                        margin: 1rem;
                        padding: 1rem;
                    }

                    .form-row, .form-row.budget-row {
                        grid-template-columns: 1fr;
                    }

                    .progress-indicator {
                        flex-direction: column;
                        gap: 0.5rem;
                    }

                    .progress-line {
                        width: 4px;
                        height: 1.5rem;
                    }

                    .quote-form-header h4 {
                        font-size: 1.5rem;
                    }
                }
            </style>
        @endpush

        @push('js')
            <script src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
            <script>
                document.addEventListener('trix-file-accept', function(e) {
                    e.preventDefault();
                });

                document.addEventListener('DOMContentLoaded', function() {
                    const fileUploadArea = document.querySelector('.file-upload-area');
                    const fileInput = document.getElementById('file');
                    const fileContent = document.querySelector('.file-upload-content');

                    fileUploadArea.addEventListener('dragover', (e) => {
                        e.preventDefault();
                        fileUploadArea.classList.add('file-selected');
                    });

                    fileUploadArea.addEventListener('dragleave', (e) => {
                        e.preventDefault();
                        if (!fileInput.files.length) {
                            fileUploadArea.classList.remove('file-selected');
                        }
                    });

                    fileUploadArea.addEventListener('drop', (e) => {
                        e.preventDefault();
                        const files = e.dataTransfer.files;
                        if (files.length > 0 && files[0].size <= 10 * 1024 * 1024) {
                            fileInput.files = files;
                            updateFileDisplay(files[0].name);
                            fileUploadArea.classList.add('file-selected');
                        } else if (files.length > 0) {
                            alert('@lang("File size exceeds 10MB. Please select a smaller file.")');
                        }
                    });

                    fileInput.addEventListener('change', (e) => {
                        if (e.target.files.length > 0 && e.target.files[0].size <= 10 * 1024 * 1024) {
                            updateFileDisplay(e.target.files[0].name);
                            fileUploadArea.classList.add('file-selected');
                        } else if (e.target.files.length > 0) {
                            alert('@lang("File size exceeds 10MB. Please select a smaller file.")');
                            fileInput.value = '';
                        }
                    });

                    function updateFileDisplay(fileName) {
                        fileContent.innerHTML = `
                            <i class="fas fa-file-alt file-upload-icon"></i>
                            <div class="file-upload-text"><strong>${fileName}</strong></div>
                            <div class="file-upload-hint">@lang('File selected')</div>
                        `;
                    }
                });
            </script>
        @endpush

        <div class="floating-icons">
            <i class="fas fa-home floating-icon" style="top: 10%; left: 5%; animation-delay: 0s;"></i>
            <i class="fas fa-tools floating-icon" style="top: 20%; right: 10%; animation-delay: 2s;"></i>
            <i class="fas fa-drafting-compass floating-icon" style="bottom: 15%; left: 15%; animation-delay: 4s;"></i>
            <i class="fas fa-building floating-icon" style="bottom: 10%; right: 5%; animation-delay: 6s;"></i>
        </div>

        @if (session()->has('error'))
            <div class="error-alert">
                <i class="fas fa-exclamation-triangle"></i>
                <strong>{{ session('error') }}</strong>
            </div>
        @endif

        <div class="quote-form-header">
            <h4><i class="fas fa-file-invoice-dollar"></i> @lang('Request a Quote')</h4>
            <p>@lang('Get a personalized quote for your project')</p>
        </div>

        <div class="progress-indicator">
            <div class="progress-step {{ $currentStep == 1 ? 'active' : ($currentStep > 1 ? 'completed' : '') }}">
                <i class="fas fa-user"></i>
            </div>
            <div class="progress-line {{ $currentStep > 1 ? 'active' : '' }}"></div>
            <div class="progress-step {{ $currentStep == 2 ? 'active' : ($currentStep > 2 ? 'completed' : '') }}">
                <i class="fas fa-project-diagram"></i>
            </div>
            <div class="progress-line {{ $currentStep > 2 ? 'active' : '' }}"></div>
            <div class="progress-step {{ $currentStep == 3 ? 'active' : '' }}">
                <i class="fas fa-check"></i>
            </div>
        </div>

        <form class="quote-form" wire:submit.prevent="store">
            <!-- Étape 1 : Informations personnelles -->
            @if ($currentStep == 1)
                <div class="form-section" data-step="1">
                    <div class="section-title">
                        <div class="section-icon"><i class="fas fa-user"></i></div>
                        <span>@lang('Personal Information')</span>
                    </div>

                    <div class="form-group">
                        <label class="form-label required" for="civility">@lang('Civility')</label>
                        <select id="civility" wire:model.defer="civility" class="form-input @error('civility') is-invalid @enderror" required>
                            <option value="">@lang('Select civility')</option>
                            @foreach ($civilities as $key => $civility)
                                <option value="{{ $key }}">{{ __($civility) }}</option>
                            @endforeach
                        </select>
                        @error('civility')
                            <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group has-icon">
                            <label class="form-label required" for="first_name">@lang('First Name')</label>
                            <input id="first_name" wire:model.defer="first_name" type="text"
                                class="form-input @error('first_name') is-invalid @enderror"
                                placeholder="@lang('Enter your first name')" required>
                            <i class="fas fa-user input-icon"></i>
                            @error('first_name')
                                <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group has-icon">
                            <label class="form-label required" for="last_name">@lang('Last Name')</label>
                            <input id="last_name" wire:model.defer="last_name" type="text"
                                class="form-input @error('last_name') is-invalid @enderror"
                                placeholder="@lang('Enter your last name')" required>
                            <i class="fas fa-user input-icon"></i>
                            @error('last_name')
                                <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group has-icon">
                            <label class="form-label required" for="phone">@lang('Phone')</label>
                            <input id="phone" wire:model.defer="phone" type="tel"
                                class="form-input @error('phone') is-invalid @enderror"
                                placeholder="@lang('Enter your phone number')" required>
                            <i class="fas fa-phone input-icon"></i>
                            @error('phone')
                                <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group has-icon">
                            <label class="form-label required" for="email">@lang('Email')</label>
                            <input id="email" wire:model.defer="email" type="email"
                                class="form-input @error('email') is-invalid @enderror"
                                placeholder="@lang('Enter your email')" required>
                            <i class="fas fa-envelope input-icon"></i>
                            @error('email')
                                <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group has-icon">
                            <label class="form-label required" for="city">@lang('City')</label>
                            <input id="city" wire:model.defer="city" type="text"
                                class="form-input @error('city') is-invalid @enderror"
                                placeholder="@lang('Enter your city')" required>
                            <i class="fas fa-map-marker-alt input-icon"></i>
                            @error('city')
                                <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group has-icon">
                            <label class="form-label required" for="zip_code">@lang('Zip Code')</label>
                            <input id="zip_code" wire:model.defer="zip_code" type="text"
                                class="form-input @error('zip_code') is-invalid @enderror"
                                placeholder="@lang('Enter your zip code')" required>
                            <i class="fas fa-mail-bulk input-icon"></i>
                            @error('zip_code')
                                <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="button" wire:click="nextStep" class="submit-btn">
                            @lang('Next') <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            @endif

            <!-- Étape 2 : Informations du projet -->
            @if ($currentStep == 2)
                <div class="form-section" data-step="2">
                    <div class="section-title">
                        <div class="section-icon"><i class="fas fa-project-diagram"></i></div>
                        <span>@lang('Project Information')</span>
                    </div>

                    <div class="form-group has-icon">
                        <label class="form-label required" for="title">@lang('Project Title')</label>
                        <input id="title" wire:model.defer="title" type="text"
                            class="form-input @error('title') is-invalid @enderror"
                            placeholder="@lang('Enter the project title')" required>
                        <i class="fas fa-tag input-icon"></i>
                        @error('title')
                            <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label required" for="category">@lang('Category')</label>
                        <select id="category" wire:model.defer="category"
                            class="form-input @error('category') is-invalid @enderror" required>
                            <option value="">@lang('Select project category')</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-row budget-row">
                        <div class="form-group has-icon">
                            <label class="form-label required" for="budget">@lang('Budget')</label>
                            <input id="budget" wire:model.lazy="budget" type="number" step="0.01"
                                class="form-input @error('budget') is-invalid @enderror"
                                placeholder="@lang('Budget')" required>
                            <i class="fas fa-euro-sign input-icon"></i>
                            @error('budget')
                                <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label required" for="currency">@lang('Currency')</label>
                            <select id="currency" wire:model.defer="currency"
                                class="form-input @error('currency') is-invalid @enderror" required>
                                <option value="">@lang('Select Currency')</option>
                                @foreach ($currencies as $key => $currency)
                                    <option value="{{ $key }}">{{ $currency }}</option>
                                @endforeach
                            </select>
                            @error('currency')
                                <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label required" for="details">@lang('Project Details')</label>
                        <input id="details" type="hidden" wire:model.defer="details">
                        <trix-editor x-data x-init="$refs.trix.editor.loadHTML(@this.get('details') || '')"
                                     x-ref="trix" input="details"
                                     @trix-change="$wire.set('details', $event.target.value)"
                                     class="form-input trix-content @error('details') is-invalid @enderror"
                                     placeholder="@lang('Enter the project details')"></trix-editor>
                        @error('details')
                            <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group has-icon">
                        <label class="form-label" for="project_city">@lang('Project City')</label>
                        <input id="project_city" wire:model.defer="project_city" type="text"
                            class="form-input @error('project_city') is-invalid @enderror"
                            placeholder="@lang('Enter the project city')">
                        <i class="fas fa-map-marker-alt input-icon"></i>
                        @error('project_city')
                            <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button type="button" wire:click="previousStep" class="submit-btn mr-2">
                            <i class="fas fa-arrow-left"></i> @lang('Previous')
                        </button>
                        <button type="button" wire:click="nextStep" class="submit-btn">
                            @lang('Next') <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            @endif

            <!-- Étape 3 : Documents et finalisation -->
            @if ($currentStep == 3)
                <div class="form-section" data-step="3">
                    <div class="section-title">
                        <div class="section-icon"><i class="fas fa-paperclip"></i></div>
                        <span>@lang('Documents and Finalization')</span>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="file">@lang('Upload File')</label>
                        <div class="file-upload-area" wire:loading.class.remove="file-selected" wire:target="file">
                            <input id="file" wire:model.defer="file" type="file"
                                accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.xls,.xlsx">
                            <div class="file-upload-content">
                                <i class="fas fa-cloud-upload-alt file-upload-icon"></i>
                                <div class="file-upload-text"><strong>@lang('Drag your files here or click to browse')</strong></div>
                                <div class="file-upload-hint">@lang('PDF, DOC, DOCX, JPG, PNG, XLS, XLSX (Max 10MB)')</div>
                            </div>
                        </div>
                        @error('file')
                            <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="checkbox-container">
                        <input type="checkbox" name="subscribe" id="subscribe" wire:model.defer="subscribe">
                        <label for="subscribe">
                            @lang('I would like to receive information about from ') <strong>{{ config('app.name') }}</strong>
                        </label>
                        @error('subscribe')
                            <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="submit-section">
                        <button type="button" wire:click="previousStep" class="submit-btn mr-2">
                            <i class="fas fa-arrow-left"></i> @lang('Previous')
                        </button>
                        <button type="submit" class="submit-btn" wire:loading.attr="disabled">
                            <span wire:loading wire:target="store">
                                <div class="loading-spinner"></div> @lang('Submitting')...
                            </span>
                            <span wire:loading.remove wire:target="store">
                                <i class="fas fa-paper-plane"></i> @lang('Submit')
                            </span>
                        </button>
                    </div>
                </div>
            @endif

            {{-- @if ($errors->any())
                <div class="error-alert">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>@lang('Please correct the errors in the form and try again.')</strong>
                </div>
            @endif --}}
        </form>
    </div>
</div>

