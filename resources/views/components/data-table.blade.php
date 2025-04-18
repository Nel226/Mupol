@props(['id' => 'default-table', 'headers' => []])

<div class="overflow-x-auto">
    <table id="{{ $id }}" class="w-full text-sm text-left text-gray-500 border rtl:text-right dark:text-gray-400 display">
        <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                @foreach ($headers as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody class="text-xs">
            {{ $slot }}
        </tbody>
    </table>
</div>
<script>
 
    function redirectTo(url) {
        window.location.href = url;
    }
        
    document.querySelectorAll('button, form').forEach(element => {
        element.addEventListener('click', function (event) {
            event.stopPropagation();
        });
    });
    $(document).on('click', '.row-checkbox', function (e) {
        e.stopPropagation();
    });

</script>