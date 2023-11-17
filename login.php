
<?php 
$title = 'TrademanHub | Sign in';
include('includes/navbar.php');

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] ==  true){
  header('location: search.php');
  die();
}


  // On login button click

$email = $password = $result = ""; 

if($_SERVER["REQUEST_METHOD"] == "POST"){

  require_once '../models/User.php';
  if(isset($_POST['login_btn'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $isValidEmail = $email;
    $isValidPassword = $password;

    if($isValidEmail && $isValidPassword) {
        // Handle database interactions
        $signedInUser = (new UserManagement)
            ->signInUser($email, $password);

        if($signedInUser){
            // Handle page redirects and sessions
            $_SESSION['logged_in'] = true;
            $_SESSION['logged_in_user'] = $signedInUser;
            header('location: search.php');
            die();
        } else {
            $result = "Incorrect login credentials, please try again.";
        }
    }
  }
}


?>
  <div class="row" style="max-height:50vh;">
    <div class="col-sm-12 col-md-6 col-lg-6 mt-5" style="text-align:center;">
      <h5 class="display-4">Access your account</h5>
        <?php
          if($result){
        ?>
          <div class="row justify-content-center">
            <div class="alert alert-dark col-sm-12 col-md-6 col-lg-6" role="alert">
              <?=$result;?>
            </div>
          </div>
        <?php 
            }
        ?>
      
      <form method="post" action="" style="display:flex; flex-direction:column; align-items:end;">
          <div class="row form-group">
            <label class="form-label" for="Email">Email</label>
            <input type="email" name="email" class="form-control col-8" value="<?=$email?>" id="Email">
          </div>
          <div class="row form-group">
            <label class="form-label"  for="Password">Password</label>
            <input type="password" name="password" class="form-control col-8" value="" id="Password" >
          </div>
          <div class="row form-group">
            <button type="submit" name="login_btn" class="login-btn col-4">Login</button>
            <p class="lead">Don't have an account? <a href="register.php">Register</a></p>
          </div>
      </form>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6">
      <img src="images/Register.gif" style="height:100%; width:100%;" alt=""/>
    </div>
  </div>

<map name="Map">
  <area shape="rect" coords="1,-1,253,60" href="Home.html">
</map>
</body>
</html>
