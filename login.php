<?php
include('lib/common.php');
if ($showQueries) {
    array_push($query_msg, "showQueries currently turned ON, to disable change to 'false' in lib/common.php");
}

//Note: known issue with _POST always empty using PHPStorm built-in web server: Use *AMP server instead
if ($_SERVER['REQUEST_METHOD'] == 'POST') {



    $enteredVehicleName = mysqli_real_escape_string($db, $_POST['vehicle_name']);
    $enteredLicense = mysqli_real_escape_string($db, $_POST['license']);


    $isValidVehiclename = !is_null($enteredVehicleName) && (trim($enteredVehicleName) != '');
    $isValidLicense = !is_null($enteredLicense) && (trim($enteredLicense) != '');

    if (!$isValidVehiclename) {
        array_push($error_msg, "Please enter a vehicle name.");
    }

    if (!$isValidLicense) {
        array_push($error_msg, "Please enter a license.");
    }

    if ($isValidVehiclename && $isValidLicense) {

        $query = "SELECT license FROM Vehicle WHERE vehicle_name='$enteredVehicleName'";

        $result = mysqli_query($db, $query);
        include('lib/show_queries.php');
        $count = mysqli_num_rows($result);

        if (!empty($result) && ($count > 0)) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $storedLicense = $row['license'];

            $options = [
                'cost' => 8,
            ];
            //convert the plaintext passwords to their respective hashses
            $storedHash = password_hash($storedPassword, PASSWORD_DEFAULT, $options);   //may not want this if $storedPassword are stored as hashes (don't rehash a hash)
            $enteredHash = password_hash($enteredPassword, PASSWORD_DEFAULT, $options);


            // Debugging info
            if ($showQueries) {
                array_push($query_msg, "Plain text entered password: " . $enteredPassword);
                //Note: because of salt, the entered and stored password hashes will appear different each time
                array_push($query_msg, "Entered Hash:" . $enteredHash);
                array_push($query_msg, "Stored Hash:  " . $storedHash . NEWLINE);  //note: change to storedHash if tables store the plaintext password value
                //unsafe, but left as a learning tool uncomment if you want to log passwords with hash values
                //error_log('email: '. $enteredEmail  . ' password: '. $enteredPassword . ' hash:'. $enteredHash);
            }

            //depends on if you are storing the hash $storedHash or plaintext $storedPassword
            if (password_verify($enteredPassword, $storedHash)) {
                array_push($query_msg, "Password is Valid! ");
                $_SESSION['vehicle_name'] = $enteredVehicleName;
                array_push($query_msg, "logging in... ");
                header(REFRESH_TIME . 'url=welcome.php');        //to view the password hashes and login success/failure

            } else {
                array_push($error_msg, "Login failed: " . $enteredVehicleName . NEWLINE);
            }

        } else {
            array_push($error_msg, "The vehicle name entered does not exist: " . $enteredVehicleName);
        }
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

    <title>Miles+ sign in</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">


</head>


<div class="container">

    <form class="form-signin" action="login.php" method="post" enctype="multipart/form-data">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label class="item_label">Vehicle Name</label>
        <input type="text" name="vehicle_name" value="" class="form-control" autofocus/>
        <label class="item_label">license</label>
        <input type="text" name="license" value="" class="form-control"/>

        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <a href="register.php" class="btn btn-default btn-lg btn-block" role="button">Register</a>
    </form>

</div> <!-- /container -->





<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>

</body>
</html>
