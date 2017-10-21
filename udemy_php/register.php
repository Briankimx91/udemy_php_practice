<?php
    require "config/config.php";
    require "includes/form_handlers/register_handler.php";
    require "includes/form_handlers/login_handlers.php";

?>

<!DOCTYPE html>
<html>
<head>
    <title>Udemy tesing social media site</title>
    <link rel="stylesheet" href="assets/css/register_style.css">
</head>
<body>
    <div class="wrapper">
        <div class="login_header">
            <h1>Udemy Project</h1>
            Login or Sign up below!
        </div>
        <div class="login_box">
            <form action="register.php" method="POST">
                <input type="email" name="log_email" placeholder="Email address" value="<?php
                if(isset($_SESSION['log_email'])){
                    echo $_SESSION['log_email'];
                }
                ?>"><br>
                <input type="password" name="log_password" placeholder="Password"><br>
                <input type="submit" name="login_button" value="login">

                <?php if(in_array("Email or password was incorrect<br>", $error_array)) echo "Email or password was incorrect<br>"; ?>
            </form>
            <br>

            <form action="register.php" method="POST">
                <input type="text" name="reg_fname" placeholder="First Name" value="<?php
                    if(isset($_SESSION['reg_fname'])){
                        echo $_SESSION['reg_fname'];
                    }
                    ?>" required>
                <br>
                <?php
                    if(in_array("First name must be between 2 and 25 characters<br>"
                        , $error_array)){
                        echo "First name must be between 2 and 25 characters<br>";
                    }
                ?>

                <input type="text" name="reg_lname" placeholder="Last Name" value="<?php
                    if(isset($_SESSION['reg_lname'])){
                        echo $_SESSION['reg_lname'];
                    }
                ?>" required>
                <br>
                <?php
                    if(in_array("Last name must be between 2 and 25 characters<br>"
                        , $error_array)){
                        echo "Last name must be between 2 and 25 characters<br>";
                    }
                ?>

                <input type="email" name="reg_email" placeholder="Email" value="<?php
                    if(isset($_SESSION['reg_email'])){
                        echo $_SESSION['reg_email'];
                    }
                ?>" required>
                <br>

                <input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php
                    if(isset($_SESSION['reg_email2'])){
                        echo $_SESSION['reg_email2'];
                    }
                ?>" required>
                <br>
                <?php
                    if(in_array("Email already in use<br>", $error_array)){
                        echo "Email already in use<br>";
                    } else if(in_array("Invalid email format<br>", $error_array)){
                        echo "Invalid email format<br>";
                    } else if(in_array("Emails don't match<br>", $error_array)){
                        echo "Emails don't match<br>";
                    }
                ?>

                <input type="password" name="reg_password" placeholder="Password" required>
                <br>

                <input type="password" name="reg_password2" placeholder="Confirm Password" required>
                <br>

                <?php
                    if(in_array("Passwords don't match<br>", $error_array)){
                        echo "Passwords don't match<br>";
                    } else if(in_array("passwords must be from 5 and 30 characters long<br>", $error_array)){
                        echo "passwords must be from 5 and 30 characters long<br>";
                    } else if(in_array("passwords must be english characters or numbers<br>", $error_array)){
                        echo "passwords must be english characters or numbers<br>";
                    }

                ?>



                <input type="submit" name="reg_button" value="Register">
                <?php
                    if(in_array("<span style='color:#14C800;'>You are all set! Go ahead and login!</span><br>", $error_array)){
                        echo "<span style='color:#14C800;'>You are all set! Go ahead and login!</span><br>";
                    }
                ?>

            </form>
        </div>
    </div>
</body>
</html>
