@props(['tabs' => []])

<style>
    .tabs-wrapper {
        overflow: hidden;
        position: relative;
        width: 100%;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .tabs-header {
        display: flex;
        justify-content: space-between;
        border-bottom: 2px solid #e5e7eb;
        background-color: #fff;
        border-radius: 8px 8px 0 0;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .tab-link {
        flex: 1;
        text-align: center;
        padding: 12px;
        font-size: 16px;
        font-weight: 500;
        color: #6b7280;
        cursor: pointer;
        transition: color 0.3s, background-color 0.3s;
        border-bottom: 3px solid transparent;
        white-space: nowrap;
    }

    .tab-link:hover {
        background-color: #f3f4f6;
    }

    .tab-link.active {
        color: #1f2937;
        font-weight: 600;
        border-bottom: 3px solid #007bff;
    }

    .tabs-content {
        display: flex;
        transition: transform 0.5s ease-in-out;
        width: 100%;
    }

    .tab-pane {
        flex: 0 0 100%;
        background-color: #fff;
        border-radius: 0 0 8px 8px;
    }

    @media (max-width: 768px) {
        .tabs-header {
            flex-wrap: nowrap; 
        }

        .tab-link {
            font-size: 14px;
            padding: 10px;
            min-width: 100px; 
        }

        .tabs-wrapper {
            overflow: visible;
        }

        .tabs-header {
            display: flex;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .tabs-content {
            display: block;
        }

        .tab-pane {
            display: none;
        }

        .tab-link.active + .tab-pane {
            display: block;
        }
    }

    @media (max-width: 480px) {
        .tabs-header {
            display: none;
        }

        .tabs-dropdown {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .tabs-dropdown select {
            width: 100%;
            font-size: 16px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabLinks = document.querySelectorAll('.tab-link');
        const tabsContent = document.querySelectorAll('.tab-pane');
    
        // Default active tab
        if (tabLinks.length > 0) {
            tabLinks[0].classList.add('active');
            tabsContent[0].style.display = 'block'; // Display the first tab content
        }
    
        tabLinks.forEach((link, index) => {
            link.addEventListener('click', function (event) {
                event.preventDefault();
    
                // Remove active class from all links and hide all content
                tabLinks.forEach((link) => link.classList.remove('active'));
                tabsContent.forEach((pane) => (pane.style.display = 'none'));
    
                // Add active class to the clicked link and display corresponding content
                link.classList.add('active');
                tabsContent[index].style.display = 'block'; // Show the current tab content
            });
        });
        
        // For the dropdown on small screens
        const tabsDropdown = document.querySelector('.tabs-dropdown select');
        if (tabsDropdown) {
            tabsDropdown.addEventListener('change', function () {
                const index = this.selectedIndex;
                tabLinks.forEach((link) => link.classList.remove('active'));
                tabLinks[index].classList.add('active');
                tabsContent.forEach((pane) => (pane.style.display = 'none')); // Hide all contents
                tabsContent[index].style.display = 'block'; // Show selected content
            });
        }
    });
</script>

<!-- Menu déroulant pour les petits écrans -->
<div class="tabs-dropdown block md:hidden transition-opacity duration-300 ease-in-out  md:opacity-100">
    <select class=" rounded-md border-gray-600">
        @foreach($tabs as $index => $title)
            <option value="{{ $index }}">{{ ucfirst($title) }}</option>
        @endforeach
    </select>
</div>

<div class="tabs">
    <div class="tabs-header hidden md:block transition-opacity duration-300 ease-in-out opacity-0 md:opacity-100">
        @foreach($tabs as $index => $title)
            <a href="#tab-{{ $index }}" class="tab-link">{{ ucfirst($title) }}</a>
        @endforeach
    </div>

    <!-- Contenus -->
    <div class="tabs-wrapper">
        <div class="tabs-content">
            {{ $slot }}
        </div>
    </div>
</div>