<?php

include('lib/common.php');


if (!isset($_SESSION['vehicle_name'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $vehicle_name = $_SESSION['vehicle_name'];

    $this_sale = number_format($_POST['this_sale'], 2);
    $gallons = number_format($_POST['gallons'], 3);
    $miles = number_format($_POST['miles'], 0);
    echo ($_POST['this_sale']);
    echo ($_POST['gallons']);
    echo ($_POST['miles']);

    $query = "INSERT INTO `Fillup` ( `date_time`,`this_sale`, `gallons`, `vehicle_name`, `miles`)
                  VALUES (now(), '$this_sale', '$gallons', '$vehicle_name', '$miles');";

    $result = mysqli_query($db, $query);

    include('lib/show_queries.php');

    if (!empty($result)) {
        header(REFRESH_TIME . 'url=welcome.php');
    } else {
        array_push($error_msg, "Invalid data entry. ");
    }
}
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

    <title>Miles+ Fill er up</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">



    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">


</head>


<div class="container">

    <form class="form-signin" action="fill-up.php" method="post">
        <h2 class="form-signin-heading">Fill up</h2>

        <label>This Sale</label>
        <input type="number" step="any" name="this_sale" value="0.00" class="form-control"/>
        <label class="item_label">Gallons</label>
        <input type="number" step="any" name="gallons" value="0.000" class="form-control"/>
        <label class="item_label">Miles</label>
        <input type="number" name="miles" value="0" class="form-control">


        <button class="btn btn-lg btn-primary btn-block" type="submit">Record</button>
        <a href="welcome.php" class="btn btn-default btn-lg btn-block" role="button">Cancel</a>
    </form>



</div> <!-- /container -->


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>

</body>
</html>
