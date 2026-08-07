{{-- Shared news form fields --}}
<div class="mb-3">
    <label class="form-label">Title</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $news?->name) }}" required>
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label class="form-label">Publish Date</label>
    <input type="date" name="date" class="form-control @error('date') is-invalid @enderror"
        value="{{ old('date', $news?->date?->format('Y-m-d')) }}" required>
    @error('date')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label class="form-label">Short Introduction</label>
    <input type="text" name="intro_description" class="form-control @error('intro_description') is-invalid @enderror"
        value="{{ old('intro_description', $news?->intro_description) }}" required>
    @error('intro_description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label class="form-label">Full Article</label>
    <textarea name="full_description" rows="6" class="form-control @error('full_description') is-invalid @enderror"
        required>{{ old('full_description', $news?->full_description) }}</textarea>
    @error('full_description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label class="form-label">Cover Image</label>
    @if ($news?->image)
        <div class="mb-2"><img src="{{ asset('storage/images/' . $news->image) }}" width="80" class="rounded"
                alt=""></div>
    @endif
    <input type="file" name="image" class="form-control" accept="image/*">
</div>
