@if ($errors->any())
    <x-alert type="error">Исправьте ошибки в форме ({{ $errors->count() }})</x-alert>
@endif

<form method="POST" action="{{ $action }}" enctype="multipart/form-data">
    @csrf
    @isset($car)
        @method('PUT')
    @endisset

    <label>Название
        <input name="title" value="{{ old('title', $car->title ?? '') }}"
               @class(['invalid' => $errors->has('title')])>
    </label>
    @error('title') <div class="error">{{ $message }}</div> @enderror

    <label>Марка
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

    <label>Год
        <input type="number" name="year" value="{{ old('year', $car->year ?? '') }}"
               @class(['invalid' => $errors->has('year')])>
    </label>
    @error('year') <div class="error">{{ $message }}</div> @enderror

    <label>Цена, $
        <input type="number" step="0.01" name="price" value="{{ old('price', $car->price ?? '') }}"
               @class(['invalid' => $errors->has('price')])>
    </label>
    @error('price') <div class="error">{{ $message }}</div> @enderror

    <label>Пробег, км
        <input type="number" name="mileage" value="{{ old('mileage', $car->mileage ?? '') }}"
               @class(['invalid' => $errors->has('mileage')])>
    </label>
    @error('mileage') <div class="error">{{ $message }}</div> @enderror

    <label>Описание
        <textarea name="description" rows="4"
                  @class(['invalid' => $errors->has('description')])>{{ old('description', $car->description ?? '') }}</textarea>
    </label>
    @error('description') <div class="error">{{ $message }}</div> @enderror

    <label>Фото
    <input type="file" name="cover" accept="image/*"
           @class(['invalid' => $errors->has('cover')])>
@isset($car)
    <div class="mb-3">
    <label>Документ (PDF, до 5 МБ)</label>
    <input type="file" name="attachment" accept="application/pdf">
    @error('attachment') <div class="text-danger">{{ $message }}</div> @enderror
</div>
    @if ($car->cover)
        <label>
            <input type="checkbox" name="remove_cover" value="1">
            Удалить картинку
        </label>
    @endif
@endisset

<input type="file" name="cover" accept="image/*">
@error('cover') <div class="text-danger">{{ $message }}</div> @enderror

    <button>Сохранить</button>
</form>