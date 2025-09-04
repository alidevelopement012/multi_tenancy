@extends('admin.layout')
@section('styles')
    <style>
        .hover {
            text-decoration: none !important;
        }

        .text-hover:hover {
            text-decoration: underline !important;
        }
    </style>
@endsection

@section('content')
    <div class="mt-2 mb-4">
        <h2 class="pb-2">{{ __('Welcome back') }}
            , {{ Auth::guard('admin')->user()->first_name }} {{ Auth::guard('admin')->user()->last_name }}!</h2>
    </div>
    <div class="row">

        <div class="col-sm-6 col-md-4">
            <a class="card card-stats card-info card-round hover" href="javascript:void(0)">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category text-hover">{{ __('Registered Users') }}</p>
                                <h4 class="card-title">15</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>



            <div class="col-sm-6 col-md-4">
                <a class="card card-stats card-warning card-round hover" href="javascript:void(0)">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-bacteria"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category text-hover">{{ __('Subscribers') }}</p>
                                    <h4 class="card-title">30</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>




            <div class="col-sm-6 col-md-4">
                <a class="card card-stats card-success card-round hover" href="javascript:void(0)">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-list-ul"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category text-hover">{{ __('Packages') }}</p>
                                    <h4 class="card-title">22</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>




            <div class="col-sm-6 col-md-4">
                <a class="card card-stats card-danger card-round hover" href="javascript:void(0)">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-money-check-alt"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category text-hover">{{ __('Payment Logs') }}</p>
                                    <h4 class="card-title">99</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>



            <div class="col-sm-6 col-md-4">
                <a class="card card-stats card-secondary card-round hover" href="javascript:void(0)">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-users-cog"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category text-hover">{{ __('Admins') }}</p>
                                    <h4 class="card-title">26</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>



            <div class="col-sm-6 col-md-4">
                <a class="card card-stats card-primary card-round hover"
                    href="javascript:void(0)">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-users-cog"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category text-hover">{{ __('Blog') }}</p>
                                    <h4 class="card-title">13</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

    </div>



    <div class="row">

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">{{ __('Monthly Income') }} ({{ date('Y') }})</div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="lineChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">{{ __('Monthly Premium Users') }} ({{ date('Y') }})</div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="usersChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/admin/js/plugin/chart.min.js') }}"></script>
    <script>
        "use strict";
        var months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
        var inTotals = [0,0,0,0,0,0,0,0,0,0,0,0];
        var userTotals = [0,0,0,0,0,0,0,2,0,0,0,0];
    </script>
    <script src="{{ asset('assets/admin/js/dashboard.js') }}"></script>
@endsection
