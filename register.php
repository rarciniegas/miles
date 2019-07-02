<?php
include('lib/common.php');
// written by Team 044
// PHP and HTML code copied and modified from GT Online sample provided by the instructors
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $make = mysqli_real_escape_string($db, $_POST['make']);
    $model = mysqli_real_escape_string($db, $_POST['model']);
    $vehiclename = mysqli_real_escape_string($db, $_POST['vehicle_name']);
    $license = mysqli_real_escape_string($db, $_POST['license']);
    $photo = addslashes(file_get_contents($_FILES['image']['tmp_name']));

    $isValidMake = !is_null($make) && (trim($make) != '');
    $isValidModel = !is_null($model) && (trim($model) != '');
    $isValidVehiclename = !is_null($vehiclename) && (trim($vehiclename) != '');
    $isValidLicense = !is_null($license) && (trim($license) != '');


    if (!$isValidMake) {
        array_push($error_msg, "Please enter a make.");
    }

    if (!$isValidModel) {
        array_push($error_msg, "Please enter a model.");
    }

    if (!$isValidVehiclename) {
        array_push($error_msg, "Please enter a vehicle name.");
    }

    if (!$isValidLicense) {
        array_push($error_msg, "Please enter a license.");
    }

    if ($isValidVehiclename && $isValidLicense && $isValidMake && $isValidModel) {
        $query = "INSERT INTO `Vehicle` (make, model, vehicle_name, license, photo) VALUES ('$make',  '$model', '$vehiclename', '$license', '$photo')";
        $queryID = mysqli_query($db, $query);
        if ($query) {
            header(REFRESH_TIME . 'url=login.php');
        }
        array_push($error_msg, "Duplicate vehicle name");
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

    <title>Miles+ Registration</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">



    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">


</head>


<div class="container">

    <form class="form-signin" action="register.php" method="post" enctype="multipart/form-data">
        <h2 class="form-signin-heading">Register Vehicle</h2>
        <label class="item_label">Make</label>
        <input type="text" name="make" value="" class="form-control"/>
        <label class="item_label">Model</label>
        <input type="text" name="model" value="" class="form-control"/>
        <label class="item_label">Vehicle Name</label>
        <input type="text" name="vehicle_name" value="" class="form-control">
        <label class="item_label">License</label>
        <input type="password" name="license" value="" class="form-control">

        <label class="item_label">Photo</label>
        <input type="file" name="image" id="image" />

        <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
        <a href="login.php" class="btn btn-default btn-lg btn-block" role="button">Sign in</a>
    </form>



</div> <!-- /container -->


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>

</body>
</html>
