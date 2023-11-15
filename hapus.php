<?php


include_once('config.php');

if(!isset($_SESSION["user"])){
    header("Location: login.php");
}

$id = $_GET["id"];

mysqli_query($conn, "DELETE FROM blogs WHERE id = $id");

header("Location: index.php");

