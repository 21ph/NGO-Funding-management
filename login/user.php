<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="../main.css">
    
  </head>
  <body>
      
    <?php include('./navbar.php') ?>
  <div class="login-page">
  <div class="form">
    <form class="register-form" name="signUpForm" onSubmit="(e) => e.preventDefault();">
    <h3>Welcome User</h3>
      <input type="text" placeholder="Username" name="username" id="signup_username"/>
      <input type="text" placeholder="Full Name" name="fullname" id="signup_fullname"/>
      <input type="password" placeholder="password" name="password" id="signup_password" />
      <input type="text" placeholder="email address" name="email" id="signup_email" />
      <button id="signUpButton" type="button" >create</button>
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>
    <form class="login-form" name="signInForm" onSubmit="(e) => e.preventDefault();">
    <h3>Hello User</h3>
      <input type="text" placeholder="username" name="username" id="login_username" />
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
                url: "../manage/user.php",
                type: "POST",
                data: {
                    type: "login",
                    username: $('#login_username').val(),
                    password: $('#login_password').val(),
                },
                success: function(data){
                    data = JSON.parse(data);
                    if(data.code === 200)
                    {
                        console.log(data.user);
                        sessionStorage.setItem("user_id", data.user.user_id);
                        sessionStorage.setItem("user_name", data.user.username);
                        window.location.href="../dashboard/user";
                    }
                    else
                    {
                        alert('Login Failed');
                        console.log(data);
                    }
                },
                error: function(data){
                    alert('Login Failed', data);
                }
            });
        });

        $("#signUpButton").click(function(){
            $.ajax({
                url: "../manage/user.php",
                type: "POST",
                data: {
                    type: "register",
                    username: $("#signup_username").val(),
                    fullname: $("#signup_fullname").val(),
                    password: $("#signup_password").val(),
                    email: $("#signup_email").val(),
                },
                success: function(data){
                    data = JSON.parse(data);
                    if(data.code === 200)
                    {
                        sessionStorage.setItem("user_id", data.user.user_id);
                        sessionStorage.setItem("user_name", data.user.username);
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