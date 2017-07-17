<?php

$conn = mysqli_connect("127.0.0.1", "root", "12345", "mydb");
if (!$conn) {

    die("Error: " . mysqli_connect_error());
}

$name = mysqli_real_escape_string($conn, $_POST['name']);
$ssn = mysqli_real_escape_string($conn, $_POST['ssn']);
$birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
$experience = mysqli_real_escape_string($conn, $_POST['experience']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$role = mysqli_real_escape_string($conn, $_POST['role']);

$sql="UPDATE employee SET name='$name', ssn=$ssn, birthdate='$birthdate', email='$email', phone_number=$phone_number, experience='$experience',address='$address',role=$role WHERE id=".$_POST['id'].";";
mysqli_query($conn, $sql );
?>

<script language = "javascript">
    window.location.href = "list.php";
</script>

