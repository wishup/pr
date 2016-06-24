jQuery(document).ready(function() {

    var table = $('#reorder').DataTable( {
        rowReorder: true
    } );
    table.on( 'row-reorder', function ( e, details, changes ) {
        var indexes = {};
        $(this).find('tbody tr').each(function(){
            indexes[$(this).data('key')] = $(this).index();
        });
        console.log(indexes);

        $.ajax({
            type: "POST",
            url: "/backend/slides/reorder",
            data: { indexes : indexes }
        });
    } );
});