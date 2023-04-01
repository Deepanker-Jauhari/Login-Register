<?php
require 'config.php';

if(isset($_POST["Submit"])){
    $email = $_POST["email"];
    $pass = $_POST["pass"];

    $query = "select * from users where email = '$email' and password = '$pass'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) != 0){

        session_start();
        $_SESSION['sess_user'] = $email;
        header ('Location: welcome.php');
    }
    else{
        echo '<script type="text/javascript">alert("Invalid Email or Password!")</script>';
    }
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>User Login</title>
</head>

<style>
p.heading {
  margin-top: 200px;
}

p.top {
  margin-top: 20px;
  margin-bottom: 20px;
  font-size: 20px;
}

h1{
    font-size: 40px;
}

label{
    font-size: 20px;
}
input{
    font-size: 20px;
}

a{
    font-size: 20px;
}
</style>


<body>
    <p class = "heading">
        <center><h1>User Login</h1></p>
        <p class = "top">
            <?php if (isset($error)): ?>
                <p><?php echo $error; ?></p>
            <?php endif; ?>

            <form action="" method="post">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" required><br><br>

                <label for="pass">Password:</label>
                <input type="password" id="pass" name="pass" required><br><br>

                <input type="submit" value="Login" name = "Submit">
                <p class = "top">No credentials yet? <a href="register.php">Register</a>
            </form>
        </center>
    </p>
</body>
</html>
