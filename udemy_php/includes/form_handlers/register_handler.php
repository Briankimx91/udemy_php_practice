<?php

// Declaring variables to prevent errors

$fname = ""; //first name
$lname = ""; // last name
$em = ""; // email
$em2 = ""; // email2
$password = ""; //password
$password2 = ""; //password2
$date = ""; // sign up date
$error_array = array(); // holds error message

if(isset($_POST['reg_button'])){
    //registration form values

    //first name
    $fname = strip_tags($_POST['reg_fname']); //remove html tags
    $fname = str_replace(' ', '', $fname); //remove spaces
    $fname = ucfirst(strtolower($fname)); //Uppercase first letter
    $_SESSION['reg_fname'] = $fname; // Store first name into session variable

    //last name
    $lname = strip_tags($_POST['reg_lname']); //remove html tags
    $lname = str_replace(' ', '', $lname); //remove spaces
    $lname = ucfirst(strtolower($lname)); //Uppercase first letter
    $_SESSION['reg_lname'] = $lname; // Store last name into session variable

    // email
    $em = strip_tags($_POST['reg_email']); //remove html tags
    $em = str_replace(' ', '', $em); //remove spaces
    $em = ucfirst(strtolower($em)); //Uppercase first letter
    $_SESSION['reg_email'] = $em; // Store email into session variable

    //email 2
    $em2 = strip_tags($_POST['reg_email2']); //remove html tags
    $em2 = str_replace(' ', '', $em2); //remove spaces
    $em2 = ucfirst(strtolower($em2)); //Uppercase first letter
    $_SESSION['reg_email2'] = $em2; // Store email 2 into session variable

    //password
    $password = strip_tags($_POST['reg_password']);
    $password2 = strip_tags($_POST['reg_password2']); //remove html tags

    //date
    $date = date("Y-m-d"); //current date


    if($em == $em2){
        // check if email
        if(filter_var($em, FILTER_VALIDATE_EMAIL)){

            $em = filter_var($em, FILTER_VALIDATE_EMAIL);

            //check if email already exists
            $e_check = mysqli_query($con, "SELECT email FROM users WHERE email = '$em'");

            //count the number of rows returned
            $num_rows = mysqli_num_rows($e_check);

            if($num_rows > 0){
                array_push($error_array, "Email already in use<br>");
            }

        } else {
            array_push($error_array, "Invalid email format<br>");
        }

    } else {
        array_push($error_array, "Emails don't match<br>");
    }

    if(strlen($fname) > 25 || strlen($fname) < 2){
        array_push($error_array, "First name must be between 2 and 25 characters<br>");
    }
    if(strlen($lname) > 25 || strlen($lname) < 2){
        array_push($error_array, "Last name must be between 2 and 25 characters<br>");
    }
    if($password !== $password2){
        array_push($error_array, "Passwords don't match<br>");
    } else {
        if(preg_match('/[^A-Za-z0-9]/',$password)){
            array_push($error_array, "passwords must be english characters or numbers<br>");
        }
    }

    if(strlen($password) > 30 || strlen($password) < 5){
        array_push($error_array, "passwords must be from 5 and 30 characters long<br>");
    }

    if(empty($error_array)){
        $password = md5($password); //encrypt password before sending to database

        //Generate username by concatenating first name and last name

        $username = strtolower($fname . "_" . $lname);
        $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");

        $i = 0;
        //if username exists add number to username
        while(mysqli_num_rows($check_username_query) != 0){
            $i++;
            $username = $username . "_" . $i;
            $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
        }

        //profile picture assignment
        $rand = rand(1 , 2); //random number from 1 and 2

        if($rand == 1){
            $profile_pic = "assets/img/profile_pics/default/default_pic.png";
        } else {
            $profile_pic = "assets/img/profile_pics/default/default_pic2.png";
        }

        $query = mysqli_query($con, "INSERT INTO users VALUES ('','$fname','$lname','$username','$em','$password','$date','$profile_pic','0','0','no',',')");

        array_push($error_array, "<span style='color:#14C800;'>You are all set! Go ahead and login!</span><br>");

        //Clear session variables

        $_SESSION['reg_fname'] = '';
        $_SESSION['reg_lname'] = '';
        $_SESSION['reg_email'] = '';
        $_SESSION['reg_email2'] = '';


    }


}


?>