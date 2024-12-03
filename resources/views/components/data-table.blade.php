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
    $(window).on('load', function () {
        const tableId = '{{ $id }}';
        const table = $(`#${tableId}`).DataTable({
            dom: 'Brtip',
            buttons: [
                { extend: 'print', text: '<i class="fa fa-print"></i>' },
                { extend: 'excelHtml5', text: '<i class="fa fa-file-excel-o"></i>' },
                { extend: 'pdfHtml5', text: '<i class="fa fa-file-pdf-o"></i>' },
            ],
            paging: true,
            ordering: true,
            info: false,
            scrollX: true,
            searching: true,
            lengthChange: true,
            lengthMenu: [10, 25, 50, 100],
            pagingType: 'simple_numbers',
            language: {
                processing: "Traitement en cours...",
                search: "Rechercher&nbsp;:",
                lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
                info: "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                infoEmpty: "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                infoFiltered: "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                loadingRecords: "Chargement en cours...",
                zeroRecords: "Aucun &eacute;l&eacute;ment &agrave; afficher",
                emptyTable: "Aucune donnée",
                paginate: {
                    first: "Premier",
                    previous: "Pr&eacute;c&eacute;dent",
                    next: "Suivant",
                    last: "Dernier",
                },
                aria: {
                    sortAscending: ": activer pour trier la colonne par ordre croissant",
                    sortDescending: ": activer pour trier la colonne par ordre décroissant",
                },
            },
        });
    
        $('#table-search').on('keyup', function () {
            table.search(this.value).draw();
        });
    
        $('#show-entries').on('change', function () {
            table.page.len(this.value).draw();
        });
    
        $('#print-btn').on('click', function () {
            table.button('.buttons-print').trigger();
        });
    
        $('#excel-btn').on('click', function () {
            table.button('.buttons-excel').trigger();
        });
    
        $('#pdf-btn').on('click', function () {
            table.button('.buttons-pdf').trigger();
        });
    });
    
    function redirectTo(url) {
        window.location.href = url;
    }
        
    document.querySelectorAll('button, form').forEach(element => {
        element.addEventListener('click', function (event) {
            event.stopPropagation();
        });
    });
    
</script>