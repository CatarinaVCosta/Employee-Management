<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title>Management System</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="navbar-fixed-top.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="assets/js/ie-emulation-modes-warning.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <?php

        use SendEmail;

require 'classMail.php';

        /**
          session_start();
          //Caso o usuário não esteja autenticado, limpa os dados e redireciona
          if (!isset($_SESSION['email']) and ! isset($_SESSION['password'])) {
          //Destrói
          session_destroy();

          //Limpa
          unset($_SESSION['email']);
          unset($_SESSION['password']);

          //Redireciona para a página de autenticação
          header('location:signin/login.html');
          }
         */
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

//        $result = mysqli_query($conn, "select * from employee;");
//        while ($row = mysqli_fetch_assoc($result)) {
//
//            $mail = $row['email'];
//            $ssn2 = $row['ssn'];
//            $phone = $row['phone_number'];
//            if ($email == $mail || $ssn == $ssn2 || $phone_number == $phone) {
//                header('location:insert1.php');
//               
//                
//            }
//            
//        }

        if ($_POST['role'] == "candidate") {
            $role = 0;
        } elseif ($_POST['role'] == "employee") {
            $role = 1;
        } else {
            $role = 2;
        }

        if (isset($_FILES['photo'])) {

            // Get image type.
            list($_1, $_2, $imtype, $_4 ) = getimagesize($_FILES['photo']['tmp_name']);

            // 1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 6 = BMP, 7 = TIFF(intel byte order), 8 = TIFF(motorola byte order), 9 = JPC, 10 = JP2, 11 = JPX, 12 = JB2, 13 = SWC, 14 = IFF, 15 = WBMP, 16 = XBM.
            // cheking image type
            if ($imtype == 3)
                $ext = "png";
            // to use it later in HTTP headers
            elseif ($imtype == 2)
                $ext = "jpeg";
            elseif ($imtype == 1)
                $ext = "gif";
            else
                $msg = 'Error: unknown file format';

            if (!isset($msg)) {// If there was no error
                $data = file_get_contents($_FILES['photo']['tmp_name']);
                // Preparing data to be used in MySQL query
                $data = mysqli_real_escape_string($conn, $data);

                // $sql = "INSERT INTO " . $table . " SET ext='" . $ext . "', title='" . $title . "',
                // data='" . $data . "';";
                //mysqli_query($conn, $sql);
                // $msg = 'Success: image uploaded';
            }
        }


        // echo (" Nome = $name, SSN=  $ssn, data =  $birthdate , mail = $email,  nr = $phone_number, ex= $experience, add= $address, rl =$role");
        if ($role == 1 || $role == 2) {
            $random_pass = range('a', 'z');
            shuffle($random_pass);
            $pass = array_slice($random_pass, 0, 5);
            $passw = implode("", $pass);

            $pw = crypt($passw);
        } else {
            $pw = crypt('0000');
        }

        $sql = "INSERT INTO employee (name, ssn, birthdate, email, password, phone_number, experience, address,role,data) 
                    VALUES('$name', $ssn, '$birthdate', '$email', '$pw', $phone_number, '$experience', '$address', $role, '$data')";


        if (!mysqli_query($conn, $sql)) {
            ?>
            <script> alert("Check your email or ssn or phone number");
                window.location.href = 'insert1.php';</script>

            <?php
        }

        //echo $email;
        if ($role == 1 || $role == 2) {
            $send_email = new SendEmail($email, $passw, $name);
            $send_email->sendPWemail();
        }
        ?>
        <script> alert("Employee added");
                window.location.href = 'list.php';</script>

        <?php
        //header('location:list.php');
        //header('location:insert1.php');
        mysqli_close($conn);
        ?>
    </script>
</body>
</html>
