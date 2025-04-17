@extends('layouts.back')

@section('subtitle', __('News Details'))

@section('content')
    <div class="section-body py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-11 col-lg-9">
                    <div class="card shadow-lg modern-card">
                        <!-- Header -->
                        <div class="card-header elegant-header">
                            <h3 class="mb-0">{{ $news->title ?? __('No Title') }}</h3>
                        </div>

                        <div class="card-body px-4 py-5">
                            <!-- Section 1: News Image -->
                            <section class="mb-5">
                                <h4 class="section-title">@lang('News Image')</h4>
                                @if ($news->image)
                                    <div class="modern-image-container">
                                        <div class="image-wrapper">
                                            <img class="d-block gallery-image" src="{{ $news->image }}"
                                                alt="{{ $news->title ?? 'News Image' }}">
                                            <div class="image-overlay">
                                                <div class="overlay-content">
                                                    <h5>{{ $news->title ?? __('News Image') }}</h5>
                                                    <p>@lang('Featured Image')</p>
                                                </div>
                                            </div>
                                            <!-- Fullscreen Toggle -->
                                            <button class="fullscreen-toggle" aria-label="Toggle fullscreen">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path
                                                        d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                @else
                                    <p class="text-muted">@lang('No image associated with this news')</p>
                                @endif
                            </section>

                            <!-- Section 2: Key Information -->
                            <section class="mb-5">
                                <h4 class="section-title">@lang('Key Information')</h4>
                                <div class="row">
                                    <div class="col-md-6 detail-group">
                                        <div class="detail-item"><strong>@lang('Title'):</strong>
                                            {{ $news->title ?? 'N/A' }}</div>

                                        <div class="detail-item"><strong>@lang('Slug'):</strong>
                                            {{ $news->slug ?? 'N/A' }}</div>
                                    </div>
                                    <div class="col-md-6 detail-group">
                                        <div class="detail-item"><strong>@lang('Author'):</strong>
                                            {{ $news->user?->name ?? 'N/A' }}</div>
                                        <div class="detail-item"><strong>@lang('Status'):</strong>
                                            <span class="badge {{ $news->published_at ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $news->published_at ? __('Published') : __('Unpublished') }}
                                            </span>
                                        </div>
                                        <div class="detail-item"><strong>@lang('Published At'):</strong>
                                            {{ $news->published_at ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            </section>

                            <!-- Section 3: Content -->
                            <section class="mb-5">
                                <h4 class="section-title">@lang('Content')</h4>
                                <div class="row">
                                    <div class=" detail-group" style="text-align: justify;">
                                        <div class="detail-item"><strong>@lang('Content'):</strong>
                                            <div>{!! $news->content ?? 'N/A' !!}</div>
                                        </div>
                                    </div>

                                </div>
                            </section>

                            <!-- Section 4: Dates -->
                            <section class="mb-5">
                                <h4 class="section-title">@lang('Dates')</h4>
                                <div class="row">
                                    <div class="col-md-6 detail-group">
                                        <div class="detail-item"><strong>@lang('Created At'):</strong>
                                            {{ $news->created_at ?? 'N/A' }}</div>
                                    </div>
                                    <div class="col-md-6 detail-group">
                                        <div class="detail-item"><strong>@lang('Updated At'):</strong>
                                            {{ $news->updated_at ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            </section>
                        </div>

                        <div class="card-footer text-right elegant-footer">
                            <a href="{{ route('admin.news.index') }}" class="btn btn-cancel">@lang('Back')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        // Toggle fullscreen mode for the image
        document.querySelectorAll('.fullscreen-toggle').forEach(button => {
            button.addEventListener('click', function() {
                const imageWrapper = this.closest('.image-wrapper');
                imageWrapper.classList.toggle('fullscreen');

                const icon = this.querySelector('svg');
                if (imageWrapper.classList.contains('fullscreen')) {
                    icon.innerHTML =
                        '<path d="M8 3v3a2 2 0 0 1-2 2H3m18 0h-3a2 2 0 0 1-2-2V3m0 18v-3a2 2 0 0 1 2-2h3M3 16h3a2 2 0 0 1 2 2v3"/>';
                    document.body.style.overflow = 'hidden';
                } else {
                    icon.innerHTML =
                        '<path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"/>';
                    document.body.style.overflow = '';
                }
            });
        });
    </script>
@endpush

@push('css')
    <style>
        /* Styles for modern card and image display */
        .modern-card {
            border: none;
            border-radius: 15px;
            background: #ffffff;
            transition: all 0.3s ease;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .elegant-header {
            background: linear-gradient(135deg, #2A2E45 0%, #3A3F5A 100%);
            color: #F8F9FA;
            border-bottom: 2px solid #FF6B35;
            padding: 1.5rem 2rem;
            border-radius: 15px 15px 0 0;
        }

        .modern-image-container {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .modern-image-container:hover {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .image-wrapper {
            position: relative;
            width: 100%;
            padding-top: 56.25%;
            /* 16:9 Aspect Ratio */
            overflow: hidden;
            background: #f5f5f5;
        }

        .gallery-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            transition: transform 0.5s ease;
        }

        .image-wrapper:hover .gallery-image {
            transform: scale(1.05);
        }

        /* Image overlay */
        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0.3) 50%, transparent 100%);
            display: flex;
            align-items: flex-end;
            padding: 2rem;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .image-wrapper:hover .image-overlay {
            opacity: 1;
        }

        .overlay-content {
            color: white;
            transform: translateY(20px);
            transition: transform 0.3s ease 0.2s;
        }

        .image-wrapper:hover .overlay-content {
            transform: translateY(0);
        }

        .overlay-content h5 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .overlay-content p {
            font-size: 0.9rem;
            opacity: 0.8;
            margin-bottom: 0;
        }

        /* Fullscreen button */
        .fullscreen-toggle {
            position: absolute;
            bottom: 20px;
            right: 20px;
            width: 40px;
            height: 40px;
            background: rgba(0, 0, 0, 0.5);
            border: none;
            border-radius: 50%;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .image-wrapper:hover .fullscreen-toggle {
            opacity: 1;
        }

        .fullscreen-toggle:hover {
            background: rgba(0, 0, 0, 0.8);
            transform: scale(1.1);
        }

        /* Fullscreen mode */
        .image-wrapper.fullscreen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            border-radius: 0;
            padding-top: 0;
        }

        .image-wrapper.fullscreen .gallery-image {
            object-fit: contain;
        }

        /* Section styling */
        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #2A2E45;
            border-bottom: 2px solid #FF6B35;
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .detail-group {
            padding: 0 1rem;
        }

        .detail-item {
            margin-bottom: 1rem;
            font-size: 1rem;
            color: #2A2E45;
        }

        .detail-item strong {
            color: #FF6B35;
            margin-right: 0.5rem;
        }

        .elegant-footer {
            background: #f8f9fa;
            border-top: 2px solid #FF6B35;
            padding: 1rem 2rem;
            border-radius: 0 0 15px 15px;
        }

        .btn-cancel {
            background-color: #d3d3d3;
            color: #2A2E45;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-cancel:hover {
            background-color: #c0c0c0;
            color: #2A2E45;
            text-decoration: none;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .modern-image-container {
                max-width: 100%;
                border-radius: 8px;
            }

            .fullscreen-toggle {
                opacity: 1;
                width: 36px;
                height: 36px;
            }

            .section-title {
                font-size: 1.1rem;
            }

            .detail-item {
                font-size: 0.9rem;
            }

            .overlay-content h5 {
                font-size: 1.2rem;
            }
        }
    </style>
@endpush

