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


   $('#stars li').on('mouseover', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
   
    // Now highlight all the stars that's not after the current hovered star
    $(this).parent().children('li.star').each(function(e){
      if (e < onStar) {
        $(this).addClass('hover');
      }
      else {
        $(this).removeClass('hover');
      }
    });
    
  }).on('mouseout', function(){
    $(this).parent().children('li.star').each(function(e){
      $(this).removeClass('hover');
    });
  });
  
  
  /* 2. Action to perform on click */
  $('#stars li').on('click', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
    var stars = $(this).parent().children('li.star');
    
    for (i = 0; i < stars.length; i++) {
      $(stars[i]).removeClass('selected');
    }
    
    for (i = 0; i < onStar; i++) {
      $(stars[i]).addClass('selected');
    }
    
    // JUST RESPONSE (Not needed)
    var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
    var msg = "";
    var rating = document.getElementById('rating'); // get the rating hidden input field
    if (ratingValue > 1) {
        //msg = "Thanks! You rated this " + ratingValue + " stars.";
      //console.log(ratingValue);
      rating.value = ratingValue;
    }
    else {
     // console.log("error");
     rating.value = 0;
    }
    //responseMessage(msg);
  });

  //$("#stars-show li").on('load', function(){
    var count = document.getElementById("rating-number").value;
    //var onStar = parseInt($(this).data('value'), 10);
    var onStar = parseInt(count);
    console.log(onStar);

    $("#stars-show li").parent().children('li.star-show').each(function(e){
      if (e < onStar) {
        $(this).addClass('selected');
      }
      else {
        $(this).removeClass('hover');
      }
    });

});