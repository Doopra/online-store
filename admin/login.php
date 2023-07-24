<?php include ('pathway/constants.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.style.css">
    <title>Login - Food Order System</title>
</head>
<body>

    

        <?php 
        if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset( $_SESSION['login']);
        }

        if(isset($_SESSION['no-login-message'])){
            echo $_SESSION['no-login-message'];
            unset( $_SESSION['no-login-message']);   
        }
        ?> <br /> <br />
        <!-- Login form starts here-->

        
           
    


    <div class="login-wrap">
	<div class="login-html">
    <form action="" method="POST">
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
		<div class="login-form">
			<div class="sign-in-htm">
				<div class="group">
					<label for="user" class="label">Username</label>
					<input id="user" type="text" class="input" name="username">
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass" type="password" class="input" data-type="password" name="password">
				</div>
				<div class="group">
					<input id="check" type="checkbox" class="check" checked>
					<label for="check"><span class="icon"></span> Keep me Signed in</label>
				</div>
				<div class="group">
					<input type="submit" class="button" value="Sign In" name="submit">
				</div>
				<div class="hr"></div>
				<div class="foot-lnk">
					<a href="#forgot">Forgot Password?</a>
				</div>
			</div>
			<div class="sign-up-htm">
				<div class="group">
					<label for="user" class="label">Username</label>
					<input id="user" type="text" class="input">
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass" type="password" class="input" data-type="password">
				</div>
				<div class="group">
					<label for="pass" class="label">Repeat Password</label>
					<input id="pass" type="password" class="input" data-type="password">
				</div>
				<div class="group">
					<label for="pass" class="label">Email Address</label>
					<input id="pass" type="text" class="input">
				</div>
				<div class="group">
					<input type="submit" class="button" value="Sign Up">
				</div>
				<div class="hr"></div>
				<div class="foot-lnk">
					<label for="tab-1">Already Member?</a>
				</div>
			</div>
		</div>
    </form>
	</div>
</div>
</body>
</html>

<?php
    // chck whether the submit button is clicked or not

    if(isset($_POST['submit'])){
        //process for login
        //1. get the date from login form

        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //mysql to check whether the username and passowrd exist
        $sql = "SELECT * FROM tl_admin WHERE username='$username' AND password='$password'";
        //Execute the query
        $res  = mysqli_query($conn, $sql);
        //3. Count rows to check whether the user exist
        $count = mysqli_num_rows($res);

        if($count == 1){
            // user is available
            $_SESSION['login'] = "<div class='success text-center'>Login Successfully</div>";
            $_SESSION['user'] =  $username;
            // redirect to Home page
             header('location:'.SITEURL.'admin/');
        } else{
            //user is not available
            $_SESSION['login'] = "<div class='error text-center'>Username and Password did not match.</div>";
            // redirect to Home page
             header('location:'.SITEURL.'admin/login.php');
        }
    }
?>