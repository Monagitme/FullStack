<?php
session_start();
require 'config.php';?>
<!DOCTYPE html>
<html>
<head>
<title>Login Page</title>
<link rel="stylesheet" href="style.css">
</head>
<body style="background-color:#7f8c8d" >
<div id="mainwrapper">
<center>
<h1>Login Form</h1>
<img src="image/avatar.png" class="avatar"/>
</center>
<form class="myform" action="signin.php" method="post">
<label><b>UserName:<label><br>
<input name="username" type="text" value="<?php
if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>"
class="input-field"placeholder="Type your mail id"/><br>
<label><b>Password:<label/><br>
<input name="password" type="password" value="<?php
if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>"
class="input-field" placeholder="Type your password"/><br>
<p><input type="checkbox" name="remember" />
Remember me
<input name="login" type="submit" id="login_btn"
value="Login"/><br>
<a href="register.php"><input type="button" id="register_btn"
value="Register"/><br></a></p>
</form>
</div>
</body>
</html>
<?php
if(isset($_POST['login']))
{
$username=$_POST['username'];
$password=$_POST['password'];
$query="select * from user WHERE username='$username'
AND password='$password'";
$query_run=mysqli_query($con,$query);
if(mysqli_num_rows($query_run)>0)
{
// valid
$_SESSION['username']=$username;
header('location:welcome.php');}
$redis=new Redis();
$redis->connect('127.0.0.1',6379);
echo"connection to server sucessfully";
$redis->set("email",$username);
}
?>
<?php
if(!empty($_POST["remember"])) {
setcookie ("username",$_POST["username"],time()+ 3600);
setcookie ("password",$_POST["password"],time()+ 3600);
} else {
setcookie("username","");
setcookie("password","");
}
?>
