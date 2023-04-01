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
$email = $row["email"];
?>


<!DOCTYPE html>
<html>
<head>
	<title>Profile Details</title>
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

tr{
    font-size: 23px;
}
</style>


<body>
    <p class = "heading">
    <center><h1>Profile Details</h1>
</p>


<table>
    <tr>
        <td><b>First Name: </td>
        <td><?php echo $Fname; ?></td>
</tr>
    <tr>
        <td><b>Last Name: </td>
        <td><?php echo $Lname; ?></td>
</tr>
    <tr>
        <td><b>Email: </td>
        <td><?php echo $email; ?></td>
</tr>
</table>
<p class = "top">
    <a href="welcome.php"> Back to Main Menu </a><br />

</body>
</html>