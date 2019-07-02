<?php
include('lib/common.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/miles+_favicon.png">

    <title>Miles+ Welcome</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="navbar.css" rel="stylesheet">

</head>

<body>

<div class="container">

    <!-- Static navbar -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Miles +</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="fill-up.php">Input data</a></li>
                    <li><a href="#">Contact</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Statistics <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Miles driven</a></li>
                            <li><a href="#">Money expend</a></li>
                            <li><a href="#">Fuel comsumption</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="logout.php">Log out</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
    </nav>

    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron">
        <h1>Miles +</h1>
        <p>Miles+ is a system that keep track of Miles driven and Gasoline consumption. The user inputs the amount of miles driven, the gallons of gasoline pumped and the price paid for.
        </p>

        <?php
        $name = $_SESSION['vehicle_name'];
        $query = "SELECT vehicle_name, photo FROM Vehicle WHERE  '$name' = vehicle_name";
        $result = mysqli_query($db, $query);

        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
        {
            echo '  
                          <tr> 

                               <td>  
                                    <img src="data:image/jpeg;base64,'.base64_encode($row['photo'] ).'" height="117" width="200" class="img-thumnail" />  
                               </td>  
                          </tr>  
                          <br>
                     ';
        }
        ?>

        <p>
            <a class="btn btn-lg btn-primary" href="fill-up.php" role="button">Fill er up &raquo;</a>
        </p>
    </div>

</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
