<?php
/**session_start();

//Caso o usuário não esteja autenticado, limpa os dados e redireciona
if (!isset($_SESSION['email']) and ! isset($_SESSION['password'])) {
    //Destrói
    session_destroy();

    //Limpa
    unset($_SESSION['email']);
    unset($_SESSION['password']);

    //Redireciona para a página de autenticação
    header('location:signin/login.php');
}*/

$conn = mysqli_connect("127.0.0.1", "root", "12345", "mydb");

if (!$conn) {

    die("Error: " . mysqli_connect_error());
}

$user_email = $_SESSION['email'];
$result = mysqli_query($conn, "select * from schedule;");

$sql_query = mysqli_query($conn, "select name, data from employee where email=" . "'$user_email'" . ";");

while ($row = mysqli_fetch_assoc($sql_query)) {
    $name_img = $row['name'];
    $img_user = $row['data'];
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script> 
        <script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
        <script>
            webshims.setOptions('forms-ext', {types: 'date'});
            webshims.polyfill('forms forms-ext');
            $.webshims.formcfg = {
                en: {
                    dFormat: '-',
                    dateSigns: '-',
                    patterns: {
                        d: "yy-mm-dd"
                    }
                }
            };
        </script>

        <meta charset = "utf-8">
        <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
        <meta name = "viewport" content = "width=device-width, initial-scale=1">
        <!--The above 3 meta tags *must* come first in the head;
        any other head content must come *after* these tags -->
        <meta name = "description" content = "">
        <meta name = "author" content = "">
        <link rel = "icon" href = "../../favicon.ico">

        <title>Management System</title>

        <!--Bootstrap core CSS -->
        <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity = "sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin = "anonymous">
        <!--IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href = "assets/css/ie10-viewport-bug-workaround.css" rel = "stylesheet">

        <!--Custom styles for this template -->
        <link href = "navbar-fixed-top.css" rel = "stylesheet">

        <!--Just for debugging purposes. Don't actually copy these 2 lines! -->
                <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="assets/js/ie-emulation-modes-warning.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <!-- Fixed navbar -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand">A Ideal de Leixões</a>
                </div>
                <!--<div class="row">-->
                <!--<div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">-->
                <div class="row">
                    <ul class="nav navbar-nav navbar-left">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Employee <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="list.php">List all</a></li> 
                                <li><a href="register.php">Registers </a></li> 
                            </ul>
                        </li>
                        <li role="presentation"><a href="schedule.php">Schedule </a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Task <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="task.php">Define tasks </a></li>
                                <li><a href="giveTask.php">Give tasks </a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a><?php echo '<img src = "data:image/jpg;base64,' . base64_encode($img_user) . '" . class = "img-circle . witdh="30px" height="25px">' ?></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $name_img
?><span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="changePassword.php">Change password</a></li> 
                                <li><a href="index.php?action=logout">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>


                <!--<li><a href="#contact">Contact</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li role="separator" class="divider"></li>
                    <li class="dropdown-header">Nav header</li>
                    <li><a href="#">Separated link</a></li>
                    <li><a href="#">One more separated link</a></li>
                  </ul>
                </l>-->

                <!--<ul class="nav navbar-nav navbar-right">
                  <li><a href="../navbar/">Default</a></li>
                  <li><a href="../navbar-static-top/">Static top</a></li>
                  <li class="active"><a href="./">Fixed top <span class="sr-only">(current)</span></a></li>
                </ul>-->
            </div><!--/.nav-collapse -->

        </nav>
        <br>

        <br>
        <div class="container">
            <!-- <div class="jumbotron">-->
            <form action="insert.php" method="POST" enctype="multipart/form-data">
                Name: <br><input type="text" name="name" value="" autofocus="" required=""/><br><br> 
                Birthdate: <br><input type="date" name="birthdate" value="" required=""/><br><br> 
                Email: <br><input type="text" name="email" value="" required=""/><br><br>
                Phone: <br><input type="text" name="phone_number" value="" required=""/><br><br>
                Address: <br><input type="text" name="address" value="" required=""/><br><br>
                SSN: <br><input type="text" name="ssn" value="" required=""/><br><br>
                Experience: <br><input type="text" name="experience" value="" required=""/><br><br>
                Candidate: <input type="radio" name="role" value="candidate" />&nbsp &nbsp;
                Employee: <input type="radio" name="role" value="employee" /> &nbsp &nbsp;
                Admin: <input type="radio" name="role" value="admin" /><br><br>
                <!--<input type="submit" value="Submit"/>-->
                Upload new image: <input type="file" name="photo" id="photo"><br><br>
                <button id="submit">Submit</button>
            </form>
        </div>

        <!--<div class="container">
    
        <!-- Main component for a primary marketing message or call to action 
        <div class="jumbotron">
          <h1>Navbar example</h1>
          <p>This example is a quick exercise to illustrate how the default, static and fixed to top navbar work. It includes the responsive CSS and HTML, so it also adapts to your viewport and device.</p>
          <p>To see the difference between static and fixed top navbars, just scroll.</p>
          <p>
            <a class="btn btn-lg btn-primary" href="../../components/#navbar" role="button">View navbar docs &raquo;</a>
          </p>
        </div>
  
      </div> --><!-- /container -->


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