<?php
include('includes/navbar.php');
require_once '../models/User.php';

if(!isset($_SESSION['logged_in'])){
    header('location: login.php');
    die();
  }
$uid = $_SESSION['logged_in_user'];
$result = "";
$manager = new UserManagement();
$user = $manager->getUserRecord($uid);


  if(isset($_GET['verify-email'])){
    $email = $user->email;
    $sendVerificaton = $manager->sendEmailVerification($email);
    if($sendVerificaton){
        $result = "Email successfully sent.";
    }else{
        $result = "Failed to send email";
    }
  }

  
  if(isset($_GET['reset-pwd'])){
    $email = $user->email;
    $passwordReset = $manager->passwordReset($email);
    if($passwordReset){
        $result = "Password reset email was sent.";
    }else{
        $result = "Failed to send password reset email";
    }
  }

?>

<?php
    if($result){
?>
<div class="error-display">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?=$result?>   
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>

<?php
}
?>





<div class="row">
  <div class="col-3 mt-3">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      <a class="nav-link active" id="v-pills-personal-tab" data-toggle="pill" href="#v-pills-personal" role="tab" aria-controls="v-pills-personal" aria-selected="true">Personal Information</a>
      <a class="nav-link" id="v-pills-address-tab" data-toggle="pill" href="#v-pills-address" role="tab" aria-controls="v-pills-address" aria-selected="false">Address Book</a>
    </div>
  </div>
  <div class="col-9 p-5">
    <div class="tab-content" id="v-pills-tabContent">
      <div class="tab-pane fade show active" id="v-pills-personal" role="tabpanel" aria-labelledby="v-pills-personal-tab">
      <div class="card-header d-flex justify-content-between">
            Personal information
            <button type="submit" class="btn btn-light" name="edit-personal" id="edit-personal"><i class="ri-pencil-line"></i></button> 
        </div>
        <div class="card-body">
            <form method="post" action="" class="col-12">
                <div class="form-row">
                    <div class="fg-personal form-group fg-row col-sm-12 col-md-6">
                        <label class="col-form-label-sm col-sm-2">Name</label>
                        <div class="col-sm-8">
                            <input type="text" name="full-name"  value="<?=$user->displayName?>" class="form-control-sm form-control-plaintext" readonly>
                        </div>
                    </div>
                    <div class="fg-personal form-group fg-row col-sm-12 col-md-6">
                        <label class="col-form-label-sm col-sm-2">Email</label>
                        <div class="col-sm-8">
                            
                            <div class="input-group input-group-sm">
                                <input type="text" name="email" value="<?=$user->email?>" class="form-control-sm form-control-plaintext" readonly>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <?php
                                            if($user->emailVerified){
                                                echo '<i class="ri-verified-badge-fill" style="color:green;"></i>';
                                            }else{
                                                echo '<a href="?verify-email" alt="verify"><i class="ri-verified-badge-fill" style="color:yellow;"></i></a>';
                                            }
                                        ?>                                
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="fg-personal form-group fg-row col-sm-12 col-md-6">
                        <label class="col-form-label-sm col-sm-2">Cell Number</label>
                        <div class="col-sm-8">
                            <input type="text" name="phone-number" value="<?=$user->phoneNumber?>" class="form-control-sm form-control-plaintext" readonly>
                        </div>
                    </div>
                    <div class="fg-personal form-group fg-row col-sm-12 col-md-6">
                        <label class="col-form-label-sm col-sm-2">Password</label>
                        <div class="col-sm-8">
                        <div class="input-group input-group-sm">
                            <input type="password" name="password"  value="<?=$user->password?>" class="form-control-sm form-control-plaintext" readonly disabled>
                            <div class="input-group-append">
                                <div class="input-group-text"><a href="?reset-pwd"><i class="ri-refresh-line"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row justify-content-end">
                    <button type="submit" id="btn-personal-cancel" class="btn btn-sm btn-light" style="display:none;" >Cancel</button>
                    <button type="submit" id="btn-personal" class="btn btn-sm btn-outline-dark" style="display:none;" name="save-personal">Save</button>
                </div>
            </form>
        </div>
      </div>
      <div class="tab-pane fade" id="v-pills-address" role="tabpanel" aria-labelledby="v-pills-address-tab">
        <div class="card-header d-flex justify-content-between">
            Address
            <button type="submit" class="btn btn-light" name="edit-address" id="edit-address"><i class="ri-pencil-line"></i></button> 
        </div>
            <form method="post" action="" class="col-12">
                <div class="card-body">
                    <div class="form-row">
                        <div class="fg-address form-group fg-row col-sm-12 col-md-6">
                            <label class="col-form-label-sm col-sm-2">Building</label>
                            <div class="col-sm-8">
                                <input type="text" name="building" class="form-control-sm form-control-plaintext" readonly>
                            </div>
                        </div>
                        <div class="fg-address form-group fg-row col-sm-12 col-md-6">
                            <label class="col-form-label-sm col-sm-2">Street Address</label>
                            <div class="col-sm-8">
                                <input type="text" name="street" class="form-control-sm form-control-plaintext" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="fg-address form-group fg-row col-sm-12 col-md-6">
                            <label class="col-form-label-sm col-sm-2">City</label>
                            <div class="col-sm-8">
                                <input type="text" name="city" class="form-control-sm form-control-plaintext" readonly>
                            </div>
                        </div>
                        <div class="fg-address form-group fg-row col-sm-12 col-md-6">
                            <label class="col-form-label-sm col-sm-2">Province</label>
                            <div class="col-sm-8">
                                <select type="text" name="province" class="form-control-sm form-control-plaintext" readonly>
                                    <option value="" selected>Select a province</option>
                                    <option value="Eastern Cape">Eastern Cape</option>
                                    <option value="Free State">Free State</option>
                                    <option value="Gauteng">Gauteng</option>
                                    <option value="KwaZulu-Natal">KwaZulu-Natal</option>
                                    <option value="Limpopo">Limpopo</option>
                                    <option value="Mpumalanga">Mpumalanga</option>
                                    <option value="Northern Cape">Northern Cape</option>
                                    <option value="North West">North West</option>
                                    <option value="Western Cape">Western Cape</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="fg-address form-group fg-row col-sm-12 col-md-6">
                            <label class="col-form-label-sm col-sm-2">Postal Code</label>
                            <div class="col-sm-8">
                                <input type="text" name="zip-code" class="form-control-sm form-control-plaintext appearance-s" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>






<div class="row my-5"  style="text-align:start; flex-direction:column;">
    
    
</div>


<script>
    // Wait for the DOM to fully load
    document.addEventListener('DOMContentLoaded', function() {
        // Find the Edit Personal button by its ID
        var editPersonalButton = document.getElementById('edit-personal');
        var savePersonalButton = document.getElementById('btn-personal');
        var cancelPersonalButton = document.getElementById('btn-personal-cancel');

        // Add click event listener to the button
        editPersonalButton.addEventListener('click', function() {
            // Find all input fields within the specified container
            var inputFields = document.querySelectorAll('.fg-personal input');
            var selectFields = document.querySelectorAll('.fg-personal select');

            // Loop through each input field and remove readonly attribute and classes
            inputFields.forEach(function(inputField) {
                inputField.removeAttribute('readonly');
                inputField.classList.remove('form-control-plaintext');
                inputField.classList.add('form-control');
            });
            selectFields.forEach(function(selectField) {
                selectField.removeAttribute('readonly');
                selectField.classList.remove('form-control-plaintext');
                selectField.classList.add('form-control');
            });
            savePersonalButton.style.display = "unset";
            cancelPersonalButton.style.display = "unset";
        });

        
        // Find the Edit Personal button by its ID
        var editPersonalButton = document.getElementById('edit-address');

        // Add click event listener to the button
        editPersonalButton.addEventListener('click', function() {
            // Find all input fields within the specified container
            var inputFields = document.querySelectorAll('.fg-address input');
            var selectFields = document.querySelectorAll('.fg-address select');

            // Loop through each input field and remove readonly attribute and classes
            inputFields.forEach(function(inputField) {
                inputField.removeAttribute('readonly');
                inputField.classList.remove('form-control-plaintext');
                inputField.classList.add('form-control');
            });
            selectFields.forEach(function(selectField) {
                selectField.removeAttribute('readonly');
                selectField.classList.remove('form-control-plaintext');
                selectField.classList.add('form-control');
            });
        });
    });
</script>