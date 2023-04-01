<?php
//Connect to MySQL 
require 'config.php';
session_start();

function endsWith($string, $smol)
{
  $len = strlen($smol);
  if ($len == 0) {
    return true;
  }
  return substr($string, -$len) === $smol;
}

//If there is no session user, then redirect to login page 
if (!isset($_SESSION['sess_user'])) {
	header("location: index.php");
}
$email = $_SESSION['sess_user'];
$result = mysqli_query($conn, "select * from users where email = '$email'");
$row = mysqli_fetch_array($result);

$Fname = $row["first_name"];
$Lname = $row["last_name"];
$pass = $row["password"];

if (isset($_POST['Submit'])){
    $new_fname = $_POST["fName"];
    $new_lname = $_POST["lName"];
    $new_pass1 = $_POST["pass1"];
    $new_pass2 = $_POST["pass2"];

    $number = preg_match('@[0-9]@', $new_pass1);         //password strength
    $uppercase = preg_match('@[A-Z]@', $new_pass1);
    $lowercase = preg_match('@[a-z]@', $new_pass1);
    $specialChars = preg_match('@[^\w]@', $new_pass1);

    if($new_pass1 != $new_pass2){
        echo '<script type="text/javascript">alert("Passwords Dont Match!")</script>';
    }
    else{
        if(!endsWith($email, '@iitp.ac.in')){
            echo '<script type="text/javascript">alert("Enter IIT Patna email only!")</script>';
        }
        else{
            if(strlen($new_pass1) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
                echo '<script type="text/javascript">alert("Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.")</script>';
            }
            else{
                $query = "update users set first_name = '$new_fname', last_name = '$new_lname', password = '$new_pass1'";
                $result = mysqli_query($conn, $query);

                if($result){
                    echo '<script type="text/javascript">alert("Updated Successfully! Logging you out.")</script>';
                    echo '<script language="javascript">window.location = "http://localhost/lab8/logout.php";</script>';
                }
                else{
                    echo '<script type="text/javascript">alert("Error!")</script>';
                }
            }
        }
    }

}


?>


<!DOCTYPE html>
<html>
<head>
	<title>Update Profile</title>
</head>

<style>
p.heading {
  margin-top: 200px;
}

p.top {
  margin-top: 20px;
  margin-bottom: 20px;
  font-size: 25px;
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
	<?php if (isset($error)): ?>
		<p><?php echo $error; ?></p>
	<?php endif; ?>

    <center>
        <p class = "heading">
            <h1>Update Profile</h1>
    </p>
        <p class = "top">
	<form action="" method="post">
		<label for="FirstName">First Name:</label>
		<input type="text" id="FirstName" name="fName" value = "<?php echo $Fname ?>" required><br><br>

        <label for="LastName">Last Name:</label>
		<input type="text" id="LastName" name="lName" value = "<?php echo $Lname ?>" required><br><br>

        <label for="Password1">Password:</label>
		<input type="text" id="Password1" name="pass1" value = "<?php echo $pass ?>" required><br><br>

        <label for="Password2">Confirm Password:</label>
		<input type="text" id="Password2" name="pass2" value = "<?php echo $pass ?>" required><br><br>

		<input type="submit"  value = 'Update Details' name = "Submit"> <br>
        <p>
        <a href="welcome.php"> Back to Main Menu </a><br />
	</form>
    </p>
    </center>
</body>
</html>