<?php

// require_once('../../models/User.php');

require_once('../models/User.php');

  $signedInUser = (new UserManagement)->signInUser("tladiomphile@gmail.com", "Ikageng123");

  var_dump($signedInUser);


if($_SERVER["REQUEST_METHOD"] == "POST"){
    require_once('../../models/User.php');

    // On register button click
    if(isset($_POST['reg_btn'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password =$_POST['password'];
        $cpassword = $_POST['confirm_password'];

        // Input validation
        $isValidName = $name;
        $isValidEmail = $email;
        $isValidPassword = $password;
        $isValidConfirmPassword = $cpassword;

        if($isValidName && $isValidEmail && $isValidPassword && $isValidConfirmPassword){
            // Handle database interactions and start sessions here

            $signedUpUser = (new UserManagement)
                ->signUpUser($fname, $email, $password, $cpassword);

            if($signedUpUser){
                header('location: ../search.php');
                die();
            }else{
                header('location: ../register.php?error=true&creation=failed');;
            die();
            }
        }else{
            header('location: ../register.php?error=true&invalid=true');
            die();
        }
    }
    
    // On login button click
    if(isset($_POST['login_btn'])){
        $email = $_POST['email'];
        $password =$_POST['password'];

        echo 'Enteref login block<br>'; // Debug

        $isValidEmail = $email;
        $isValidPassword = $password;

        if($isValidEmail && $isValidPassword){
                echo 'Valid email and password'; // Debug
            // Handle database interactions and start sessions here
            $signedInUser = (new UserManagement)
                ->signinUser($email, $password);

            if($signedInUser){
                var_dump($signedUpUser);
                exit;

                header('location: ../search.php');
                die();
            }else{
                echo 'Invalid email and password'; // Debug
                header('location: ../register.php?error=true&login=failed');
                die();
            }
        }else{
            header('location: ../register.php?error=true&invalid=true');
            die();
        }
    }
    header('location: ../register.php?error=true');
            die();

}else{
    header('location: ../register.php?error=true');
    die();
}

?>