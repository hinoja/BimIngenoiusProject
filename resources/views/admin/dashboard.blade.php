@extends('layouts.back')

@section('subtitle', __('Dashboard'))

@section('content')

    <x-admin.section-header :title="__('Statistics')" :previousTitle="__('Dashboard')" :previousRouteName="route('admin.dashboard')" />

    <div class="section-body">
        <div class="container">
            <div class="row">
                <!-- Carte Utilisateurs -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
                    <div class="card card-statistic-1 shadow-sm">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-users" style="font-size: 2em; color: white;"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>@lang('Users')</h4>
                            </div>
                            <div class="card-body">
                                {{ $users ?? 'N/A' }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Carte Projets -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
                    <div class="card card-statistic-1 shadow-sm">
                        <div class="card-icon bg-success">
                            <i class="fas fa-tasks" style="font-size: 2em; color: white;"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>@lang('Projects')</h4>
                            </div>
                            <div class="card-body">
                                {{ $projects ?? 'N/A' }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Carte Catégories -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
                    <div class="card card-statistic-1 shadow-sm">
                        <div class="card-icon bg-info">
                            <i class="fas fa-tags" style="font-size: 2em; color: white;"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>@lang('Categories')</h4>
                            </div>
                            <div class="card-body">
                                {{ $categories ?? 'N/A' }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Carte Messages -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
                    <div class="card card-statistic-1 shadow-sm">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-envelope" style="font-size: 2em; color: white;"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>@lang('Messages')</h4>
                            </div>
                            <div class="card-body">
                                {{ $messages ?? 'N/A' }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Carte Plans -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
                    <div class="card card-statistic-1 shadow-sm">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-clipboard-list" style="font-size: 2em; color: white;"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>@lang('Plans')</h4>
                            </div>
                            <div class="card-body">
                                {{-- {{ formatMoney($money) ?? 'N/A' }} XAF --}}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Carte Actualités -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
                    <div class="card card-statistic-1 shadow-sm">
                        <div class="card-icon bg-secondary">
                            <i class="fas fa-newspaper" style="font-size: 2em; color: white;"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>@lang('News')</h4>
                            </div>
                            <div class="card-body">
                                {{ $CountJob ?? 'N/A' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sections supplémentaires pour graphiques -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                {{-- {!! $subscriptionsAccount->container() !!} --}}
            </div>
        </div>
        <div class="col-xl-8 col-md-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                    {{-- <div id="revenue">{!! $ChartUserData->container() !!}</div> --}}
                </div>
            </div>
        </div>
    </div>
 <br><br>
@endsection
