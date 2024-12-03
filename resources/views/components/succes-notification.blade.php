<!-- BEGIN: Notification Content -->
<div id="success-notification-content" class="fixed z-50 flex py-5 pl-5 text-sm border border-green-500 rounded-lg shadow-xl top-5 right-5 pr-14 bg-green-50 dark:bg-darkmode-600 dark:text-slate-300 dark:border-darkmode-600">
    <i data-tw-merge  class=" fa fa-check-circle stroke-1.5 w-5 h-5  text-green-500"></i>


    <div class="ml-3 mr-3 font-medium">
        <div class="">Requête réussie!</div>
        <div class="mt-1 text-slate-500">
            {{$slot}}
        </div>
    </div>
    <button id="close-notification" class="ml-auto text-gray-500 bg-transparent hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
        <i class="w-5 h-5 fa fa-times"></i>
    </button>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const notification = document.getElementById('success-notification-content');
        const closeBtn = document.getElementById('close-notification');
        
        notification.classList.remove('hidden');
        
        closeBtn.addEventListener('click', () => {
            notification.classList.add('hidden');
        });
    });
</script>
<!-- END: Notification Content -->
      