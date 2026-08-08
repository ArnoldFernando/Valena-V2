{{-- Shared form fields for create & edit --}}
<div style="margin-bottom: 1.5rem;">
    <label
        style="display: block; font-weight: 600; font-size: 0.875rem; color: #1f2937; margin-bottom: 0.5rem;">Supplier<span
            style="color: #ef4444;">*</span></label>
    <select name="sup_id"
        style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; color: #1f2937; font-family: inherit; transition: all 0.2s; background-color: #fff;"
        class="@error('sup_id') is-invalid @enderror" required
        onchange="this.style.borderColor = this.value ? '#5c2d0e' : '#d1d5db';"
        onfocus="this.style.borderColor='#5c2d0e'; this.style.boxShadow='0 0 0 3px rgba(92, 45, 14, 0.1)';"
        onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
        <option value="">— Select Supplier —</option>
        @foreach ($suppliers as $sup)
            <option value="{{ $sup->sup_id }}" @selected(old('sup_id', $product?->sup_id) == $sup->sup_id)>{{ $sup->title }}</option>
        @endforeach
    </select>
    @error('sup_id')
        <div style="color: #dc2626; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
    @enderror
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
    <div>
        <label
            style="display: block; font-weight: 600; font-size: 0.875rem; color: #1f2937; margin-bottom: 0.5rem;">Product
            Name<span style="color: #ef4444;">*</span></label>
        <input type="text" name="title"
            style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; color: #1f2937; font-family: inherit; transition: all 0.2s;"
            value="{{ old('title', $product?->title) }}" required
            onfocus="this.style.borderColor='#5c2d0e'; this.style.boxShadow='0 0 0 3px rgba(92, 45, 14, 0.1)';"
            onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
        @error('title')
            <div style="color: #dc2626; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label
            style="display: block; font-weight: 600; font-size: 0.875rem; color: #1f2937; margin-bottom: 0.5rem;">Weight/Slogan<span
                style="color: #ef4444;">*</span></label>
        <input type="text" name="slogan"
            style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; color: #1f2937; font-family: inherit; transition: all 0.2s;"
            value="{{ old('slogan', $product?->slogan) }}" required
            onfocus="this.style.borderColor='#5c2d0e'; this.style.boxShadow='0 0 0 3px rgba(92, 45, 14, 0.1)';"
            onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
        @error('slogan')
            <div style="color: #dc2626; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
        @enderror
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
    <div>
        <label
            style="display: block; font-weight: 600; font-size: 0.875rem; color: #1f2937; margin-bottom: 0.5rem;">Price
            (₱)<span style="color: #ef4444;">*</span></label>
        <input type="number" name="price" step="0.01" min="0"
            style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; color: #1f2937; font-family: inherit; transition: all 0.2s;"
            value="{{ old('price', $product?->price) }}" required
            onfocus="this.style.borderColor='#5c2d0e'; this.style.boxShadow='0 0 0 3px rgba(92, 45, 14, 0.1)';"
            onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
        @error('price')
            <div style="color: #dc2626; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label
            style="display: block; font-weight: 600; font-size: 0.875rem; color: #1f2937; margin-bottom: 0.5rem;">Stocks<span
                style="color: #ef4444;">*</span></label>
        <input type="number" name="stocks" min="0"
            style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; color: #1f2937; font-family: inherit; transition: all 0.2s;"
            value="{{ old('stocks', $product?->stocks) }}" required
            onfocus="this.style.borderColor='#5c2d0e'; this.style.boxShadow='0 0 0 3px rgba(92, 45, 14, 0.1)';"
            onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
        @error('stocks')
            <div style="color: #dc2626; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label
            style="display: block; font-weight: 600; font-size: 0.875rem; color: #1f2937; margin-bottom: 0.5rem;">Promo
            Status</label>
        <select name="promo_status"
            style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; color: #1f2937; font-family: inherit; transition: all 0.2s; background-color: #fff;"
            onfocus="this.style.borderColor='#5c2d0e'; this.style.boxShadow='0 0 0 3px rgba(92, 45, 14, 0.1)';"
            onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
            <option value="No" @selected(old('promo_status', $product?->promo_status ?? 'No') === 'No')>No</option>
            <option value="Yes" @selected(old('promo_status', $product?->promo_status) === 'Yes')>Yes</option>
        </select>
    </div>
</div>

<div style="margin-bottom: 1.5rem;">
    <label
        style="display: block; font-weight: 600; font-size: 0.875rem; color: #1f2937; margin-bottom: 0.75rem;">Product
        Image</label>
    @if ($product?->img)
        <div style="margin-bottom: 1rem; text-align: center;">
            <img src="{{ asset('storage/images/' . $product->img) }}"
                style="width: 120px; height: 120px; border-radius: 10px; object-fit: cover; border: 1px solid #e5e7eb;"
                alt="Product">
            <p style="font-size: 0.8rem; color: #6b7280; margin-top: 0.5rem;">Current image</p>
        </div>
    @endif
    <input type="file" name="img"
        style="width: 100%; padding: 0.75rem; border: 1px dashed #d1d5db; border-radius: 8px; font-size: 0.875rem; color: #6b7280; cursor: pointer;"
        accept="image/*">
    <p style="font-size: 0.8rem; color: #6b7280; margin-top: 0.5rem;">Recommended: 500x500px, PNG or JPG</p>
    @error('img')
        <div style="color: #dc2626; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
    @enderror
</div>
