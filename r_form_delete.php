<?php
include 'r_form_connection.php';
$id = intval($_GET['id']);
$sql= "DELETE FROM r_forms WHERE id = $id";
$result= mysqli_query($con,$sql);
header("Location: r_form_table.php");
?>
