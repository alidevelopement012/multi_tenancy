@extends('admin.layout')

@section('content')
    <div class="page-header">
        <h4 class="page-title">{{ __('Available Slots') }}</h4>
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
                <a href="#">{{ __('Available Slots') }}</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card-title d-inline-block">{{ __('Available Slots') }}</div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="slots">
                                @foreach ($slots as $slot)
                                    <div class="card mb-2 col-md-4">
                                        <div class="card-body">
                                            <h5>{{ $slot->title }}</h5>
                                            <p>
                                                {{ $slot->start_at->toDayDateTimeString() }} —
                                                {{ $slot->end_at->toDayDateTimeString() }}
                                                <br>
                                                Available: <span
                                                    id="available-{{ $slot->id }}">{{ $slot->availableCount() }}</span>
                                            </p>
                                            @if ($slot->isAvailable())
                                                <button class="btn btn-success btn-sm"
                                                    onclick="openBooking({{ $slot->id }}, '{{ addslashes($slot->title) }}')">Book</button>
                                            @else
                                                <button class="btn btn-secondary btn-sm" disabled>Full</button>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- booking modal (simple inline form) -->
    <div id="bookingModal"
        style="display:none; position:fixed; right:20px; top:20px; width:320px; background:#fff; border:1px solid #ccc; padding:15px; z-index:9999;">
        <h5 id="bm-title">Book Slot</h5>
        <form id="bookingForm">
            @csrf
            <input type="hidden" name="slot_id" id="bm-slot-id" />
            {{-- <div class="mb-2">
                <label>Quantity</label>
                <input type="number" name="quantity" id="bm-quantity" value="1" min="1" class="form-control" />
            </div> --}}
            <div class="mb-2">
                <label>Your name</label>
                <input type="text" name="meta[name]" class="form-control" required />
            </div>
            <div class="mb-2">
                <label>Email</label>
                <input type="email" name="meta[email]" class="form-control" required />
            </div>
            <div class="mb-2">
                <label>Phone</label>
                <input type="text" name="meta[phone]" class="form-control" />
            </div>

            <div id="bm-error" class="text-danger mb-2" style="display:none;"></div>

            <button type="submit" class="btn btn-primary">Confirm booking</button>
            <button type="button" class="btn btn-secondary" onclick="closeBooking()">Close</button>
        </form>
    </div>

    <script>
        function openBooking(slotId, title) {
            document.getElementById('bm-title').innerText = 'Book: ' + title;
            document.getElementById('bm-slot-id').value = slotId;
            document.getElementById('bookingModal').style.display = 'block';
        }

        function closeBooking() {
            document.getElementById('bookingModal').style.display = 'none';
        }

        document.getElementById('bookingForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const form = e.target;
            const data = new FormData(form);

            // check availability first (optional)
            const slotId = data.get('slot_id');
            const quantity = data.get('quantity') || 1;

            try {
                const check = await fetch("{{ route('admin.booking.check') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: new URLSearchParams({
                        slot_id: slotId,
                        quantity: quantity
                    })
                });
                const checkJson = await check.json();
                if (!checkJson.available) {
                    document.getElementById('bm-error').innerText =
                        'Slot no longer has capacity. Please choose another.';
                    document.getElementById('bm-error').style.display = 'block';
                    return;
                }

                // create booking
                const payload = new URLSearchParams();
                for (const pair of data.entries()) {
                    payload.append(pair[0], pair[1]);
                }
                const res = await fetch("{{ route('admin.booking.book') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: payload
                });
                const js = await res.json();
                if (js.success) {
                    alert('Booked! Reference: ' + js.booking_id);
                    closeBooking();
                    // update available display
                    document.getElementById('available-' + slotId).innerText = Math.max(0, checkJson
                        .available_count - quantity);
                } else {
                    document.getElementById('bm-error').innerText = js.message || 'Booking failed';
                    document.getElementById('bm-error').style.display = 'block';
                }
            } catch (err) {
                console.error(err);
                document.getElementById('bm-error').innerText = 'Unexpected error.';
                document.getElementById('bm-error').style.display = 'block';
            }
        });
    </script>
@endsection

@section('scripts')
<script src="{{ asset('assets/admin/js/packages.js') }}"></script>
@endsection
