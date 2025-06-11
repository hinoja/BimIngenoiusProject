@extends('layouts.back')

{{-- @section('subtitle', __('Quotes  list')) --}}

@section('title', __('Manage Quotes'))
@section('content')

    <x-admin.section-header :title="__('Quotation list')" :previousTitle="__('Dashboard')" :previousRouteName="route('admin.users.index')" />

    <div class="section-body">
        <div class="row">

                  @livewire('admin.manage-quotes')

        </div>
    </div>
@endsection


