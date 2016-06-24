var dataColumnsClosed = 0;

var TableDatatablesButtons = function () {

    var initTable1 = function () {
        var table = $('#locator_table');

        var oTable = table.dataTable({

            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoEmpty": "No entries found",
                "infoFiltered": "(filtered1 from _MAX_ total entries)",
                "lengthMenu": "_MENU_ entries",
                "search": "Search:",
                "zeroRecords": "No matching records found"
            },

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            buttons: [
                { extend: 'print', className: 'btn dark btn-outline', link: 'aaa' },
                { extend: 'copy', className: 'btn red btn-outline' },
                { extend: 'pdf', className: 'btn green btn-outline' },
                { extend: 'csv', className: 'btn purple btn-outline ' },
                {
                    text: 'Excel',
                    className: 'btn yellow btn-outline ',
                    action: function ( e, dt, node, config ) {
                        window.location = '/backend/locator/data?length=100000&start=0&draw=excel';
                    }
                },
                { extend: 'colvis', className: 'btn dark btn-outline', text: 'Columns'},
                {
                    text: 'All columns',
                    className: 'btn green btn-outline ',
                    action: function ( e, dt, node, config ) {
                        e.preventDefault();

                        tbl = $('#locator_table').DataTable();

                        if( dataColumnsClosed == 1 ){
                            cl = true;
                            dataColumnsClosed = 0;
                        } else {
                            cl = false;
                            dataColumnsClosed = 1;
                        }


                        tbl.columns(  ).visible( cl );
                    }
                }
            ],

            // setup responsive extension: http://datatables.net/extensions/responsive/
            responsive: false,

            "ordering": true,

            "order": [
                [0, 'desc']
            ],


            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 10,

            "ajax": '/backend/locator/data',

            "processing": true,
            "serverSide": true,

            "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
        });
    }

    return {

        //main function to initiate the module
        init: function () {

            if (!jQuery().dataTable) {
                return;
            }

            initTable1();
        }

    };

}();

jQuery(document).ready(function() {
    TableDatatablesButtons.init();
});