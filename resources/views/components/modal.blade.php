<div id="confirmation-modal" class="fixed inset-0 flex items-center hidden justify-center bg-black bg-opacity-60 ">
    <div class="bg-white text-sm rounded-md shadow-md p-6 relative w-[90%] sm:w-[460px]">
        <div class="p-3 text-center">
            <i  class="fa-regular fa-times-circle   text-red-500 mx-auto" style="font-size:48px;"></i>
            <div class="mt-5 text-2xl">Etes-vous sûr?</div>
            <div class="mt-2 text-slate-500">
                Voulez-vous vraiment supprimer ce enregistrement? <br />
                Cette action est irreversible.
            </div>
        </div>
        <div class="flex items-center mx-auto justify-center px-5 pb-8 text-center">
            <div>
                <button id="close-modal" class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 dark:focus:ring-slate-700 dark:focus:ring-opacity-50 border-secondary text-slate-500 dark:border-darkmode-100/40 dark:text-slate-300 mr-1 w-24">
                    Annuler
                </button>
            </div>
            <div>

            </div>
        </div>
        <button id="close-modal-icon" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>
<script>
    document.getElementById('close-modal-icon').addEventListener('click', function () {
        document.getElementById('confirmation-modal').classList.add('hidden');
    });
    // Optional: Ensure the modal is hidden on page load
    window.addEventListener('load', function () {
        document.getElementById('confirmation-modal').classList.add('hidden');
    });
</script>