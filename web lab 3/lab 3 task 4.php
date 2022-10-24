<?php
$message = '';

$nameErr = $emailErr = $genderErr = $dateErr = $degreeErr = $BGErr = "";
$name = $email = $gender = $date   = $Degree =  $BG = "";
$usernameErr = $passErr = $conpassErr = "";
$username = $pass = $conpass = "";

if (isset($_POST["submit"])) {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else if (!empty($_POST["name"])) {
        $name = ($_POST["name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
            $name = "";
        } else if (strlen($name) < 2) {
            $nameErr = "Contains at least two  words";
            $name = "";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else if (!empty($_POST["email"])) {
        $email = ($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $email = "";
        }
    }
    if (empty($_POST["username"])) {
        $usernameErr = "User Name is required";
    } else if (!empty($_POST["username"])) {
        $username = ($_POST["username"]);
        if (!preg_match("/^[a-zA-Z-'_]*$/", $username)) {
            $usernameErr = "Only letters and underscore allowed";
            $username = "";
        } else if (strlen($username) < 2) {
            $usernameErr = "Contains at least two  words";
            $username = "";
        }
    }
    if (empty($_POST["password"])) {
        $passErr = "password is required";
    } else if (!empty($_POST["password"])) {
        $pass = ($_POST["password"]);
        if (strlen($pass) < 8) {
            $passErr = " must not be less than eight (8) characters";
            $pass = "";
        } else if (!preg_match("/[@, #, $,%]/", $pass)) {
            $passErr = "must contain at least one of the special characters (@, #, $,%)";
            $pass = "";
        }
    }
    if (empty($_POST["confirmpassword"])) {
        $conpassErr = "This field is required";
    } else if (!empty($_POST["confirmpassword"])) {
        if ($_POST["password"] == $_POST["confirmpassword"]) {
            $conpass = $_POST["confirmpassword"];
        } else {

            $conpassErr = "doest not match to the new password";
        }
    }
    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else if (!empty($_POST["gender"])) {
        $gender = ($_POST["gender"]);
    }
    if (empty($_POST["dob"])) {
        $dateErr = "cannot be empty";
    } else if (!empty($_POST["dob"])) {
        $date = ($_POST["dob"]);
    }
    if (!empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["username"]) && !empty($_POST["gender"]) && !empty($_POST["dob"])) {
        if (file_exists('Data_file.json')) {
            $current_data = file_get_contents('Data_file.json');

            $array_data = json_decode($current_data, true);
            $new_data = array(
                'name'               =>     $_POST["name"],
                'e-mail'          =>     $_POST["email"],
                'username'     =>     $_POST["username"],
                'gender'     =>     $_POST["gender"],
                'dob'     =>     $_POST["dob"]
            );
            $array_data[] = $new_data;
            $final_data = json_encode($array_data);

            if (file_put_contents('Data_file.json', $final_data)) {
                $message = "<p>File Appended Success fully</p>";
            }
        } else {
            $error = 'JSON File not exits';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <style type="text/css">
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <br />
    <form method="post">
        <?php
        if (isset($error)) {
            echo $error;
        }
        ?>
        Name:
        <input type="text" name="name" value="<?php echo $name; ?>">
        <span class="error">* <?php echo $nameErr; ?></span>
        <br><br>
        E-mail:
        <input type="text" name="email" value="<?php echo $email; ?>">
        <span class="error">* <?php echo $emailErr; ?></span>
        <br><br>
        User Name:
        <input type="text" name="username" value="<?php echo $username; ?>">
        <span class="error">* <?php echo $usernameErr; ?></span>
        <br><br>
        Password:
        <input type="text" name="password">
        <span class="error">* <?php echo $passErr; ?></span>
        <br><br>
        Confirm password:
        <input type="text" name="confirmpassword">
        <span class="error">* <?php echo $conpassErr; ?></span>
        <br><br>
        <fieldset>
            <legend>Gender</legend>
            <input type="radio" id="male" name="gender" value="male">
            <label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="female">
            <label for="female">Female</label>
            <input type="radio" id="other" name="gender" value="other">
            <label for="other">Other</label>
            <span class="error">* <?php echo $genderErr; ?></span>
            <br><br>
            <legend>Date of Birth:</legend>
            <input type="date" name="dob">
            <span class="error">* <?php echo $dateErr; ?></span>
            <br><br>
        </fieldset>
        <br><br>
        <input type="submit" name="submit" value="Append" class="btn btn-info" /><br />
        <?php
        if (isset($message)) {
            echo $message;
        }
        ?>
    </form>
    </div>
    <br />
</body>

</html>