<?php
$conn = mysqli_connect("127.0.0.1", "root", "12345", "mydb");
if (!$conn) {

    die("Error: " . mysqli_connect_error());
}

$employee_name = mysqli_real_escape_string($conn, $_POST['name']);
$task_name = mysqli_real_escape_string($conn, $_POST['tname']);
$schedule_reg = mysqli_real_escape_string($conn, $_POST['sname']);
$day = mysqli_real_escape_string($conn, $_POST['dayofjob']);

$sql1 = mysqli_query($conn, "select * from employee where name='".$employee_name."';");

while ($row = mysqli_fetch_assoc($sql1)) {
    
    $id_employee = $row['id']; 
}

$sql2 = mysqli_query($conn, "select * from task where task_name='".$task_name."';");

while ($row = mysqli_fetch_assoc($sql2)) {
    $id_task = $row['id'];
}

$sql3 = mysqli_query($conn, "select * from schedule where regime='".$schedule_reg."';");

while ($row = mysqli_fetch_assoc($sql3)) {
    $id_schedule = $row['id'];
}



$sql = "UPDATE employee_schedule_task SET employee_id=".$id_employee.", task_id=".$id_task.", schedule_date=".$id_schedule.", day= '".$day."' where id=".$_POST['id'].";"; 
mysqli_query($conn, $sql);
?> 

<script language = "javascript">
    window.location.href = "giveTask.php";
</script>