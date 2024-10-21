<div>

    <div class="image-upload shrink-0 rounded-full">

        @if ($photo)
            <img src="{{ $photo->temporaryUrl() }}" alt="Preview" class="w-48 h-48 object-cover mx-auto rounded-full">
        @else
            <img id="preview_img" src="{{ asset('images/user-90.png') }}" alt="Current profile photo" class="w-36 h-36 object-cover mx-auto rounded-full">
        @endif
    </div>
    <span class="sr-only">Choisir une image</span>
    <input type="file" wire:model="photo" wire:change="saveImage" id="photo" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full 
            file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 
            hover:file:bg-violet-100"
            accept="image/*"/>

</div>

