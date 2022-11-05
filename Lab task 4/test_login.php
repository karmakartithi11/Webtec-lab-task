<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		Login Page
	</title>
</head>
<body>
<form>
  <?php 
include 'Home.php';
$usernameErr = $passwordErr = "";
$username = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["username"])) {
    $usernameErr = "username is required";
  } else {
    $username = test_input($_POST["username"]);
  }
  if (empty($_POST["password"])) {
    $passwordErr = "password is required";
  } else {
    $password = test_input($_POST["password"]);
  }
}
 ?>
username: <input type="text" name="username">
<span class="error">* <?php echo $usernameErr;?></span><br><br>

password:<input type="password" name="password">
<span class="error">* <?php echo $passwordErr;?></span><br><br>
	<input type="checkbox" name="remember">Remember Me 
	<button action = "submit">Submit</button>
</form>
</body>
</html>