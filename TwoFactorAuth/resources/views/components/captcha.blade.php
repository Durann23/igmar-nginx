<div class="mb-3">
    {!! NoCaptcha::renderJs('es', false) !!}
    {!! NoCaptcha::display() !!}
    @error('g-recaptcha-response')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>