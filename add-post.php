<?php
    session_start();

    if(!isset($_SESSION['logged_in'])){
        if(!isset($_SESSION['logged_in'])){
            header('location: login.php');
            die();
        }
    }

    require_once '../models/DataModel.php';
    require_once '../models/Requests.php';
    require_once '../utils/validate.php';

    $errors = $result = $provider = $service = $date = $budget = $house = $street = $city = $city = $zip = $description = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $validate = new InputValidator();
        if(isset($_POST['post-job'])){
            if(isset($_SESSION['provider'])){
                // Validate provider
                $provider = $validate->clean($_POST['provider']);
                $validate->validateNotEmpty("Service provider", $provider);
                $validate->validateLettersOnly("Service provider", $provider);
            }
            // Validate service
            $service = $validate->clean($_POST['service']);
            $validate->validateNotEmpty("Service", $service);
            $validate->validateLettersOnly("Service", $service);
            // Validate date 
            $date = $validate->clean($_POST['start_date']);
            $validate->validateNotEmpty("Start date", $date);
            $validate->validateDateNotBeforeCurrentDate("Start date", $date);
            // Validate budget
            $budget = $validate->clean($_POST['budget_amount']);
            $validate->validateNotEmpty("Budget amount", $budget);
            $validate->validateNumeric("Budget amount", $budget);
            // Validate house no
            $house = $validate->clean($_POST['house_no']);
            $validate->validateNotEmpty("House number",$house);
            $validate->validateAlphanumeric("House number", $house);
            // Validate street address
            $street = $validate->clean($_POST['street']);
            $validate->validateNotEmpty("Street address", $street);
            $validate->validateAlphanumeric("Street address", $street);
            // Validate city
            $city = $validate->clean($_POST['city']);
            $validate->validateNotEmpty("City", $city);
            $validate->validateLettersOnly("City", $city);
            // Validate province
            $province = $validate->clean($_POST['province']);
            $validate->validateNotEmpty("Province", $province);
            $validate->validateLettersOnly("province", $province);
            // Validate zip
            $zip = $validate->clean($_POST['zip']);
            $validate->validateNotEmpty("Postal code", $zip);
            $validate->validateNumeric("Postal code", $zip);
            // Validate description
            $description = $validate->clean($_POST['description']);
            $validate->validateNotEmpty("Description", $description);
            $errors = $validate->getErrors();
            
            // Check if there are any erros
            if(empty($errors)){
                // Structure the data
                $uid = $_SESSION['logged_in_user'];
                $address = "$house, $street, $city, $province, $zip";
                // Add record to the database
                $request = (new RequestManager)
                    ->postJob($uid, $service, $date, "R $budget", $address, $description);

                if($request){
                    $result = "Your post has been saved";
                    $errors = $provider = $service = $date = $budget = $house = $street = $city = $city = $zip = $description = "";
                    echo '<script>var result = '.json_encode($result).';</script>';
                }else{
                    $result = "Something went wrong, please try again";
                }
            }
            
        }
    }

?>

<!doctype html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- Remix icons -->
        <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

        <!-- CSS imports -->
        <link href="css/style.css" rel="stylesheet" type="text/css">
        <link href="css/bootstrap-4.4.1.css" rel="stylesheet" type="text/css">

        <!-- Javascript imports -->
        <script src="js/jquery-3.4.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap-4.4.1.js"></script>

        <style>
            .form-group{
                width: 100%;
            }
            .btn-sm{
                font-size: small !important;
                padding: .2rem .5rem !important;
            }
            .btn-search:hover{
                background-color: rgba(158, 42, 43, 0.5) !important;
            }
            .row{
                height: 100vh;
                align-items: center;
                justify-content: center;
            }
            body{
                text-align: start;
            }
            @media (max-width: 425px) {
                .display-4{
                    font-size: 28px;
                }
            }
            .error-display{
                max-width: 30rem;

                position: absolute;
                right: 5%;
                top: 5%;

                z-index: 999;
            }
        </style>
    </head>
    <body>
        
        <?php
            if(!empty($errors)){
        ?>
        <div class="error-display">
            <?php
            foreach($errors as $error){
            ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?php echo $error; ?>   
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php
            }
            ?>
        </div>

        <?php
        }
        ?>
        <div class="row">
            <div class="new-post-container col-sm-12 col-md-6 col-lg-6">
                <div class="w-100" style="text-align:start;">
                    <a href="#" onclick="history.back()"><i class="ri-arrow-left-s-line"></i>&ensp;Back</a>
                </div>
                <div class="w-100" >
                    <h1 class="display-4 mb-1">Complete your job post</h1>
                </div>
                <?php
                    if(!empty($result)){
                ?>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <?=$result.'. Go back <a href="jobs.php">here</a>'?>   
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php
                    }
                ?>
                <form name="myForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="form-row"> 
                        <?php
                            if(isset($_SESSION['provider'])){
                        ?>          
                        <input type="hidden" value="<?php echo $_SESSION['provider']['id'];?>" name="provider_id" readonly>           
                            <div class="form-group col-sm-12 col-md-6">
                                <label class="form-label col-form-label-sm">Service Provider</label>
                                <input name="provider" value="<?php echo $_SESSION['provider']['name'];?>" type="text" class="form-control form-control-sm" id="" readonly>
                            </div>
                        <?php
                            }
                        ?> 
                        <div class="form-group col-sm-12 col-md-6">
                            <label class="form-label col-form-label-sm">Service</label>
                            <select name="service" class="form-control custom-select-sm">
                                <?php 
                                $categories = (new DataModel)->getKeys("services");
                                echo '<option selected value="">Select a service</option>';

                                foreach($categories as $category){
                                    echo '<option value="'.$category.'">'.$category.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label class="form-label col-form-label-sm">Start By</label>
                            <input name="start_date" type="date" value="<?php echo $date;?>" class="form-control form-control-sm" id="" placeholder="Start by">
                        </div>
                        <div class="form-group col-6">
                            <label class="form-label col-form-label-sm">Budget</label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                <div class="input-group-text">R</div>
                                </div>
                                <input name="budget_amount" type="text" value="<?php echo $budget;?>" class="form-control form-control-sm" id="" placeholder="Budget">
                            </div>
                        </div>
                    </div>
                        <p>Address</p>
                    <div class="form-row">
                        <div class="form-group col-sm-12 col-md-4">
                            <label class="form-label col-form-label-sm">House no.</label>
                            <input type="text" name="house_no" value="<?php echo $house;?>" class="form-control form-control-sm" placeholder="eg. 122">
                        </div>
                        <div class="form-group col-sm-12 col-md-4">
                            <label class="form-label col-form-label-sm">Street Address</label>
                            <input type="text" name="street" value="<?php echo $street;?>" class="form-control form-control-sm" placeholder="eg. Reitz str">
                        </div>
                        <div class="form-group col-sm-12 col-md-4">
                            <label class="form-label col-form-label-sm">City/ Town</label>
                            <input type="text" name="city" value="<?php echo $city;?>" class="form-control form-control-sm" placeholder="eg. Pretoria">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-12 col-md-4">
                            <label class="form-label col-form-label-sm">Province</label>
                            <select type="text" name="province" class="form-control form-control-sm" placeholder="eg. Gauteng">
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
                        <div class="form-group col-sm-12 col-md-4">
                            <label class="form-label col-form-label-sm">Postal Code</label>
                            <input type="text" name="zip" value="<?php echo $zip;?>" class="form-control form-control-sm" placeholder="eg. 12345">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-12 col-md-12">
                            <label class="form-label col-form-label-sm">Description</label>
                            <textarea name="description" value="<?php echo $description;?>" class="form-control form-control-sm" row="5" placeholder="Descript what you need here..."></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <button type="submit" class="btn btn-sm search-btn col-sm-12 col-md-2 col-lg-2" name="post-job">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>

<script>

</script>