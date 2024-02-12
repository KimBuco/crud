
// console.log('Hi Im inside the www directory');

$(document).ready(function() {

    var dataTable = $('#users').DataTable( {
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "ajax":{
            url : dataTableAjaxUrl,
            type: "post",
            headers: {
                'X-CSRF-Token': $('[name="_csrfToken"').val()
            },
            error: function(err){
                console.log(err);
            }
        },
        "columns": [
            {"data": 0},
            {"data": 1},
            {"data": 2},
            {"data": 3},
            {"data": 4, 
                "orderable": false,
                "searchable": false,                                                                                
                "render": function(data){
                    return data ? '<img src="/eacomm/crud/img/'+ data +'" width="50" alt="sample"/>'
                    : '<img src="/eacomm/crud/img/avatar_default.png" width="50" alt="sample"/>';
                }},
            {"data": null,
                "orderable": false,
                "searchable": false, 
                "render": function(row){
                    return '<a href="/eacomm/crud/users/view/' + row[0] + '" class="btn btn-primary mb-2 mb-md-0 text-decoration-none text-light">View</a>' +
                        '<a href="/eacomm/crud/users/Edit/' + row[0] + '" class="btn btn-warning mb-2 mb-md-0 text-decoration-none text-light">Edit</a>' +
                        '<button class="btn btn-danger delete-btn mb-2 mb-md-0" data-id="' + row[0] + '">Delete</button>';
                }
            },

        ]
    } );

    $( ".delete-btn" ).on( "click", function() {
        alert( "Handler for `click` called." );
        console.log('im click');
    
        } );


    // $(document).on('click', '.delete-btn', function (e) {
    //     e.preventDefault();
    //     var userId = $(this).attr('data-id');
    //     console.log(userId);

    // });
        

    $('#users').on('click', '.delete-btn', function() {
        
    var userId = $(this).data('id');
    var deleteUrl = deleteBaseUrl + '/' + userId;

    console.log(userId);
    if (confirm('Are you sure?')) {
        $.ajax({
            url: deleteUrl,
            type: 'POST',
            data: {
                '_csrfToken': $('[name="_csrfToken"]').val()
            },
            success: function() {
            window.location.reload();
            console.log('hi');

            },
            error: function(error) {
                console.error('Error deleting:', error);
            }
        });
    }
});




} );