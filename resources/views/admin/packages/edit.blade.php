@extends('admin.layout')

@section('content')
    <div class="page-header">
        <h4 class="page-title">{{ __('Edit package') }}</h4>
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
                <a href="#">{{ __('Packages') }}</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">{{ __('Edit') }}</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title d-inline-block">{{ __('Edit package') }}</div>
                    <a class="btn btn-info btn-sm float-right d-inline-block" href="{{ route('admin.package.index') }}">
                        <span class="btn-label">
                            <i class="fas fa-backward"></i>
                        </span>
                        {{ __('Back') }}
                    </a>
                </div>
                <div class="card-body pt-5 pb-5">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <form id="ajaxForm" class="" action="{{ route('admin.package.update') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="package_id" value="{{ $package->id }}">
                                <div class="form-group">
                                    <label for="title">{{ __('Package title') }}*</label>
                                    <input id="title" type="text" class="form-control" name="title"
                                        value="{{ $package->title }}" placeholder="{{ __('Enter name') }}">
                                    <p id="errtitle" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group">
                                    <label for="price">{{ __('Price') }} *</label>
                                    <input id="price" type="number" class="form-control" name="price"
                                        placeholder="{{ __('Enter Package price') }}" value="{{ $package->price }}">
                                    <p class="text-warning mb-0">
                                        <small>{{ __('If price is 0 , then it will appear as free') }}</small></p>
                                    <p id="errprice" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group">
                                    <label for="plan_term">{{ __('Package term') }}*</label>
                                    <select id="plan_term" name="term" class="form-control">
                                        <option value="" selected disabled>{{ __('Select a Term') }}</option>
                                        <option value="month" {{ $package->term == 'month' ? 'selected' : '' }}>
                                            {{ __('month') }}</option>
                                        <option value="year" {{ $package->term == 'year' ? 'selected' : '' }}>
                                            {{ __('year') }}</option>
                                        <option value="lifetime" {{ $package->term == 'lifetime' ? 'selected' : '' }}>
                                            {{ 'lifetime' }}</option>
                                    </select>
                                    <p id="errterm" class="mb-0 text-danger em"></p>
                                </div>
                                @php
                                    $permissions = $package->features;
                                    if (!empty($package->features)) {
                                        $permissions = json_decode($permissions, true);
                                    }
                                @endphp

                                <div class="form-group" id="storage_input">
                                    <label for="storage_limit">{{ __('Storage Limit') }}*</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="storage_limit"
                                            placeholder="{{ __('Enter Storage Limit') }}"
                                            value="{{ $package->storage_limit }}">
                                        <span class="input-group-text" id="basic-addon2">MB</span>
                                    </div>
                                    <p id="errstorage_limit" class="mb-0 text-danger em"></p>
                                    <p class="text-warning mb-0">
                                        <small>{{ __('Enter 999999 , then it will appear as unlimited') }}</small>
                                    </p>
                                </div>
                                <div class="form-group" id="staff_input">
                                    <label for="staff_limit">{{ __('Staff Limit') }}*</label>
                                    <input id="staff_limit" type="number" class="form-control" name="staff_limit"
                                        placeholder="{{ __('Enter staff limit') }}" value="{{ $package->staff_limit }}">
                                    <p class="text-warning mb-0">
                                        <small>{{ __('Enter 999999 , then it will appear as unlimited') }}</small></p>
                                    <p id="errstaff_limit" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group" id="order_input">
                                    <label for="order_limit">{{ __('Number Of Orders Limit') }}*</label>
                                    <input id="order_limit" type="number" class="form-control" name="order_limit"
                                        placeholder="{{ __('Enter order limit') }}" value="{{ $package->order_limit }}">
                                    <p class="text-warning mb-0">
                                        <small>{{ __('Enter 999999 , then it will appear as unlimited') }}</small></p>
                                    <p id="errorder_limit" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group">
                                    <label for="categories_limit">{{ __('Number Of Categories Limit') }}*</label>
                                    <input id="categories_limit" type="number" class="form-control"
                                        name="categories_limit" placeholder="{{ __('Enter categories limit') }}"
                                        value="{{ $package->categories_limit }}">
                                    <p class="text-warning mb-0">
                                        <small>{{ __('Enter 999999 , then it will appear as unlimited') }}</small></p>
                                    <p id="errcategories_limit" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group">
                                    <label for="subcategories_limit">{{ __('Number Of Subcategories Limit') }}*</label>
                                    <input id="subcategories_limit" type="number" class="form-control"
                                        name="subcategories_limit" placeholder="{{ __('Enter subcategories limit') }}"
                                        value="{{ $package->subcategories_limit }}">
                                    <p class="text-warning mb-0">
                                        <small>{{ __('Enter 999999 , then it will appear as unlimited') }}</small></p>
                                    <p id="errsubcategories_limit" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group">
                                    <label for="items_limit">{{ __('Number Of Items Limit') }}*</label>
                                    <input id="items_limit" type="number" class="form-control" name="items_limit"
                                        placeholder="{{ __('Enter items limit') }}" value="{{ $package->items_limit }}">
                                    <p class="text-warning mb-0">
                                        <small>{{ __('Enter 999999 , then it will appear as unlimited') }}</small></p>
                                    <p id="erritems_limit" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group" id="table_reservation_input">
                                    <label
                                        for="table_reservation_limit">{{ __('Number Of Table Reservations Limit') }}*</label>
                                    <input id="table_reservation_limit" type="number" class="form-control"
                                        name="table_reservation_limit"
                                        placeholder="{{ __('Enter table reservation limit') }}"
                                        value="{{ $package->table_reservation_limit }}">
                                    <p class="text-warning mb-0">
                                        <small>{{ __('Enter 999999 , then it will appear as unlimited') }}</small></p>
                                    <p id="errtable_reservation_limit" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group">
                                    <label for="language_limit">{{ __('Number Of Languages Limit') }}*</label>
                                    <input id="language_limit" type="number" class="form-control" name="language_limit"
                                        placeholder="{{ __('Enter language limit') }}"
                                        value="{{ $package->language_limit }}">
                                    <p class="text-warning mb-0">
                                        <small>{{ __('Enter 999999 , then it will appear as unlimited') }}</small></p>
                                    <p id="errlanguage_limit" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">{{ __('Featured') }} *</label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="featured" value="1"
                                                class="selectgroup-input" {{ $package->featured == 1 ? 'checked' : '' }}>
                                            <span class="selectgroup-button">{{ __('Yes') }}</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="featured" value="0"
                                                class="selectgroup-input" {{ $package->featured == 0 ? 'checked' : '' }}>
                                            <span class="selectgroup-button">{{ __('No') }}</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Recommended *</label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="recommended" value="1"
                                                class="selectgroup-input"{{ $package->recommended == 1 ? 'checked' : '' }}>
                                            <span class="selectgroup-button">Yes</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="recommended" value="0"
                                                class="selectgroup-input"
                                                {{ $package->recommended == 0 ? 'checked' : '' }}>
                                            <span class="selectgroup-button">No</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Icon **</label>
                                    <div class="btn-group d-block">
                                        <button type="button" class="btn btn-primary iconpicker-component"><i
                                                class="{{ $package->icon }}"></i></button>
                                        <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                            data-selected="fa-car" data-toggle="dropdown">
                                        </button>
                                        <div class="dropdown-menu"></div>
                                    </div>
                                    <input id="inputIcon" type="hidden" name="icon" value="{{ $package->icon }}">
                                    @if ($errors->has('icon'))
                                        <p class="mb-0 text-danger">{{ $errors->first('icon') }}</p>
                                    @endif
                                    <div class="mt-2">
                                        <small>NB: click on the dropdown sign to select an icon.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status">{{ __('Status') }}*</label>
                                    <select id="status" class="form-control ltr" name="status">
                                        <option value="" selected disabled>{{ __('Select a status') }}</option>
                                        <option value="1" {{ $package->status == '1' ? 'selected' : '' }}>
                                            {{ __('Active') }}</option>
                                        <option value="0" {{ $package->status == '0' ? 'selected' : '' }}>
                                            {{ __('Deactive') }}</option>
                                    </select>
                                    <p id="errstatus" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group">
                                    <label for="meta_keywords">{{ __('Meta Keywords') }}</label>
                                    <input id="meta_keywords" type="text" class="form-control" name="meta_keywords"
                                        value="{{ $package->meta_keywords }}" data-role="tagsinput">
                                </div>
                                <div class="form-group">
                                    <label for="meta_description">{{ __('Meta Description') }}</label>
                                    <textarea id="meta_description" type="text" class="form-control" name="meta_description" rows="5">{{ $package->meta_description }}</textarea>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form">
                        <div class="form-group from-show-notify row">
                            <div class="col-12 text-center">
                                <button type="submit" id="submitBtn"
                                    class="btn btn-success">{{ __('Update') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const permission = @php echo json_encode($permissions) @endphp;
        const trialVal = {{ $package->is_trial }};
    </script>
    <script src="{{ asset('assets/admin/js/edit-package.js') }}"></script>

@endsection
