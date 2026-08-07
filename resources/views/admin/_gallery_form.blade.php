{{-- Shared form for facilities & tourist spots --}}
<div class="mb-3">
    <label class="form-label">{{ $idLabel ?? 'Group ID' }} <small class="text-muted">(images with the same ID are shown as
            a gallery)</small></label>
    <input type="number" name="{{ $idField ?? 'fac_id' }}" class="form-control" required
        value="{{ old($idField ?? 'fac_id', $item?->{$idField ?? 'fac_id'}) }}">
</div>
<div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $item?->name) }}" required>
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label class="form-label">Short Description</label>
    <input type="text" name="intro_description" class="form-control @error('intro_description') is-invalid @enderror"
        value="{{ old('intro_description', $item?->intro_description) }}" required>
    @error('intro_description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label class="form-label">Full Description</label>
    <textarea name="full_description" rows="4" class="form-control @error('full_description') is-invalid @enderror"
        required>{{ old('full_description', $item?->full_description) }}</textarea>
    @error('full_description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label class="form-label">Image</label>
    @if ($item?->image)
        <div class="mb-2"><img src="{{ asset('storage/images/' . $item->image) }}" width="80" class="rounded"
                alt=""></div>
    @endif
    <input type="file" name="image" class="form-control" accept="image/*">
</div>
