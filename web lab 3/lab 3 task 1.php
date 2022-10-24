<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <style type="text/css">
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <?php
    $nameErr = $passErr = "";
    $name = $pass = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = ($_POST["name"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $nameErr = "Only letters and white space allowed";
                $name = "";
            } else if (strlen($name) < 2) {
                $nameErr = "Contains at least two  words";
                $name = "";
            }
        }

        if (empty($_POST["password"])) {
            $passErr = "pass is required";
        } else {
            $pass = ($_POST["password"]);
            if (strlen($pass) < 8) {
                $passErr = " must not be less than eight (8) characters";
                $pass = "";
            } else if (!preg_match("/[@, #, $,%]/", $pass)) {
                $passErr = "must contain at least one of the special characters (@, #, $,%)";
                $pass = "";
            }
        }
    }
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <fieldset>
            <legend>LOGIN</legend>
            Name:<input type="text" name="name" value="<?php echo $name; ?>">
            <span class="error">* <?php echo $nameErr; ?></span>
            <br><br>
            Password:<input type="password" name="password">
            <span class="error">* <?php echo $passErr; ?></span>
            <br><br>
            <input type="submit" name="submit" value="Submit">
        </fieldset>
    </form>
    <h2>Your input</h2>
    <?php
    echo $name . "<br>";
    echo $pass . "<br>";
    ?>
</body>

</html>