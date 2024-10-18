<div class="p-4">
    <form>
        <!-- Champ de fichier pour l'image -->
        <input type="file" wire:model="photo" id="photo" accept="image/*" class="block mb-4">
        
        <!-- Zone de prévisualisation de l'image -->
        @if ($photo)
            <img src="{{ $photo->temporaryUrl() }}" alt="Preview" class="w-48 h-48 object-cover rounded-full">
        @else
            <img id="preview_img" src="{{ asset('images/default.png') }}" alt="Current profile photo" class="w-48 h-48 object-cover rounded-full">
        @endif
    </form>
</div>
