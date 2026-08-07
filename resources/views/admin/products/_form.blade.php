{{-- Shared form fields for create & edit --}}
<div class="mb-3">
    <label class="form-label">Supplier</label>
    <select name="sup_id" class="form-select @error('sup_id') is-invalid @enderror" required>
        <option value="">— Select Supplier —</option>
        @foreach ($suppliers as $sup)
            <option value="{{ $sup->sup_id }}" @selected(old('sup_id', $product?->sup_id) == $sup->sup_id)>{{ $sup->title }}</option>
        @endforeach
    </select>
    @error('sup_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="row">
    <div class="col-md-8 mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
            value="{{ old('title', $product?->title) }}" required>
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Slogan / Weight</label>
        <input type="text" name="slogan" class="form-control @error('slogan') is-invalid @enderror"
            value="{{ old('slogan', $product?->slogan) }}" required>
        @error('slogan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label">Price (₱)</label>
        <input type="number" name="price" step="0.01" min="0"
            class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product?->price) }}"
            required>
        @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Stocks</label>
        <input type="number" name="stocks" min="0" class="form-control @error('stocks') is-invalid @enderror"
            value="{{ old('stocks', $product?->stocks) }}" required>
        @error('stocks')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Promo</label>
        <select name="promo_status" class="form-select">
            <option value="No" @selected(old('promo_status', $product?->promo_status ?? 'No') === 'No')>No</option>
            <option value="Yes" @selected(old('promo_status', $product?->promo_status) === 'Yes')>Yes</option>
        </select>
    </div>
</div>
<div class="mb-3">
    <label class="form-label">Product Image</label>
    @if ($product?->img)
        <div class="mb-2"><img src="{{ asset('storage/images/' . $product->img) }}" width="80" class="rounded"
                alt=""></div>
    @endif
    <input type="file" name="img" class="form-control @error('img') is-invalid @enderror" accept="image/*">
    @error('img')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
