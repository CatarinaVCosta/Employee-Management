<?php

$conn = mysqli_connect("127.0.0.1", "root", "12345", "mydb");
if (!$conn) {

    die("Error: " . mysqli_connect_error());
}

$regime = mysqli_real_escape_string($conn, $_POST['regime']);
$start_hour_am = mysqli_real_escape_string($conn, $_POST['start_hour_am']);
$finish_hour_am = mysqli_real_escape_string($conn, $_POST['finish_hour_am']);
$start_hour_pm = mysqli_real_escape_string($conn, $_POST['start_hour_pm']);
$finish_hour_pm = mysqli_real_escape_string($conn, $_POST['finish_hour_pm']);

$sql="UPDATE schedule SET regime='$regime', start_hour_am='$start_hour_am', finish_hour_am='$finish_hour_am', start_hour_pm='$start_hour_pm', finish_hour_pm='$finish_hour_pm' WHERE id=".$_POST['id'].";";
mysqli_query($conn, $sql );
?>

<script language = "javascript">
    window.location.href = "schedule.php";
</script>