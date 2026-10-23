@if ($errors->any())
    <x-alert type="error">{{ __('Fix the errors in the form (:count)', ['count' => $errors->count()]) }}</x-alert>
@endif

<form method="POST" action="{{ $action }}">
    @csrf
    @isset($brand)
        @method('PUT')
    @endisset

    <label>{{ __('Title') }}
        <input name="name" value="{{ old('name', $brand->name ?? '') }}"
               @class(['invalid' => $errors->has('name')])>
    </label>
    @error('name') <div class="error">{{ $message }}</div> @enderror

    <label>{{ __('Description') }}
        <textarea name="description" rows="4"
                  @class(['invalid' => $errors->has('description')])>{{ old('description', $brand->description ?? '') }}</textarea>
    </label>
    @error('description') <div class="error">{{ $message }}</div> @enderror

    <button>{{ __('Save') }}</button>
</form>