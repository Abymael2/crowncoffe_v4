$(document).ready(function () {
    $('#datatable').DataTable({
        "dom": 'B<"float-left"i><"float-right"f>t<"float-left"l><"float-right"p><"clearfix">',
        language: {
            "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
        },
        responsive: false,
        //dom: 'Bfrtilp',
        buttons:[
            {
                extend: 'copy',
                text: '<i class="bx bx-copy-alt"></i> Copiar',
                titleAttr: 'Copiar..',
                className: 'btn btn-outline-primary',
            },
            {
                extend: 'excel',
                text: '<i class="bx bx-table" ></i> Excel',
                titleAttr: 'Exportar a Excel..',
                className: 'btn btn-outline-primary',
            },
            {
                extend: 'pdf',
                text: '<i class="bx bxs-file-pdf"></i> PDF',
                titleAttr: 'Exportar a PDF..',
                className: 'btn btn-outline-primary',
            },
            {
                extend: 'print',
                text: '<i class="bx bx-printer" ></i> Imprimir',
                titleAttr: 'Imprimir..',
                className: 'btn btn-outline-primary',
            }
        ]
    });
});