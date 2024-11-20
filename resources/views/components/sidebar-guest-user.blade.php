<aside id="application-sidebar-brand"
class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full  transform hidden xl:block xl:translate-x-0 xl:end-auto xl:bottom-0 fixed top-0 with-vertical h-screen z-[999] flex-shrink-0 border-r-[1px] w-[270px] border-gray-400  bg-white  left-sidebar   transition-all duration-300" >
<!-- ---------------------------------- -->
<!-- Start Vertical Layout Sidebar -->
<!-- ---------------------------------- -->
<div class="p-4" >
    
    <a href="../" class="text-nowrap  flex items-center justify-between  ">
        <div class=" !w-16 ">

            <x-application-logo class=""></x-application-logo>
        </div>
        <span class=" !text-bold">{{ config('app.name') }}</span>
    </a>
    
    
</div>
<div class="scroll-sidebar" data-simplebar="">
    <div class="px-6 mt-3" >
        <nav class=" w-full flex flex-col sidebar-nav">
            <ul  id="sidebarnav" class="text-gray-600 text-sm">
                <li class="text-xs font-bold pb-4">
                    <i class="ti ti-dots nav-small-cap-icon text-lg hidden text-center"></i>
                    <span>ACCUEIL</span>
                </li>
                
                <li class="sidebar-item">
                    <a class="sidebar-link gap-3 py-2 px-3  rounded-md  w-full flex items-center hover:text-blue-600 hover:bg-blue-500" href="../index.html"
                    >
                    <i class="ti ti-layout-dashboard  text-xl"></i> <span>Dashboard</span>
                </a>
            </li>
            
            <li class="text-xs font-bold mb-4 mt-3">
                <i class="ti ti-dots nav-small-cap-icon text-lg hidden text-center"></i>
                <span>SERVICES </span>
            </li>
            
            <li class="sidebar-item">
                <a class="sidebar-link gap-3 py-2 px-3  rounded-md w-full flex items-center hover:text-blue-600 hover:bg-blue-500" href="../components/buttons.html"
                >
                <i class="ti ti-article  text-xl"></i> <span>Prestations</span>
            </a>
            
        
            <li class="sidebar-item">
                <a class="sidebar-link gap-3 py-2 px-3  rounded-md w-full flex items-center hover:text-blue-600 hover:bg-blue-500" href="../components/alerts.html"
                >
                <i class="ti ti-alert-circle  text-xl"></i> <span>Exclusions</span>
            </a>
            </li>        
    
            <li class="sidebar-item">
                <a class="sidebar-link gap-3 py-2 px-3  rounded-md w-full flex items-center hover:text-blue-600 hover:bg-blue-500" href="../components/cards.html"
                >
                <i class="ti ti-cards  text-xl"></i> <span>Informations</span>
            </a>
            </li>   


</ul>
</nav>
</div>
</div>

<!-- Bottom Upgrade Option -->
<div class="m-3  relative">
    <div class="bg-blue-500 px-5 py-2 rounded-md flex items-center justify-between">
        <div>
            <h5 class="text-base font-semibold text-gray-700 mb-3">Nous contacter</h5>
            <button class="text-xs font-semibold hover:bg-blue-700 text-white bg-blue-600 rounded-md  px-4 py-2">Contact</button>
        </div>
        <div class="-mt-20 -mr-2">
            <i class=" fa fa phone "></i>
        </div>
    </div>
</div>
</aside>