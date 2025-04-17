@extends('layouts.back')

@section('subtitle', __('Edit News'))

@section('content')
    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header"
                        style="background-color: #2A2E45; color: #F8F9FA; border-bottom: 2px solid #FF6B35;">
                        <h4>@lang('Edit News')</h4>
                    </div>
                    <div class="card-body">
                        @livewire('admin.edit-news', ['news' => $news])
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
