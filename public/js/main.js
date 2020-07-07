$(document).ready(function(){
    /*
    $('#comment_form').on('submit', function(event){
        event.preventDefault();
        //var form_data = $(this).serialize(); // new 
        $.ajax({
            url: "{{ route('user.comment')}}",
            method: "POST",
            data: new FormData(this),
            //data: form_data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(data){
                if(data.error.length > 0){
                    var error_html = '';
                    for(var count = 0; count < data.error.length; count++){
                        error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                    }
                    $('#form_output').html(error_html);
                }else {
                    $('#form_output').html(data).success;
                    $('#comment_form')[0].reset();
                }
            }
        });
    });

    fetch_comment_data();

    function fetch_comment_data(query = ''){
        $.ajax({
            url: "{{ route('user.fetchComment') }}",
            method: "GET",
            data: {query:query},
            dataType: "json",
            success: function(data){
                $('body').html(data.table_data);
                $('#total_records').text(data.total_data);
            }
        })
    }

    $(document).on('keyup', '#search', function(){
        var query = $(this).val();
        fetch_comment_data(query);
    });
    */
});