<?php

session_start();

//Caso o usuário não esteja autenticado, limpa os dados e redireciona
if (!isset($_SESSION['email']) and ! isset($_SESSION['password'])) {
    //Destrói
    session_destroy();

    //Limpa
    unset($_SESSION['email']);
    unset($_SESSION['password']);

    //Redireciona para a página de autenticação
    header('location:signin/login.php');
}

$conn = mysqli_connect("127.0.0.1", "root", "12345", "mydb");

if (!$conn) {

    die("Error: " . mysqli_connect_error());
}

$user_email = $_SESSION['email'];
//$result = mysqli_query($conn, "select * from schedule;");

$sql_query = mysqli_query($conn, "select name, data, id from employee where email='" . $user_email . "';");

while ($row = mysqli_fetch_assoc($sql_query)) {
    $id = $row['id'];
}

$date = date("Y-m-d");
$result = mysqli_query($conn, "select * from register where employeeID =" . $id . ";");

if (mysqli_num_rows($result) == 0) {

    $query = mysqli_query($conn, "insert into register(employeeID,date,entrance) values (" . $id . ",now(),now());");
    
} else {

    while ($row = mysqli_fetch_assoc($result)) {

        if ($row['idregister'] > $biggest_id)
            $biggest_id = $row['idregister'];
    }

    $query1 = mysqli_query($conn, "select * from register where idregister= $biggest_id;");

    while ($row = mysqli_fetch_assoc($query1)) {

        if ($row['out'] == "" && $row['entrance'] != "") {

            $rid = $row['idregister'];
            $query = mysqli_query($conn, "update register set register.out = now() where idregister=$rid;");
            break;
        } else if ($row['out'] != "" && $row['entrance'] != "") {

            $query = mysqli_query($conn, "insert into register (employeeID, date, entrance) values(" . $id . ",now(),now());");
            break;
        }
    }
}

mysqli_close($conn);

header('location:employee.php');
?>