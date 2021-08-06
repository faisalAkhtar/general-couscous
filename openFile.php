<?php
include('config.php');
include('session.php');
$errors = "";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM files WHERE id=$id";

    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
}

if (isset($_POST["createFile"])) {
    $name = $_POST["name"];
    $content = $_POST["content"];

    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $sql = "UPDATE  files SET content='$content' WHERE id=$id";
    } else {
        $sql = "INSERT INTO files (name, content, createdOn, createdBy) VALUES ('$name', '$content', now(), '$user')";
    }

    if (!mysqli_query($db, $sql)) {
        $errors = "Error : " . $db->error;
    } else {
        header('location: app.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File management system</title>
    <link rel="stylesheet" href="./assets/basic.css">
    <link rel="stylesheet" href="./assets/openFile.css">
</head>

<body>
    <div class="app">
        <?php echo $errors; ?>
        <div class="appButtons">
            <a href="app.php"><button>Go Back</button></a>
            <a href="logout.php"><button>Sign Out</button></a>
        </div>
        <form action="" method="POST">
            <input type="text" name="name" placeholder="Enter your filename here" maxlength="100" value="<?php echo $row['name']; ?>" required autofocus />
            <textarea name="content" placeholder="Start writing here..." maxlength="100"><?php echo $row['content']; ?></textarea>
            <input type="submit" name="createFile" value="Save file" />
        </form>
    </div>
</body>

</html>