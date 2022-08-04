<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css" />
    <link rel="stylesheet" href="../main.css" />
  </head>
  <body>
    <?php include('./navbar.php') ?>
    <div class="login-page">
        <div class="form">
            <form class="register-form" name="signUpForm" onSubmit="(e) => e.preventDefault();">
                <h3>Welcome NGO</h3>
                <input type="text" placeholder="Organisation Name" name="organisation_name" id="signup_organisation_name"/>
                <input type="password" placeholder="password" name="password" id="signup_password" />
                <input type="text" placeholder="email id" name="email" id="signup_emailid" />
                <input type="text" placeholder="phone number" name="phone_no" id="signup_phone_no" />
                <input type="text" placeholder="address" name="address" id="signup_address" />
                <button id="signUpButton" type="button" >Create</button>
                <p class="message">Already registered? <a href="#">Sign In</a></p>
            </form>
            <form class="login-form" name="signInForm" onSubmit="(e) => e.preventDefault();">
                <h3>Hello NGO</h3>
                <input type="text" placeholder="email id" name="username" id="login_emailid" />
                <input type="password" placeholder="password" name="password" id="login_password" />
                <button id="signInButton" type="button">login</button>
                <p class="message">Not registered? <a href="#">Create an account</a></p>
            </form>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        $('.message a').click(function(){
            $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
        });

        $('#signInButton').click(function(){
            $.ajax({
                url: "../manage/ngo.php",
                type: "POST",
                data: {
                    type: "login",
                    emailid: $('#login_emailid').val(),
                    password: $('#login_password').val(),
                },
                success: function(data){
                    data = JSON.parse(data);
                    if(data.code === 200)
                    {
                        console.log(data.user);
                        sessionStorage.setItem("ngo_id", data.user.ngo_id);
                        sessionStorage.setItem("organisation_name", data.user.organisation_name);
                        window.location.href="../dashboard/ngo";
                    }
                    else
                    {
                        alert('Login Failed');
                    }
                },
                error: function(data){
                    alert('Login Failed', data);
                }
            });
        });

        $("#signUpButton").click(function(){
            $.ajax({
                url: "../manage/ngo.php",
                type: "POST",
                data: {
                    type: "register",
                    org_name: $("#signup_organisation_name").val(),
                    address: $("#signup_address").val(),
                    phone_no: $("#signup_phone_no").val(),
                    password: $("#signup_password").val(),
                    emailid: $("#signup_emailid").val(),
                },
                success: function(data){
                    console.log(data);
                    data = JSON.parse(data);
                    if(data.code === 200)
                    {
                        alert('Signup Successful');
                    }
                    else
                    {
                        alert('Signup Failed');
                        console.log(data);
                    }
                },
                error: function(data){
                    alert('Signup Failed', data);
                }
            });
        });
</script>
  </body>
</html>