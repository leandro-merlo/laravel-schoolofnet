<div class="form-group{{ $errors->has("$field") ? ' has-error' : '' }}">
    {{ $slot }}
    @include('forms._helpblock', ['field', $field])
</div>