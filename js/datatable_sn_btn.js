//datatables sin botones
$(document).ready(function () {
    $('#datatable_sn_btn').DataTable({
        "dom": 'B<"float-left"i><"float-right"f>t<"float-left"l><"float-right"p><"clearfix">',
        language: {
            "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
        },
        responsive: true,
        //dom: 'Bfrtilp',
        buttons:[
            
        ]
    });
});