{{-- Shared form for facilities & tourist spots --}}
<div style="margin-bottom: 1.5rem;">
    <label style="display: block; font-weight: 600; font-size: 0.875rem; color: #1f2937; margin-bottom: 0.5rem;">{{ $idLabel ?? 'Group ID' }}<span style="color: #ef4444;">*</span></label>
    <input type="number" name="{{ $idField ?? 'fac_id' }}" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; color: #1f2937; font-family: inherit; transition: all 0.2s;" 
        required value="{{ old($idField ?? 'fac_id', $item?->{$idField ?? 'fac_id'}) }}"
        onfocus="this.style.borderColor='#5c2d0e'; this.style.boxShadow='0 0 0 3px rgba(92, 45, 14, 0.1)';" onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
    <p style="font-size: 0.8rem; color: #6b7280; margin-top: 0.5rem;">Items with the same ID will be grouped as a gallery</p>
</div>

<div style="margin-bottom: 1.5rem;">
    <label style="display: block; font-weight: 600; font-size: 0.875rem; color: #1f2937; margin-bottom: 0.5rem;">Name<span style="color: #ef4444;">*</span></label>
    <input type="text" name="name" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; color: #1f2937; font-family: inherit; transition: all 0.2s;" 
        value="{{ old('name', $item?->name) }}" required
        onfocus="this.style.borderColor='#5c2d0e'; this.style.boxShadow='0 0 0 3px rgba(92, 45, 14, 0.1)';" onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
    @error('name')
        <div style="color: #dc2626; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
    @enderror
</div>

<div style="margin-bottom: 1.5rem;">
    <label style="display: block; font-weight: 600; font-size: 0.875rem; color: #1f2937; margin-bottom: 0.5rem;">Short Description<span style="color: #ef4444;">*</span></label>
    <input type="text" name="intro_description" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; color: #1f2937; font-family: inherit; transition: all 0.2s;" 
        value="{{ old('intro_description', $item?->intro_description) }}" required placeholder="Brief overview"
        onfocus="this.style.borderColor='#5c2d0e'; this.style.boxShadow='0 0 0 3px rgba(92, 45, 14, 0.1)';" onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
    @error('intro_description')
        <div style="color: #dc2626; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
    @enderror
</div>

<div style="margin-bottom: 1.5rem;">
    <label style="display: block; font-weight: 600; font-size: 0.875rem; color: #1f2937; margin-bottom: 0.5rem;">Full Description<span style="color: #ef4444;">*</span></label>
    <textarea name="full_description" rows="6" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; color: #1f2937; font-family: inherit; transition: all 0.2s; resize: vertical;" 
        required placeholder="Detailed information..."
        onfocus="this.style.borderColor='#5c2d0e'; this.style.boxShadow='0 0 0 3px rgba(92, 45, 14, 0.1)';" onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">{{ old('full_description', $item?->full_description) }}</textarea>
    @error('full_description')
        <div style="color: #dc2626; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
    @enderror
</div>

<div style="margin-bottom: 1.5rem;">
    <label style="display: block; font-weight: 600; font-size: 0.875rem; color: #1f2937; margin-bottom: 0.75rem;">Image</label>
    @if ($item?->image)
        <div style="margin-bottom: 1rem; text-align: center;">
            <img src="{{ asset('storage/images/' . $item->image) }}" style="width: 150px; height: 120px; border-radius: 10px; object-fit: cover; border: 1px solid #e5e7eb;" alt="">
            <p style="font-size: 0.8rem; color: #6b7280; margin-top: 0.5rem;">Current image</p>
        </div>
    @endif
    <input type="file" name="image" style="width: 100%; padding: 0.75rem; border: 1px dashed #d1d5db; border-radius: 8px; font-size: 0.875rem; color: #6b7280; cursor: pointer;" accept="image/*">
    <p style="font-size: 0.8rem; color: #6b7280; margin-top: 0.5rem;">Recommended: 800x600px, PNG or JPG</p>
</div>
