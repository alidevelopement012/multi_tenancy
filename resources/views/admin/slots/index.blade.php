@extends('admin.layout')

@section('content')
    <div class="page-header">
        <h4 class="page-title">{{ __('Slots') }}</h4>
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
                <a href="#">{{ __('Slots') }}</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card-title d-inline-block">{{ __('Slots') }}</div>
                        </div>
                        <div class="col-lg-4 offset-lg-4 mt-2 mt-lg-0">
                            <a href="#" class="btn btn-primary float-right btn-sm" data-toggle="modal"
                                data-target="#createModal"><i class="fas fa-plus"></i>
                                {{ __('Add Slot') }}</a>
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
                                            <th scope="col">{{ __('Title') }}</th>
                                            <th scope="col">{{ __('Start') }}</th>
                                            <th scope="col">{{ __('End') }}</th>
                                            <th scope="col">{{ __('Capacity') }}</th>
                                            <th scope="col">{{ __('Available') }}</th>
                                            <th scope="col">{{ __('Active') }}</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($slots as $slot)
                                            <tr>
                                                <td>{{ $slot->title }}</td>
                                                <td>{{ $slot->start_at }}</td>
                                                <td>{{ $slot->end_at }}</td>
                                                <td>{{ $slot->capacity }}</td>
                                                <td>{{ $slot->availableCount() }}</td>
                                                <td>{{ $slot->active ? 'Yes' : 'No' }}</td>
                                                <td>
                                                    <a href="{{ route('admin.slots.edit', $slot) }}"
                                                        class="btn btn-sm btn-secondary">Edit</a>
                                                    <form action="{{ route('admin.slots.destroy', $slot) }}" method="POST"
                                                        style="display:inline">
                                                        @csrf @method('DELETE')
                                                        <button class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Delete slot?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">No slots available</td>
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

    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Add Slot') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="ajaxForm" enctype="multipart/form-data" class="modal-form"
                        action="{{ route('admin.slots.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">{{ __('Title') }}*</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                            <p id="errtitle" class="mb-0 text-danger em"></p>
                        </div>
                        {{-- <div class="form-group">
                            <label for="date">{{ __('Date') }}*</label>
                            <input type="date" name="date" id="date" class="form-control" required>
                            <p id="errdate" class="mb-0 text-danger em"></p>
                        </div> --}}
                        <div class="form-group">
                            <label for="start_at">{{ __('Start At') }}*</label>
                            <input type="datetime-local" name="start_at" id="start_at" class="form-control" required>
                            <p id="errstart_at" class="mb-0 text-danger em"></p>
                        </div>
                        <div class="form-group">
                            <label for="end_at">{{ __('End At') }}*</label>
                            <input type="datetime-local" name="end_at" id="end_at" class="form-control" required>
                            <p id="errend_at" class="mb-0 text-danger em"></p>
                        </div>
                        <div class="form-group">
                            <label for="capacity">{{ __('Capacity') }}*</label>
                            <input type="number" name="capacity" id="capacity" class="form-control" required>
                            <p id="errcapacity" class="mb-0 text-danger em"></p>
                        </div>
                        <div class="form-group">
                            <label for="buffer_minutes">{{ __('Buffer minutes') }}*</label>
                            <input type="number" name="buffer_minutes" id="buffer_minutes" class="form-control"
                                required>
                            <p id="errbuffer_minutes" class="mb-0 text-danger em"></p>
                        </div>
                        <div class="form-group">
                            <label for="notes">{{ __('Notes') }}*</label>
                            <textarea name="notes" id="notes" class="form-control" required></textarea>
                            <p id="errnotes" class="mb-0 text-danger em"></p>
                        </div>

                        <div class="form-group">
                            <label for="active">{{ __('Active') }}*</label>
                            <input type="checkbox" name="active" id="active" value="1" class="form-control"
                                required>
                            <p id="erractive" class="mb-0 text-danger em"></p>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                    <button id="submitBtn" type="button" class="btn btn-primary">{{ __('Submit') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/admin/js/packages.js') }}"></script>
@endsection
