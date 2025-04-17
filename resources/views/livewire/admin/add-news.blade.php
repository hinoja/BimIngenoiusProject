<div class="container py-8">
    <!-- Card Body -->
    <div class="card-body px-6 py-8 bg-gray-100">
        <form wire:submit.prevent="save" class="space-y-8" enctype="multipart/form-data">
            <!-- Titles -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="form-group">
                    <input type="text" class="form-control modern-input" id="fr_title" wire:model.blur="fr_title"
                        required aria-describedby="fr_title_error">
                    <label for="fr_title" class="form-label">@lang('French Title')</label>
                    <span class="char-counter" wire:dirty wire:target="fr_title">{{ strlen($fr_title) }}/255</span>
                    @error('fr_title')
                        <span class="error-feedback" id="fr_title_error" role="alert">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" class="form-control modern-input" id="en_title" wire:model.blur="en_title"
                        required aria-describedby="en_title_error">
                    <label for="en_title" class="form-label">@lang('English Title')</label>
                    <span class="char-counter" wire:dirty wire:target="en_title">{{ strlen($en_title) }}/255</span>
                    @error('en_title')
                        <span class="error-feedback" id="en_title_error" role="alert">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Descriptions (Vertical Layout) -->
            <div class="space-y-6">
                <!-- French Content -->
                <div class="form-group bg-white rounded-xl p-4 shadow-sm">
                    <label for="fr_content" class="block text-ff6b35 font-semibold mb-2">@lang('French Content')</label>
                    <textarea class="form-control modern-input summernote" id="fr_content" wire:model.debounce.500ms="fr_content"
                        rows="6"></textarea>
                    <span
                        class="char-counter inline-block mt-1 text-sm text-gray-600">{{ strlen(strip_tags($fr_content)) }}
                        @lang('characters')</span>
                    @error('fr_content')
                        <span class="error-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- English Content -->
                <div class="form-group bg-white rounded-xl p-4 shadow-sm">
                    <label for="en_content" class="block text-ff6b35 font-semibold mb-2">@lang('English Content')</label>
                    <textarea class="form-control modern-input summernote" id="en_content" wire:model.debounce.500ms="en_content"
                        rows="6"></textarea>
                    <span
                        class="char-counter inline-block mt-1 text-sm text-gray-600">{{ strlen(strip_tags($en_content)) }}
                        @lang('characters')</span>
                    @error('en_content')
                        <span class="error-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Single Image Upload with Preview -->
            <div class="form-group bg-white rounded-xl p-4 shadow-sm">
                <label class="form-label text-ff6b35 mb-3 block font-semibold">@lang('Featured Image')</label>
                <div class="custom-file">
                    <input type="file" wire:model="image"
                        class="custom-file-input @error('image') is-invalid @enderror" id="image" accept="image/*">
                    <label class="custom-file-label" for="image">@lang('Choose an image')</label>
                    @error('image')
                        <span class="error-feedback">{{ $message }}</span>
                    @enderror
                </div>
                @if ($image)
                    <div class="image-preview-container mt-3">
                        <img src="{{ $image->temporaryUrl() }}" class="image-preview" alt="Image Preview">
                        <span class="remove-image" wire:click="removeImage">×</span>
                    </div>
                @endif
            </div>

            <!-- Enhanced Tags Section -->
            <div class="form-group bg-white rounded-xl p-4 shadow-sm" wire:ignore>
                <div class="flex items-center justify-between mb-3">
                    <label for="tags" class="form-label text-ff6b35 font-semibold">@lang('Tags')</label>
                </div>
                <select id="select-state" multiple autocomplete="off"
                    class="tom-select modern-input select-custom w-full" id="tags" wire:model="tags" multiple>
                    <option value="" disabled selected>Sélectionner des mots-clés</option>
                    @foreach ($availableTags as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
                <small class="text-gray-500 mt-1 block">@lang('Select or type to search tags (max 10)')</small>
                @error('tags')
                    <span class="error-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Publish Toggle -->
            <div class="form-group modern-check bg-white rounded-xl p-4 shadow-sm flex items-center">
                <input type="checkbox" class="form-check-input" id="publish_now" wire:model="publish_now">
                <label class="form-check-label text-ff6b35 ml-3 font-semibold"
                    for="publish_now">@lang('Publish Immediately')</label>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-4">
                <a href="{{ route('admin.news.index') }}" class="btn btn-cancel flex items-center gap-2">
                    <i class="fas fa-times"></i> @lang('Cancel')
                </a>
                <button type="submit" class="btn btn-primary flex items-center gap-2" wire:loading.attr="disabled">
                    <span wire:loading wire:target="save">
                        <i class="fas fa-spinner fa-spin"></i> @lang('Saving...')
                    </span>
                    <span wire:loading.remove wire:target="save">
                        <i class="fas fa-save"></i> @lang('Recording a news item')
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>

@push('css')
    {{-- <link href="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/css/tom-select.bootstrap4.min.css" rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/js/tom-select.complete.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet"
        media="print" onload="this.media='all'; this.onload=null;">
    <link href="https://cdn.tailwindcss.com/3.4.1" rel="stylesheet" media="print"
        onload="this.media='all'; this.onload=null;">
    <style>
        :root {
            --primary: #FF6B35;
            --dark: #2A2E45;
            --light: #F8F9FA;
            --gray: #6b7280;
        }

        .card-body {
            background: var(--light);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .modern-input {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            background: #fff;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.03);
        }

        .modern-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 6px rgba(255, 107, 53, 0.3), inset 0 1px 3px rgba(0, 0, 0, 0.03);
            outline: none;
        }

        .form-label {
            color: var(--gray);
            font-weight: 500;
        }

        .char-counter {
            font-size: 0.85rem;
            color: var(--gray);
        }

        .error-feedback {
            display: block;
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            background: #fee2e2;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .custom-file-input {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            background: #fff;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            cursor: pointer;
        }

        .custom-file-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 6px rgba(255, 107, 53, 0.3);
            outline: none;
        }

        .custom-file-label {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            padding: 0.75rem 1rem;
            color: var(--gray);
            pointer-events: none;
            background: #fff;
            border-radius: 12px;
            text-align: left;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .image-preview {
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-height: 100px;
            object-fit: cover;
            border: 2px solid var(--primary);
            transition: transform 0.3s ease;
        }

        .image-preview:hover {
            transform: scale(1.05);
        }

        .remove-image {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 0.9rem;
            transition: transform 0.2s ease;
        }

        .remove-image:hover {
            transform: scale(1.1);
            background-color: #c82333;
        }

        /* Enhanced TomSelect Styles */
        /* .ts-control {
                min-height: 48px;
                border: 1px solid #e5e7eb;
                border-radius: 12px;
                padding: 0.5rem 1rem;
                background: #fff;
                transition: all 0.2s ease;
                box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.03);
            }

            .ts-control:focus-within {
                border-color: var(--primary);
                box-shadow: 0 0 6px rgba(255, 107, 53, 0.3);
            }

            .ts-control .item {
                background: var(--primary);
                color: var(--light);
                padding: 0.5rem 1rem;
                border-radius: 20px;
                font-size: 0.875rem;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                transition: background 0.2s ease;
            }

            .ts-control .item:hover {
                background: #e65a1e;
            }

            .ts-dropdown {
                border: 1px solid #e5e7eb;
                border-radius: 12px;
                background: #fff;
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
                max-height: 240px;
                overflow-y: auto;
                z-index: 1000;
            } */

        .modern-check .form-check-input {
            width: 1.5rem;
            height: 1.5rem;
            border: 2px solid var(--dark);
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .modern-check .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary {
            background: var(--primary);
            border: none;
            color: var(--light);
            padding: 0.75rem 2rem;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(255, 107, 53, 0.2);
        }

        .btn-primary:hover {
            background: #e65a1e;
            box-shadow: 0 6px 12px rgba(230, 90, 30, 0.3);
        }

        .btn-cancel {
            background: #e5e7eb;
            border: none;
            color: var(--dark);
            padding: 0.75rem 2rem;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-cancel:hover {
            background: #d1d5db;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .text-ff6b35 {
            color: var(--primary);
        }

        @media (max-width: 768px) {
            .card-body {
                padding: 1.5rem;
            }

            .btn-primary,
            .btn-cancel {
                padding: 0.75rem 1.5rem;
                font-size: 0.95rem;
            }

            .image-preview {
                max-height: 100px;
            }
        }
    </style>
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            initializeSummernote();

            Livewire.on('contentUpdated', (data) => {
                $(`#${data.editor}`).summernote('code', data.content);
            });
        });

        function initializeSummernote() {
            ['fr_content', 'en_content'].forEach(editorId => {
                $(`#${editorId}`).summernote({
                    height: 300,
                    placeholder: '@lang('Start typing...')',
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture']],
                        ['view', ['fullscreen', 'codeview', 'help']]
                    ],
                    callbacks: {
                        onChange: function(contents) {
                            @this.set(editorId, contents);
                        },
                        onInit: function() {
                            const content = @this.get(editorId);
                            if (content) {
                                $(this).summernote('code', content);
                            }
                        }
                    }
                });
            });
        }

        // Réinitialisation de Summernote après navigation
        document.addEventListener('livewire:navigated', () => {
            initializeSummernote();
        });
    </script>
    <script>
        // $('.select2').on('change', function() {
        //     @this.set($(this).attr('wire:model'), this.value);
        // });
        new TomSelect("#select-state", {
            maxItems: 5
        })
    </script>
@endpush
