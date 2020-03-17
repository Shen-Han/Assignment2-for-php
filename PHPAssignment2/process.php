<?php
session_start();

//Connect to online SQL database via myPHPAdmin
$mysqli= new mysqli('localhost','root'.'mypass123'.'crud') or die(mysqli_error($mysqli));

$update = false;
$name = '';
$location = '';
$id=0;
//Interaction with SQL database.
if(isset($_POST['save'])){
    $name=$_POST['name'];
    $location=$_POST['location'];

    $mysqli->query("INERT INTO data (name, location) VALUES ('$name','$location')") or
    die($mysqli ->error);

    //Communite with the user on what they are doing
    $_SESSION['message'] = "Record has been saved";
    $_SESSION['msg_type'] = "success";

    //Redirect user back to index page.
    header("location:index.php");
}

//Delete button will be almost identical to the above save button except with delete from command in the sql line
if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $mysqli->query("DELETE FROM data WHERE id=$id") or
    die($mysqli->error());

    $_SESSION['message'] = "Record has been deleted";
    $_SESSION['msg_type'] = "danger";

    header("location:index.php");
}

//check if the edit button has been clicked

if(isset($_GET['edit'])){
    $id =$_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT*FROM data WHERE id=$id") or
    die($mysqli->error());
//ensure that there is a result
    if(count($result)==1){
        $row = $result->fetch_array();
        $name = $row['name'];
        $location = $row['location'];
    }
}

//check if the UPDATE button has been clicked, assignment 2 deliverable

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];

    $mysqli->query("UPDATE data SET name='$name', location='$location'WHERE id=$id") or
    die($mysqli->error);

    $_SESSION['message'] = "Record has been updated";
    $_SESSION['msg_type'] = "warning";

    header("location:index.php");
}