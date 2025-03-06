<!DOCTYPE html>
<html lang="en">
<head>
<head>
  <title>Static Chat App</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body style="background-color: grey;">
<div class="container">
  <div class="jumbotron" style="background-color: #FFD700;"> <h1><center>Static Chat</center></h1> </div>
        <div class="container col-4">
            <div id="userName">
                    <form id="userForm">
                        <input type="text" name="u-name" id="u-name" placeholder="Enter UserName">
                        <button class="btn btn-primary" type="submit">Start</button>
                    </form>
            </div>
            <div id="userChat">
                <form id="chatform">
                    @csrf
                    <input type="hidden" name="unme" id="unme" >
                    <input type="text" name="chatmessage" id="chatmessage" placeholder="Send Message">
                    <button  class="btn btn-success"  type="submit">Send</button> 
                </form>
            </div>
            <div id="chatContainer" style="background-color: yellow; border: 1px solid black;">
            </div>
        </div>
    </div>
</div>
</body>
<script src="{{asset('js/app.js')}}"></script>
<script>
    $(document).ready(function() {
    // Initially hide the chat div
    $('#userChat').hide();

    // Show the chat div when the user form is submitted
    $('#userForm').submit(function(event) {
        event.preventDefault(); // Prevent the form from submitting and reloading the page
        var usname = $('#u-name').val();  // Use .val() to get the value of the input
        $('#unme').val(usname);  // Set the value of the input field instead of using innerHTML
        $('#userName').hide();  // Hide the user name form
        $('#userChat').show();  // Show the chat container
    });

    // Handle chat form submission
    $('#chatform').submit(function (e) {
        e.preventDefault();
        var fd = $(this).serialize();
        $.ajax({
            url: "{{ route('sendmsg') }}",  // Ensure this is correct
            type: "POST",
            data: fd,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  // Add CSRF token to headers
            }
        });
        $('#chatmessage').val('');  // Use .val() to reset the input field
    });
    Echo.channel('chatmessage').listen('chat',(e)=>{
        let html = '<br> <b>'+ e.Uusername +'</b>'+':-   '+ 
        '<span>' + e.Umessage + '<span>';
        $('#chatContainer').append(html);
    });
});
</script>
</html>
