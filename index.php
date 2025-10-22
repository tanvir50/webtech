<?php
  $conn = mysqli_connect("localhost", "root", '', 'myDatabase');

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }else{
        echo "connetted <br>";
    }

    $sql = "CREATE DATABASE IF NOT EXISTS " . 'myDatabase';
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully<br>";
    } else {
        die("Error creating database: " . $conn->error);
    }

    mysqli_select_db($conn, 'myDatabase');

    $sql = "CREATE TABLE IF NOT EXISTS profile (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        myname VARCHAR(30) NOT NULL,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    if (mysqli_query($conn, $sql)) {
        echo "Table created successfully<br>";
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }

    if (isset($_POST["mysubmit"])) {

        $name = $_POST["myjname"];

        // Insert data into table.
        $tabesql = "INSERT INTO profile (myname) VALUES ('$name')";

        if ($conn->query($tabesql) === true) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $tabesql . "<br>" . $conn->error;
        }
    }

?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP CRUD Operation using OOP</title>
</head>
<body>
<?php if (isset($message)) echo "<p>$message</p>"; ?>
<form action="" method="post">
    <label for="name">Name</label>
    <input type="text" name="myjname" id="name" >
    <button type="submit" name="mysubmit">Save</button>
</form>


<?php

// Handle delete request
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $delete_sql = "DELETE FROM profile WHERE id = $id";
    if ($conn->query($delete_sql) === true) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Handle update request
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $new_name = $conn->real_escape_string($_POST['new_name']);
    $update_sql = "UPDATE profile SET myname = '$new_name' WHERE id = $id";
    if ($conn->query($update_sql) === true) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$sql = "SELECT id, myname FROM profile";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
        <p>My name is <?= htmlspecialchars($row['myname']) ?></p>

        <!-- Delete button form -->
        <form action='' method='POST' style='display:inline-block;'>
            <input type='hidden' name='id' value='<?= $row['id'] ?>'>
            <button type='submit' name='delete'>Delete</button>
        </form>

        <!-- Update button form -->
        <form action='' method='POST' style='display:inline-block;'>
            <input type='text' name='new_name' placeholder='Enter new name'>
            <input type='hidden' name='id' value='<?= $row['id'] ?>'>
            <button type='submit' name='update'>Update</button>
        </form>
        <br><br>
        <?php
    }
} else {
    echo "No records found.";
}
?>
</body>
</html>