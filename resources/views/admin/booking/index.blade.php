@extends('admin.layout')

@section('content')
    <div class="page-header">
        <h4 class="page-title">{{ __('Bookings') }}</h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="flaticon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">{{ __('Bookings') }}</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card-title d-inline-block">{{ __('Bookings') }}</div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-striped mt-3" id="basic-datatables">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{ __('Tenant') }}</th>
                                            <th scope="col">{{ __('Slot') }}</th>
                                            <th scope="col">{{ __('User') }}</th>
                                            <th scope="col">{{ __('Status') }}</th>
                                            <th scope="col">{{ __('Booked At') }}</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($bookings as $booking)
                                            <tr>
                                                <td>{{ $booking->tenant->first_name }}</td>
                                                <td>{{ $booking->slot->title }}</td>
                                                <td>{{ $booking->user->first_name }}</td>
                                                <td><span
                                                        class="badge {{ $booking->status == 'confirmed' ? 'badge-success' : 'badge-danger' }}">{{ $booking->status == 'confirmed' ? 'Confirmed' : 'Cancelled' }}</span>
                                                </td>
                                                <td>{{ $booking->booked_at }}</td>
                                                <td>
                                                    @if ($booking->status == 'confirmed')
                                                        <form action="{{ route('admin.booking.cancel', $booking) }}"
                                                            method="POST" id="ajaxForm" style="display:inline">
                                                            @csrf
                                                            <button class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Cancel Booking?')">Cancel</button>
                                                        </form>
                                                    @else
                                                        <button class="btn btn-sm btn-danger disable">Cancelled</button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">No Bookings available</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/admin/js/packages.js') }}"></script>
@endsection
