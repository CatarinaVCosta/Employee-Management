<?php

$conn = mysqli_connect("127.0.0.1", "root", "12345", "mydb");
if (!$conn) {

    die("Error: " . mysqli_connect_error());
}

$name = mysqli_real_escape_string($conn, $_POST['name']);
$salary_hour = mysqli_real_escape_string($conn, $_POST['salary_hour']);

$sql="UPDATE task SET task_name='$name', salary_hour=$salary_hour WHERE id=".$_POST['id'].";";
mysqli_query($conn, $sql );
?>

<script language = "javascript">
    window.location.href = "task.php";
</script> 