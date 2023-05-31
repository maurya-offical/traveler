<?php
session_start();
error_reporting(0);
include('admin/includes/config.php');
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $newpassword = $_POST['newpassword'];
    $sql = "SELECT email FROM users WHERE email=:email";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        $con = "update users set password=:newpassword where email=:email";
        $chngpwd1 = $dbh->prepare($con);
        $chngpwd1->bindParam(':email', $email, PDO::PARAM_STR);
        $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
        $chngpwd1->execute();
        echo "<script>
      alert('Password Changed Successfully 😊');
      window.location.href='sign-in.php';
      </script>";
    } else {
        echo "<script>
      alert('Email Id Is Invalid 😒');
      window.location.href='sign-in.php';
      </script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traveler – Travel & Trip Business</title>
    <style>
        /* Css for forgot password */
        /* Style for the popup window */
        .popup {
  display: none; /* Hide the popup by default */
  position: fixed;
  z-index: 9999;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.5);
}

.popup-content {
  background-color: #ffffff;
  margin: 10% auto;
  padding: 20px;
  max-width: 400px;
  /* border-radius: 30px; */
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  cursor: pointer;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
}

h2 {
  margin-top: 0;
}

form {
  margin-top: 20px;
}

label {
  display: block;
  font-weight: bold;
}

input[type="email"],
input[type="password"],
input[type="submit"] {
  width: 100%;
  padding: 10px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 50px;
  background-color: #eee;
}

input[type="submit"] {
  background-color: #008ecf;
  color: white;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #1db8ff;
}

</style>
    <style>
        /* Animated Wave Background Style  */
        html,
        body {
            width: 100%;
            height: 100%;
        }

        body {
            background: radial-gradient(ellipse at center, rgba(255, 254, 234, 1) 0%, rgba(255, 254, 234, 1) 35%, #3A78C9 100%);
            overflow: hidden;
        }

        .ocean {
            height: 5%;
            width: 100%;
            position: absolute;
            bottom: 0;
            left: 0;
            background: #3A78C9;
        }

        .wave {
            background: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/85486/wave.svg) repeat-x;
            position: absolute;
            top: -198px;
            width: 6400px;
            height: 198px;
            animation: wave 5s cubic-bezier(0.36, 0.45, 0.63, 0.53) infinite;
            transform: translate3d(0, 0, 0);
        }

        .wave:nth-of-type(2) {
            top: -175px;
            animation: wave 7s cubic-bezier(0.36, 0.45, 0.63, 0.53) -.125s infinite, swell 7s ease -1.25s infinite;
            opacity: 1;
        }

        @keyframes wave {
            0% {
                margin-left: 0;
            }

            100% {
                margin-left: -1600px;
            }
        }

        @keyframes swell {

            0%,
            100% {
                transform: translate3d(0, -25px, 0);
            }

            50% {
                transform: translate3d(0, 5px, 0);
            }
        }

        /* Login Section Style */
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: -20px 0 50px;
            margin-top: 20px;
        }

        h1 {
            font-weight: bold;
            margin: 0;
        }

        p {
            font-size: 14px;
            font-weight: 100;
            line-height: 20px;
            letter-spacing: .5px;
            margin: 20px 0 30px;
        }

        span {
            font-size: 12px;
        }

        a {
            color: #3A78C9;
            font-size: 14px;
            text-decoration: none;
            margin: 15px 0;
        }

        .container {
            background: #fff;
            border-radius: 90px;
            box-shadow: 30px 14px 28px rgba(0, 0, 5, .2), 0 10px 10px rgba(0, 0, 0, .2);
            position: relative;
            overflow: hidden;
            opacity: 85%;
            width: 768px;
            max-width: 100%;
            min-height: 480px;
            transition: 333ms;
        }


        .form-container form {
            background: #fff;
            display: flex;
            flex-direction: column;
            padding: 0 50px;
            height: 100%;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .social-container {
            margin: 20px 0;
            display: block;
        }


        .social-container a {
            border: 1px solid #008ecf;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin: 0 5px;
            height: 40px;
            width: 40px;
            transition: 333ms;
        }

        .social-container a.social i {
            color: black;
        }

        .social-container a:hover {
            transform: rotateZ(13deg);
            border: 1px solid #0e263d;
        }

        .form-container input {
            background: #eee;
            border: none;
            border-radius: 50px;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
        }

        .form-container input:hover {
            transform: scale(101%);
        }

        button {
            border-radius: 50px;
            box-shadow: 0 1px 1px;
            border: 1px solid #008ecf;
            background: #008ecf;
            color: #fff;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
        }

        button:active {
            transform: scale(.95);
        }

        button:focus {
            outline: none;
        }

        button.ghost {
            background: transparent;
            border-color: #fff;
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all .6s ease-in-out;
        }

        .sign-in-container {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .sign-up-container {
            left: 0;
            width: 50%;
            z-index: 1;
            opacity: 0;
        }

        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform .6s ease-in-out;
            z-index: 100;
        }

        .overlay {
            background: #3A78C9;
            background: linear-gradient(to right, #008ecf, #008ecf) no-repeat 0 0 / cover;
            color: #fff;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateY(0);
            transition: transform .6s ease-in-out;
        }

        .overlay-panel {
            position: absolute;
            top: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 0 40px;
            height: 100%;
            width: 50%;
            text-align: center;
            transform: translateY(0);
            transition: transform .6s ease-in-out;
        }

        .overlay-right {
            right: 0;
            transform: translateY(0);
        }

        .overlay-left {
            transform: translateY(-20%);
        }

        /* Move signin to right */
        .container.right-panel-active .sign-in-container {
            transform: translateY(100%);
        }

        /* Move overlay to left */
        .container.right-panel-active .overlay-container {
            transform: translateX(-100%);
        }

        /* Bring signup over signin */
        .container.right-panel-active .sign-up-container {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
        }

        /* Move overlay back to right */
        .container.right-panel-active .overlay {
            transform: translateX(50%);
        }

        /* Bring back the text to center */
        .container.right-panel-active .overlay-left {
            transform: translateY(0);
        }

        /* Same effect for right */
        .container.right-panel-active .overlay-right {
            transform: translateY(20%);
        }
    </style>

</head>

<body>
    <!-- Animated Wave Background  -->
    <div class="ocean">
        <div class="wave"></div>
        <div class="wave"></div>
    </div>
    <!-- Log In Form Section -->
    <section>
        <div class="container" id="container">
            <div class="form-container sign-up-container">
                <form action="process.php" method="POST">
                    <h1>Sign Up</h1>
                    <span>Or use your Email for registration</span>
                    <label>
                        <input type="text" name="name" placeholder="Name" required />
                    </label>
                    <label>
                        <input type="email" name="email" placeholder="Email" required />
                    </label>
                    <label>
                        <input type="password" name="password" placeholder="Password" required />
                    </label>
                    <label>
                        <input type="password" name="cpassword" placeholder="Confirm Password" required />
                    </label>
                    <button style="margin-top: 9px" name="signup">Sign Up</button>
                </form>
            </div>
            <div class="form-container sign-in-container">
                <form action="process.php" method="POST">
                    <h1>Sign in</h1>
                    <span> Or sign in using E-Mail Address</span>
                    <label>
                        <input name="email" type="email" placeholder="Email" required />
                    </label>
                    <label>
                        <input name="password" type="password" placeholder="Password" required />
                    </label><br>
                    <a style="cursor:pointer;" onclick="openPopup()">Forgot your password?</a>
                    <button name="login">Sign In</button>
                </form>
            </div>
            <!-- The popup window -->
            <div id="popup" class="popup">
                <div class="popup-content">
                    <span class="close" onclick="closePopup()">&times;</span>
                    <h2>Forgot Password</h2>

                    <form method="POST" action="">
                        <label for="currentPassword">Email:</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Reg Email id" required><br><br>

                        <label for="newPassword">New Password:</label>
                        <input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="New Password" required><br><br>

                        <label for="confirmPassword">Confirm Password:</label>
                        <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password" required><br><br>

                        <input type="submit" value="Submit" name="submit">
                    </form>
                </div>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1>Log in</h1>
                        <p>Sign in here if you already have an account </p>
                        <button class="ghost mt-5" id="signIn">Sign In</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1>Create, Account!</h1>
                        <p>Sign up if you still don't have an account ... </p>
                        <button class="ghost" id="signUp">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () =>
            container.classList.add('right-panel-active'));

        signInButton.addEventListener('click', () =>
            container.classList.remove('right-panel-active'));
    </script>
    <script>
        function openPopup() {
            document.getElementById("popup").style.display = "block";
        }

        function closePopup() {
            document.getElementById("popup").style.display = "none";
        }
    </script>
</body>

</html>