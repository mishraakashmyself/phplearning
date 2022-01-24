<!-- jQuery Code to validate user email and request ajax request to server-->
<!-- include jQuery Library file -->
<script>
    $(document).ready(function () {

        function isValidEmail(email) {

            var rex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return rex.test(email);
        }

        $("form").submit(function (event) {

            if (isValidEmail($("#email").val())) {
                $("#result").html("Valid Email");
                
                $.ajax({
                url: './server.php', // sending ajax request to this server page
                async: false,
                type: 'post',
                dataType: "json",
                data: {
                    'email': $("#email").val()
                },
                success: function (response) {
                    $("#result").html(response.message);
                }
            });
            
            } else {
                $("#result").html("Entered Email is InValid!");
            }

            
            event.preventDefault();
        });
    });

</script>

<!-- Html Code -->
<div id="result"> </div>
<form method="post" id="demo" >
    <input type="text" name="email" id="email" class="form-control" placeholder="Please Enter your Email">
    <input type="submit" value="Submit" name="submitBtn" id="submitBtn" >
</form>


 
