<div x-data="photoUpload" class="col-span-1">
    <label class="block text-gray-700 text-sm font-bold mb-1" for="photo">Photo</label>
    <div class="w-full justify-center border rounded-md p-1 border-gray-500 row-span-3">
        <img :src="photoUrl" alt="Profile photo preview" class="w-48 h-48 object-cover mx-auto rounded-full">
    </div>

    <!-- Input photo -->
    <input type="file" @change="previewImage" id="photo" accept="image/*" 
        class="my-1 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-violet-100"/>
    
    <!-- Error message -->
    <span x-show="photoError" class="text-red-500 text-sm">Veuillez télécharger une photo valide.</span>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('photoUpload', () => ({
            photoUrl: '{{ asset('images/user-90.png') }}', // Default image
            photoError: false,
            
            previewImage(event) {
                const file = event.target.files[0];
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = () => {
                        this.photoUrl = reader.result;
                        this.photoError = false;
                    };
                    reader.readAsDataURL(file);
                } else {
                    this.photoError = true;
                }
            }
        }));
    });
</script>