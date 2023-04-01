<?php
require 'config.php';
session_start();

if(!isset($_SESSION['sess_user'])){
    header('Location: index.php');
}

$email = $_SESSION['sess_user'];
$result = mysqli_query($conn, "select * from users where email = '$email'");
$row = mysqli_fetch_array($result);

$Fname = $row["first_name"];
$Lname = $row["last_name"];



if(isset($_POST["DELETE_ACCOUNT"])){
    echo '<script language="javascript">window.location = "http://localhost/lab8/delete.php";</script>';

}



?>



<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
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
    font-size: 17px;
}
input{
    font-size: 17px;
}

a{
    font-size: 25px;
}
</style>


<body>
    <center><p class = "heading">
    <h1> <?php echo "Hello ".$Fname.' '.$Lname; ?> </h1></p>
<br/>

<p class = "top">
<a href="profile.php"> Profile Details </a><br />
<p class = "top">
<a href="update.php"> Update Profile </a><br />
<p class = "top">
<a href="logout.php"> Log out </a>
<p class = "top">
<form method="post">
        <input type="submit" name="DELETE_ACCOUNT"
                class="button" value="DELETE ACCOUNT" />

    </form>
</p>
</center>
</body>
</html>