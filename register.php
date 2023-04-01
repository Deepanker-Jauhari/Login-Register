<?php
require 'config.php';

function endsWith($string, $smol)
{
  $len = strlen($smol);
  if ($len == 0) {
    return true;
  }
  return substr($string, -$len) === $smol;
}

if(isset($_POST["Submit"])){
    $fName = $_POST["fName"];
    $lName = $_POST["lName"];
    $email = $_POST["email"];
    $pass1 = $_POST["pass1"];
    $pass2 = $_POST["pass2"];

    $number = preg_match('@[0-9]@', $pass1);         //password strength
    $uppercase = preg_match('@[A-Z]@', $pass1);
    $lowercase = preg_match('@[a-z]@', $pass1);
    $specialChars = preg_match('@[^\w]@', $pass1);

    

    if($pass1 != $pass2){
        echo '<script type="text/javascript">alert("Passwords Dont Match!")</script>';
    }
    else{
        if(!endsWith($email, '@iitp.ac.in')){           //email should have iitp.ac.in
            echo '<script type="text/javascript">alert("Enter IIT Patna email only!")</script>';
        }
        else{
            if(strlen($pass1) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
                echo '<script type="text/javascript">alert("Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.")</script>';
              }
              else {
                $query = "select * from users where email = '$email'";        //check for existing user
                $result = mysqli_query($conn, $query);
    
                if (mysqli_num_rows($result)>0){
                    echo '<script type="text/javascript">alert("User already exists! \n Please Login.")</script>';
                }
                else{
                    $query = "insert into users(first_name, last_name, email, password) values('$fName', '$lName', '$email', '$pass1')";      // insert into table if no issues
                    $result = mysqli_query($conn, $query);
    
                    if($result){
                        echo '<script type="text/javascript">alert("User Registered Succesfully!")</script>';
                        echo '<script language="javascript">window.location = "http://localhost/lab8/index.php";</script>';
                    }
                    else{
                        echo '<script type="text/javascript">alert("Error!")</script>';
                    }
                }
              }

    }
}
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>User Registration</title>
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
        <center><h1>User Registration</h1></p>
    <p class = "top">
            <?php if (isset($error)): ?>
                <p><?php echo $error; ?></p>
            <?php endif; ?>

            <form action="" method="post">
                <label for="FirstName">First Name:</label>
                <input type="text" id="FirstName" name="fName" required><br><br>

                <label for="LastName">Last Name:</label>
                <input type="text" id="LastName" name="lName" required><br><br>

                <label for="Email">Email Address:</label>
                <input type="text" id="Email" name="email" required><br><br>

                <label for="Password1">Password:</label>
                <input type="password" id="Password1" name="pass1"  required><br><br>

                <label for="Password2">Re-Enter Password:</label>
                <input type="password" id="Password2" name="pass2"  required><br><br>

                <input type="submit"  value = 'Register' name = "Submit"> <br>
                <p class = "top">
                Already a user? <a href="index.php">Login</a>
            </form>
        </center>
    </p>
</body>
</html>
