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

        <title>Signin</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <!-- <link href="../assets/ie10-viewport-bug-workaround.css" rel="stylesheet">-->

        <!-- Custom styles for this template -->
        <link href="signin.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="../assets/js/ie-emulation-modes-warning.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <div class="container">

            <form class="form-signin" method="POST" action="../index.php">
                <h2 class="form-signin-heading">Please login</h2>
                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                <br>
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                <br>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
            </form>
        </div> <!-- /container -->
        <!--<div align='center'>
            <button type='button' class="btn btn-lg btn-danger" data-toggle="popover" title="Popover title" data-content="<form method='POST'>
               <input type='text' name='forgotPassword' value='' />
               </form>">Forgot your password?</button>

            <a href="#" data-toggle="popover" title="Insert your email" data-content='<form method="POST">
               <input type="text" name="forgotPassword" value="" />
               </form>'>Forgot your password?</a>
        </div>-->
        <div align='center'>
            <a id="popover">Forgot your password? </a>
            <div id="popover-head" class="hide">
                Insert your email to get a new password
            </div>
            <div id="popover-content" class="hide">
                <form method="POST">
                    <input type="text" name="forgot" value=""/>
                    <button name ="forgotb" type="submit" class="btn btn-default" aria-label="Left Align">
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                    </button>
                </form>
            </div>
        </div>
        <script>
            $('#popover').popover({
                html: true,
                title: function () {
                    return $("#popover-head").html();
                },
                content: function () {
                    return $("#popover-content").html();
                }
            });
        </script>
    </div>
    <?php

    use SendEmail;

require '../classMail.php';

    $conn = mysqli_connect("127.0.0.1", "root", "12345", "mydb");

    if (!$conn) {

        die("Error: " . mysqli_connect_error());
    }

    if (isset($_POST['forgotb'])) {
        $random_pass = range('a', 'z');
        shuffle($random_pass);
        $pass = array_slice($random_pass, 0, 5);
        $passw = implode("", $pass);

        $pw = crypt($passw);

        $email = mysqli_real_escape_string($conn, $_POST['forgot']);
        $result = mysqli_query($conn, "select * from employee;");

        while ($row = mysqli_fetch_assoc($result)) {
            $mail = $row['email'];
            if ($email == $mail) {
                $aux=1;
                $send_email = new SendEmail($email, $passw, 'employee');
                $send_email->sendPWemail();

                $sql = "update employee set password='" . $pw . "' where email='" . $email . "';";
                //echo $sql. "pw->". $passw;
                if (!mysqli_query($conn, $sql)) {

                    echo("Error: " . mysqli_error());
                }
                ?>
                <script>
                    alert("A new password was sent to your email");
                </script>
                <?php
               break;
               //header('location:login.php');
            }
            else {
                $aux=0;
            }
        }
        ?>
             <?php   if($aux==0) {?>
        <script>
            alert("Invalid email");
        </script>
        <?php
             }
    }
    mysqli_close($conn);
    ?>
    <!-- Bootstrap core JavaScript
      ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>