@props(['status', 'message'])

@if ($message)
    <div class="alert alert-{{ $status }}" role="alert">
        {{ $message }}
    </div>
@endif
