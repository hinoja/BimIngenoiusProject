@extends('layouts.back')

@section('subtitle', __('Edit News'))

@section('content')
    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header"
                        style="background-color: #2A2E45; color: #F8F9FA; border-bottom: 2px solid #FF6B35;">
                        <h4><i class="fas fa-edit"></i> @lang('Edit News')</h4>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body px-6 py-8 bg-gray-100">
                        <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data"
                            class="space-y-8">
                            @csrf
                            @method('PUT')

                            <!-- Section: Titles -->
                            <div class="section-card">
                                <div class="section-header">
                                    <i class="fas fa-heading"></i> @lang('Titles')
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="form-group">
                                        <input type="text"
                                            class="form-control modern-input @error('fr_title') is-invalid @enderror"
                                            id="fr_title" name="fr_title" value="{{ old('fr_title', $news->fr_title) }}"
                                            maxlength="255">
                                        <label for="fr_title" class="form-label">@lang('French Title')</label>
                                        <span class="char-counter">{{ strlen(old('fr_title', $news->fr_title)) }}/255
                                        </span>
                                        @error('fr_title')
                                            <span class="error-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="text"
                                            class="form-control modern-input @error('en_title') is-invalid @enderror"
                                            id="en_title" name="en_title" value="{{ old('en_title', $news->en_title) }}"
                                            maxlength="255">
                                        <label for="en_title" class="form-label">@lang('English Title')</label>
                                        <span class="char-counter">{{ strlen(old('en_title', $news->en_title)) }}/255
                                        </span>
                                        @error('en_title')
                                            <span class="error-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Section: Contents -->
                            <div class="section-card mt-0 pt-0">
                                <div class="section-header">
                                    <i class="fas fa-file-alt"></i> @lang('Contents')
                                </div>
                                <div class="space-y-6">
                                    <div class="form-group bg-white rounded-xl p-4 shadow-sm">
                                        <label for="fr_content"
                                            class="block text-ff6b35 font-semibold mb-2">@lang('French Content')</label>
                                        <input id="fr_content_input" type="hidden" name="fr_content"
                                            value="{{ old('fr_content', $news->fr_content) }}">
                                        <trix-editor input="fr_content_input"></trix-editor>
                                        @error('fr_content')
                                            <span class="error-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group bg-white rounded-xl p-4 shadow-sm">
                                        <label for="en_content"
                                            class="block text-ff6b35 font-semibold mb-2">@lang('English Content')</label>
                                        <input id="en_content_input" type="hidden" name="en_content"
                                            value="{{ old('en_content', $news->en_content) }}">
                                        <trix-editor input="en_content_input"></trix-editor>
                                        @error('en_content')
                                            <span class="error-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Section: Featured Image -->
                            <div class="section-card">
                                <div class="section-header">
                                    <i class="fas fa-image"></i> @lang('Featured Image')
                                </div>
                                <div class="form-group bg-white rounded-xl p-4 shadow-sm">
                                    @if ($news->image)
                                        <label class="form-label text-ff6b35 mb-3 block font-semibold">@lang('Current Image')
                                        </label>
                                        <div class="image-preview-container mb-3">
                                            <img src="{{ Storage::url($news->image) }}" class="image-preview"
                                                alt="Current Image">
                                        </div>
                                    @endif
                                    <label class="form-label text-ff6b35 mb-3 block font-semibold">@lang('Choose a new image')
                                    </label>
                                    <div class="custom-file">
                                        <input type="file" name="newImage"
                                            class="custom-file-input @error('newImage') is-invalid @enderror" id="newImage"
                                            accept="image/*">
                                        <label class="custom-file-label" for="newImage">@lang('Choose an image')</label>
                                        @error('newImage')
                                            <span class="error-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="flex justify-end gap-4">
                                <a href="{{ route('admin.news.index') }}" class="btn btn-cancel flex items-center gap-2">
                                    <i class="fas fa-times"></i> @lang('Cancel')
                                </a>
                                <button type="submit" class="btn btn-primary flex items-center gap-2">
                                    <i class="fas fa-save"></i> @lang('Update News')
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <style>
        trix-editor {
            min-height: 250px !important;
            max-height: 500px;
            overflow-y: auto;
            font-size: 1rem;
        }

        .section-card {
            margin-bottom: 20px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .section-header {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2A2E45;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .section-header i {
            margin-right: 10px;
            color: #FF6B35;
        }

        .form-group {
            position: relative;
            margin-bottom: 20px;
        }

        .modern-input {
            border: 1px solid #e5e7eb;
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .modern-input:focus {
            border-color: #FF6B35;
            outline: none;
        }

        .form-label {
            position: absolute;
            top: -10px;
            left: 15px;
            background-color: #ffffff;
            padding: 0 5px;
            font-size: 0.9rem;
            color: #2A2E45;
        }

        .char-counter {
            font-size: 0.8rem;
            color: #6c757d;
            position: absolute;
            right: 15px;
            bottom: -20px;
        }

        .error-feedback {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 5px;
            display: block;
        }

        .btn {
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-primary {
            background-color: #00AEEF;
            border-color: #00AEEF;
            color: #ffffff;
        }

        .btn-primary:hover {
            background-color: #008bbf;
            transform: scale(1.05);
        }

        .btn-cancel {
            background-color: #F8F9FA;
            border: 1px solid #e5e7eb;
            color: #2A2E45;
        }

        .btn-cancel:hover {
            background-color: #e5e7eb;
            transform: scale(1.05);
        }

        .image-preview {
            max-width: 200px;
            max-height: 200px;
            margin-top: 10px;
            border-radius: 5px;
        }

        .remove-image {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: #dc3545;
            color: #ffffff;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            text-align: center;
            line-height: 20px;
            cursor: pointer;
        }
    </style>
@endpush

@push('js')
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
@endpush
