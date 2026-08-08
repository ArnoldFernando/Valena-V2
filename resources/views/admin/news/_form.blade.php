{{-- Shared news form fields --}}
<div style="margin-bottom: 1.5rem;">
    <label style="display: block; font-weight: 600; font-size: 0.875rem; color: #1f2937; margin-bottom: 0.5rem;">Article Title<span style="color: #ef4444;">*</span></label>
    <input type="text" name="name" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; color: #1f2937; font-family: inherit; transition: all 0.2s;" 
        value="{{ old('name', $news?->name) }}" required
        onfocus="this.style.borderColor='#5c2d0e'; this.style.boxShadow='0 0 0 3px rgba(92, 45, 14, 0.1)';" onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
    @error('name')
        <div style="color: #dc2626; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
    @enderror
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
    <div>
        <label style="display: block; font-weight: 600; font-size: 0.875rem; color: #1f2937; margin-bottom: 0.5rem;">Publish Date<span style="color: #ef4444;">*</span></label>
        <input type="date" name="date" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; color: #1f2937; font-family: inherit; transition: all 0.2s;" 
            value="{{ old('date', $news?->date?->format('Y-m-d')) }}" required
            onfocus="this.style.borderColor='#5c2d0e'; this.style.boxShadow='0 0 0 3px rgba(92, 45, 14, 0.1)';" onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
        @error('date')
            <div style="color: #dc2626; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
        @enderror
    </div>
</div>

<div style="margin-bottom: 1.5rem;">
    <label style="display: block; font-weight: 600; font-size: 0.875rem; color: #1f2937; margin-bottom: 0.5rem;">Short Introduction<span style="color: #ef4444;">*</span></label>
    <input type="text" name="intro_description" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; color: #1f2937; font-family: inherit; transition: all 0.2s;" 
        value="{{ old('intro_description', $news?->intro_description) }}" required placeholder="Brief summary of the article"
        onfocus="this.style.borderColor='#5c2d0e'; this.style.boxShadow='0 0 0 3px rgba(92, 45, 14, 0.1)';" onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
    @error('intro_description')
        <div style="color: #dc2626; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
    @enderror
</div>

<div style="margin-bottom: 1.5rem;">
    <label style="display: block; font-weight: 600; font-size: 0.875rem; color: #1f2937; margin-bottom: 0.5rem;">Full Article<span style="color: #ef4444;">*</span></label>
    <textarea name="full_description" rows="8" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; color: #1f2937; font-family: inherit; transition: all 0.2s; resize: vertical;" 
        required placeholder="Write the complete article here..."
        onfocus="this.style.borderColor='#5c2d0e'; this.style.boxShadow='0 0 0 3px rgba(92, 45, 14, 0.1)';" onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">{{ old('full_description', $news?->full_description) }}</textarea>
    @error('full_description')
        <div style="color: #dc2626; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
    @enderror
</div>

<div style="margin-bottom: 1.5rem;">
    <label style="display: block; font-weight: 600; font-size: 0.875rem; color: #1f2937; margin-bottom: 0.75rem;">Cover Image</label>
    @if ($news?->image)
        <div style="margin-bottom: 1rem; text-align: center;">
            <img src="{{ asset('storage/images/' . $news->image) }}" style="width: 150px; height: 100px; border-radius: 10px; object-fit: cover; border: 1px solid #e5e7eb;" alt="Article cover">
            <p style="font-size: 0.8rem; color: #6b7280; margin-top: 0.5rem;">Current cover image</p>
        </div>
    @endif
    <input type="file" name="image" style="width: 100%; padding: 0.75rem; border: 1px dashed #d1d5db; border-radius: 8px; font-size: 0.875rem; color: #6b7280; cursor: pointer;" accept="image/*">
    <p style="font-size: 0.8rem; color: #6b7280; margin-top: 0.5rem;">Recommended: 1200x600px, PNG or JPG</p>
</div>
