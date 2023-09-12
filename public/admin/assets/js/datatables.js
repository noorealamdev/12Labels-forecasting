$(function (e) {
    'use strict';

    // basic datatable
    $('#datatable-basic').DataTable();
    // basic datatable

    // Items datatable
    $('#datatable-items').DataTable({
        dom: 'Blfrtip',
        stateSave: true,
        stateDuration: -1,
        buttons: [
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'colvis'
        ],
        "lengthMenu": [[30, 100 - 1], [30, 100, "All"]],
        "pageLength": 30,
        fixedColumns: {
            left: 1
        },
        scrollCollapse: true,
        scrollX: true,
        scrollY: 500
    });
    // Items datatable

    var itemsTable = $('#datatable-items').DataTable();
    $('body').on('change','#select-supplier',() => {
        var selectedText = $('#select-supplier').find(":selected").text();
        //console.log(selectedText);
        if (selectedText === 'All Suppliers') {
            //itemsTable.state.clear();
            //window.location.reload();
            itemsTable.columns(3).search('').draw();
        }
        else {
            itemsTable.columns(3).search(selectedText).draw();
        }
    });

    // Truncate long text in datatable column
    $("td.title-column").mouseenter(function() {
        $(this).attr("title", $(this).html());
    });

    //Column visibility on Item datatable


    // responsive datatable
    $('#responsiveDataTable').DataTable({
        responsive: true,
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
        },
        "pageLength": 10,
    });
    // responsive datatable

    // responsive modal datatable
    $('#responsivemodal-DataTable').DataTable({
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function (row) {
                        var data = row.data();
                        return data[0] + ' ' + data[1];
                    }
                }),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table'
                })
            }
        }
    });
    // responsive modal datatable

    // file export datatable
    $('#file-export').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        scrollX: true
    });
    // file export datatable

    // delete row datatable
    var table = $('#delete-datatable').DataTable({
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
        }
    });
    $('#delete-datatable tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    $('#button').on("click", function () {
        table.row('.selected').remove().draw(false);
    });
    // delete row datatable

    // scroll vertical 
    $('#scroll-vertical').DataTable({
        scrollY: '265px',
        scrollCollapse: true,
        paging: false,
        scrollX: true,
    });
    // scroll vertical 

    // hidden columns
    $('#hidden-columns').DataTable({
        columnDefs: [
            {
                target: 2,
                visible: false,
                searchable: false,
            },
            {
                target: 3,
                visible: false,
            },
        ],
        "pageLength": 10,
        scrollX: true
    });
    // hidden columns
    
    // add row datatable
    var t = $('#add-row').DataTable();
    var counter = 1;
    $('#addRow').on('click', function () {
        t.row.add([counter + '.1', counter + '.2', counter + '.3', counter + '.4', counter + '.5']).draw(false);
        counter++;
    });
    // add row datatable

});

