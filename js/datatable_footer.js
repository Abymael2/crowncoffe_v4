$(document).ready(function () {
    $('#datatable_footer').DataTable({
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
                footer: true,
                // exportar columnas especifica 
                exportOptions:
                    {
                        columns: [0, 1, 2, 3]
                    }
            }
        ],
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;

            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            // Total over all pages
            total = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Total over this page
            pageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            $( api.column( 3 ).footer() ).html(
                'Q'+ total
            );
        }
    });
});