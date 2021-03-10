<?php

session_start();

$id = 0;
$update = false;
$title = '';
$story = '';

$mysqli = new mysqli('localhost', 'W01308982', 'Derekcs!', 'W01308982') or die(mysqli_error($mysqli));

if(isset($_POST['publish'])){
    $title = $_POST['title'];
    $story = $_POST['story'];
    $author = $_POST['author'];

    $mysqli->query("INSERT INTO blogpost (title, story, author) VALUES('$title', '$story', '$author')") or die($mysqli->error);

    $_SESSION['message'] = "Your post has been successfully published!";
    $_SESSION['msg_type'] = "success";

    header("location: blogpost.php");
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM blogpost WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "Your post has been successfully deleted.";
    $_SESSION['msg_type'] = "danger";

    header("location: profile.php");

}

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM blogpost WHERE id=$id") or die($mysqli->error);
    if($result->num_rows > 0){
        $row = $result->fetch_array();
        $title = $row['title'];
        $story = $row['story'];
    }
}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $title = $_POST['title'];
    $story = $_POST['story'];

    $mysqli->query("UPDATE blogpost SET title='$title', story='$story' WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "Your post has been successfully updated!";
    $_SESSION['msg_type'] = "warning";

    header("location: blogpost.php");
}