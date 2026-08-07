{{-- Reused by create & edit for suppliers --}}
<div class="mb-3">
    <label class="form-label">Title</label>
    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
        value="{{ old('title', $supplier?->title) }}" required>
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
            value="{{ old('email', $supplier?->email) }}" required>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Phone</label>
        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
            value="{{ old('phone', $supplier?->phone) }}" required>
        @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label">Website URL</label>
        <input type="text" name="url" class="form-control" value="{{ old('url', $supplier?->url) }}">
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Opening Hours</label>
        <input type="text" name="o_hr" class="form-control" value="{{ old('o_hr', $supplier?->o_hr) }}">
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Closing Hours</label>
        <input type="text" name="c_hr" class="form-control" value="{{ old('c_hr', $supplier?->c_hr) }}">
    </div>
</div>
<div class="mb-3">
    <label class="form-label">Open Days</label>
    <input type="text" name="o_days" class="form-control" value="{{ old('o_days', $supplier?->o_days) }}"
        placeholder="e.g. Mon–Fri">
</div>
<div class="mb-3">
    <label class="form-label">Address</label>
    <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="2" required>{{ old('address', $supplier?->address) }}</textarea>
    @error('address')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label class="form-label">Logo / Image</label>
    @if ($supplier?->image)
        <div class="mb-2"><img src="{{ asset('storage/images/' . $supplier->image) }}" width="70" class="rounded"
                alt=""></div>
    @endif
    <input type="file" name="image" class="form-control" accept="image/*">
</div>
