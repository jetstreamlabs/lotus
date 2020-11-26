@foreach (session('flash_notification', collect())->toArray() as $message)
    <div id="toast-container" class="toast-top-right">
        <div class="toast
            toast-{{ $message['level'] }}
            {{ $message['important'] ? 'toast-important' : '' }}"
            aria-live="polite"
            role="alert">
            <div class="toast-message">{!! $message['message'] !!}</div>
        </div>
    </div>
@endforeach

{{ session()->forget('flash_notification') }}
