<?php
include('session.php');
include('config.php');

if (isset($_GET["open"])) {
}

if (isset($_GET["del"])) {
    $id = $_GET["del"];
    $sql = "DELETE FROM files WHERE id=$id";
    if (!mysqli_query($db, $sql)) {
        $errors = "Error deleting record: " . mysqli_error($db);
    }
    header("location: app.php");
}

$sql = "SELECT * FROM files WHERE createdBy=$user";
$result = mysqli_query($db, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File management system</title>
    <link rel="stylesheet" href="./assets/basic.css">
    <link rel="stylesheet" href="./assets/app.css">
</head>

<body>
    <div class="app">
        <?php echo $errors; ?>
        <div class="appButtons">
            <a href="openFile.php"><button>Create New File</button></a>
            <a href="logout.php"><button>Sign Out</button></a>
        </div>
        <div class="files">
            <?php if (mysqli_num_rows($result) == 0) {
                echo "<p><em>No files found</em></p>\n";
            } else {
                $i = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='row'>";
                    echo "<div class='sno'>" . $i++ . ".</div>";
                    echo "<div class='name'>" . $row["name"] . "</div>";
                    echo "<div class='created'>Created at: " . $row["createdOn"] . "</div>";
                    echo "<div class='open'><a href='openFile.php?id=" . $row["id"] . "'><button>Open</button></a></div>";
                    echo "<div class='del'><a href='?del=" . $row["id"] . "'><button>Delete</button></a></div>";
                    echo "</div>";
                }
            } ?>
        </div>
    </div>
</body>

</html>