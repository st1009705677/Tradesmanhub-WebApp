<?php session_start(); ?>
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
            .nav-pills > .active{
                background-color: #E09F3E !important;
            }
            .details-view {
                position: fixed;
                top: 0;
                right: -50vw; /* Initially off-screen to the right */
                width: 50vw;
                height: 100vh;
                background-color: #fff;
                z-index: 9999;
                transition: right 0.3s ease; /* Transition effect for smooth animation */
            }
            .error-display{
                max-width: 30rem;

                position: absolute;
                right: 5%;
                top: 10%;

                z-index: 999;
            }
            .details-view-show {
                right: 0; /* Bring the details view onto the screen */
            }
            .fg-row{
                flex-direction: row !important;
            }
            .modal-custom{
                position: fixed;
                transform: translate(100%,80%);
                z-index: 1050;
                display: none;
                width: 100%;
                height: unset;
                overflow: hidden;
                outline: 0;
            }

            @media (min-width: 576px){
                .modal-dialog {
                    max-width: 500px;
                    margin: 0;
                }
            }
            .modal-dialog-custom {
                position: relative;
                width: auto;
                margin: 0;
                pointer-events: none;
            }
            nav .dropdown .dropdown-menu {
                top: 90%;
                left: -250%;
            }
        </style>

        <!-- Title -->
        <title><?php echo (!empty($title)) ? $title : 'TradesmanHub'; ?></title>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid justify-content-between">
                    <a class="navbar-brand" href="index.php">
                        <img src="images/Logo.png" alt="" width="252" height="58"/>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            
                            <?php
                                if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="search.php">Search</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="jobs.php">Posts</a>
                                </li>
                            <?php
                                }else{
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="about.php">About</a>
                                </li>
                            <?php
                                }
                            ?>
                        </ul>
                    </div>
                    <?php
                        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
                    ?>
                    <a href="#" class="btn btn-link" style="margin-right: 2rem;" data-toggle="modal" data-target="#questionnaireModal">Become a servprov</a>
                    <div class=" dropdown">
                        <a href="profile.php" class="btn" style="border-radius:50%;" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ri-2x ri-user-line"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="manage-profile.php">Profile</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="log_out.php">Logout</a>
                        </div>
                    </div>
                    <?php
                        }else{
                    ?>
                    <a href="register.php" class="get-started-btn">Get Started</a>
                    <?php
                        }
                    ?>
                </div>
            </nav>
        </header>

