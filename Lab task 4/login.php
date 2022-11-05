<!DOCTYPE html>
<head>  
    <title>Login</title>   
</head> 
<body>  
    <form action="" method="post">
<?php
	include 'Home.php';

	$message = $error = "";
	if(isset($_POST["submit"])){
    if(empty($_POST["username"])){
    $error = "Enter username";
    }
    else if(empty($_POST["password"])){
    $error = "Enter password";
    }
    else{
        if(file_exists('credentials.json')){
        $data = file_get_contents("credentials.json");
        $data = json_decode($data, true);
           foreach($data as $item){
                if($item["username"]==$_POST["username"] && $item["password"]==$_POST["password"]){                    
                    session_start();			        

                    $name =$_POST["username"];

                    $_SESSION['username'] = $name;
                    	header("Dashboard.php");                    
                }
                else{
                    $error = "Incorrect Credentials";
                }
            }
        }
    }
}
    if(isset($error)){
        echo $error;
    }
?>
        
        LOGIN<br><br>
        username :
        <input type = "text" username = "username" value="<?php if(isset($_COOKIE['username'])) {echo $_COOKIE['username'];} ?>"><br><br>
        <tr>password  :</tr>
        <input type = "password" username = "password" value="<?php if(isset($_COOKIE['password'])) {echo $_COOKIE['password'];} ?>"><br><br>
        <input type = "checkbox" username = "remember" <?php if(isset($_COOKIE['username'])) {echo "checked";} ?>>Remember Me<br><br>
        <input type = "submit" username = "login" value = "Login">
        <a href="Forgot.php">Forgot password?<br>

        <?php
            if(isset($message)){
                echo $message;
            }

            if (!empty($_POST['remember'])) {
                setcookie("username", $_POST['username'], time()+45);
                setcookie("password", $_POST['password'], time()+45);                
            }else{
                setcookie("username", "");
                setcookie("password", "");
            }
        ?>
    
    </form>
</body>
</html>