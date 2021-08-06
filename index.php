<?php
include("config.php");
session_start();

$errors = "";
if ($db->connect_error) {
    die('Connection failed: ' . $db->connect_error);
}

if (isset($_POST['signup'])) {
    if (strcmp($_POST['pass'], $_POST['confirmpass']) != 0) {
        $errors = "Passwords do not match!";
    } else {
        $name = $_POST['name'];
        $mail = $_POST['mail'];
        $pass = $_POST['pass'];
        $sql = "INSERT INTO auth (name, email, password) VALUES ('$name', '$mail', '$pass')";
        if (!mysqli_query($db, $sql)) {
            $errors = "Error : " . $db->error;
        } else {
            header('location: index.php?form=signin');
        }
    }
}

if (isset($_POST['signin'])) {
    $mail = $_POST['mail'];
    $pass = $_POST['pass'];

    $sql = "SELECT * FROM auth WHERE email='$mail' AND password='$pass'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $_SESSION['user'] = $row["id"];
        header("location: app.php");
    } else {
        $errors = "Incorrect login credentials!";
    }
}

if (isset($_GET['del'])) {
    mysqli_query($db, "DELETE FROM todos WHERE id=" . $_GET['del']);
    header('location: app.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Management System</title>
    <link rel="stylesheet" href="./assets/basic.css">
    <link rel="stylesheet" href="./assets/home.css">
</head>

<body>
    <div class="app">
        <h1 class="title">File Management System</h1>

        <?php if ($_GET["form"] == "signup") { ?>
            <div class="signupForm authForm">
                <form action="" method="POST">
                    <input type="text" name="name" placeholder="Enter your name here" maxlength="100" required autofocus />
                    <input type="email" name="mail" placeholder="Enter your email here" maxlength="100" required />
                    <input type="password" name="pass" placeholder="Enter a new password here" minlength="8" maxlength="100" required />
                    <input type="password" name="confirmpass" placeholder="Confirm your password here" required />
                    <input type="submit" name="signup" value="Sign Up" />
                </form>
                <a href="?form=signin">Sign In instead?</a>
            </div>
        <?php } else { ?>
            <div class="signinForm authForm">
                <form action="" method="POST">
                    <input type="email" name="mail" placeholder="Enter your email here" required autofocus />
                    <input type="password" name="pass" placeholder="Enter your password here" required />
                    <input type="submit" name="signin" value="Sign In" />
                </form>
                <a href="?form=signup">Sign Up instead?</a>
            </div>
        <?php } ?>

        <?php echo $errors; ?>
    </div>
</body>

</html>