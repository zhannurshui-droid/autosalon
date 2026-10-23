@if ($errors->any())
    <x-alert type="error">{{ __('Fix the errors in the form (:count)', ['count' => $errors->count()]) }}</x-alert>
@endif

<form method="POST" action="{{ $action }}" enctype="multipart/form-data">
    @csrf
    @isset($car)
        @method('PUT')
    @endisset

    <label>{{ __('Title') }}
        <input name="title" value="{{ old('title', $car->title ?? '') }}"
               @class(['invalid' => $errors->has('title')])>
    </label>
    @error('title') <div class="error">{{ $message }}</div> @enderror

    <label>{{ __('Brand') }}
        <select name="brand_id" @class(['invalid' => $errors->has('brand_id')])>
            @foreach ($brands as $brand)
                <option value="{{ $brand->id }}"
                    @selected(old('brand_id', $car->brand_id ?? '') == $brand->id)>
                    {{ $brand->name }}
                </option>
            @endforeach
        </select>
    </label>
    @error('brand_id') <div class="error">{{ $message }}</div> @enderror

    <label>{{ __('Year') }}
        <input type="number" name="year" value="{{ old('year', $car->year ?? '') }}"
               @class(['invalid' => $errors->has('year')])>
    </label>
    @error('year') <div class="error">{{ $message }}</div> @enderror

    <label>{{ __('Price, $') }}
        <input type="number" step="0.01" name="price" value="{{ old('price', $car->price ?? '') }}"
               @class(['invalid' => $errors->has('price')])>
    </label>
    @error('price') <div class="error">{{ $message }}</div> @enderror

    <label>{{ __('Mileage, km') }}
        <input type="number" name="mileage" value="{{ old('mileage', $car->mileage ?? '') }}"
               @class(['invalid' => $errors->has('mileage')])>
    </label>
    @error('mileage') <div class="error">{{ $message }}</div> @enderror

    <label>{{ __('Description') }}
        <textarea name="description" rows="4"
                  @class(['invalid' => $errors->has('description')])>{{ old('description', $car->description ?? '') }}</textarea>
    </label>
    @error('description') <div class="error">{{ $message }}</div> @enderror

    <label>{{ __('Photo') }}
        <input type="file" name="cover" accept="image/*"
               @class(['invalid' => $errors->has('cover')])>
    </label>
    @error('cover') <div class="error">{{ $message }}</div> @enderror

    @isset($car)
        @if ($car->cover)
            <label>
                <input type="checkbox" name="remove_cover" value="1">
                {{ __('Remove image') }}
            </label>
        @endif
    @endisset

    <label>{{ __('Document (PDF, up to 5 MB)') }}
        <input type="file" name="attachment" accept="application/pdf">
    </label>
    @error('attachment') <div class="error">{{ $message }}</div> @enderror

    <button>{{ __('Save') }}</button>
</form>