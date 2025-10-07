<!doctype html>
<html>
<body>
    <h2>Booking confirmed</h2>
    <p>Hi {{ optional($booking->user)->name ?? ($booking->meta['name'] ?? 'Client') }},</p>

    <p>Your booking is confirmed:</p>
    <ul>
        <li>Slot: {{ $booking->slot->title }}</li>
        <li>Start: {{ $booking->slot->start_at->toDayDateTimeString() }}</li>
        <li>End: {{ $booking->slot->end_at->toDayDateTimeString() }}</li>
        <li>Quantity: {{ $booking->quantity }}</li>
    </ul>

    <p>Booking reference: #{{ $booking->id }}</p>

    <p>Thanks,</p>
    <p>{{ config('app.name') }}</p>
</body>
</html>
