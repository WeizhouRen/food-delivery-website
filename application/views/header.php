<?php
error_reporting(-1);
ini_set('display_errors', 'On');
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <title>Let's EAT</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/animate.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="">
    <!-- *** SCRIPTS TO INCLUDE ***-->
    <script src="<?php echo base_url(); ?>js/angular/angular.min.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url(); ?>js/scrollClass.js"></script>
    <script src="<?php echo base_url(); ?>js/javascript.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <!-- *** HEADER AND LOGIN *** -->
    <header>
        <div id="register-label">
            <div id="register-container">
                <?php
                if (isset($_SESSION["username"])) {
                    echo '<label id="welcom-message"><a href="' . base_url() . 'profile/index">Hi! ' . $_SESSION["username"] . '</a></label>';
                    echo '<ul class="dropdown-menu">';
                    echo '<li><a class="dropdown-list" href="' . base_url() . 'profile/index">My Profile</a></li>';
                    echo '<li><a class="dropdown-list" href="' . base_url() . 'cart/index">My Cart</a></li>';
                    echo '<li><a class="dropdown-list" href="' . base_url() . 'users/logout">Log out</a></li>';
                    echo '</ul>';
                } else {
                    echo '<div class="labels">';
                    echo '<label id="login" onclick="openLoginForm()"><p>Log in</p></label>';
                    echo '<label id="signup" onclick="openSignupForm()"><p>Sign up</p></label>';
                    echo '</div>';
                }
                ?>
            </div>
            <form id="search-container" action="">
                <input type="text" name="search" id="search" placeholder="Search you the restaurant you want..." onkeyup="showResult(this.value)"/>
                <!-- <button type="submit"><i class="fa fa-search"></i></button> -->
                <div id="livesearch"></div>
            </form>
        </div>
        <div class="popup-form" id="login-form">
            <form class="form-container" id="login-form-container" name="login" action="<?php echo base_url(); ?>users/login" method="POST">
                <h1>Login</h1>

                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Enter username" name="username" required value="<?php if (isset($_COOKIE["username"])) : echo $_COOKIE["username"];
                                                                                                endif ?>">

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" required>
                <div id="remember">
                    <input type="checkbox" name="remember" <?php if (isset($_COOKIE["username"])) : echo "checked";
                                                            endif ?>>
                    <p>Remember me</p>
                </div>

                <button type="submit" class="btn">Login</button>
                <button class="btn" onclick="closeLoginForm()">Close</button>
            </form>
        </div>
        <div class="popup-form" id="signup-form">
            
            <form ng-app action="<?php echo base_url(); ?>users/signup" method="POST" class="form-container" id="signup-form-container" name="signup" novalidate enctype="multipart/form-data">
                
                <div id="signup-left" class="signup-div">
                    <h1>Create a New Account</h1>
                    <div>
                        <label><b>Upload Avatar</b></label>
                        <figure class="preview-avatar">
                            <img id="preview" class="preview-avatar-image" width="150px" height="150px">
                        </figure>
                        <input type="file" name="avatar" id="avatar" onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])">

                    </div>

                    <label for="username"><b>Username *</b></label>
                    <input id="username" type="text" name="username" placeholder="Enter username" ng-model="user.username" ng-required="true" onBlur="checkUsernameAvailability()">
                    <div id="user-availability-status"></div>
                    <p class="form-error" ng-show="signup.username.$invalid && signup.username.$touched">Please enter your username</p>


                    <label for="email"><b>Email</b></label>
                    <input id="email" type="email" name="email" placeholder="Enter email" ng-model="user.email" ng-required="true" onBlur="checkEmailAvailability()">
                    <div id="email-availability-status"></div>
                    <p class="form-error" ng-show="signup.email.$invalid && signup.email.$touched">Please enter valid email</p>
                </div>

                <div id="signup-right" class="signup-div">
                    <label for="identity"><b>Select Identity</b></label>
                    <div id="identity-radio-container">
                        <div class="signup-radio">
                            <input type="radio" id="customer" name="identity" value="customer">
                            <label for="customer">Customer</label>
                        </div>
                        <div class="signup-radio">
                            <input type="radio" id="staff" name="identity" value="staff">
                            <label for="staff">Staff</label>
                        </div>
                    </div>


                    <label for="psw"><b>Password *</b></label>
                    <input type="password" name="psw" placeholder="Enter Password" ng-required="true" ng-model="user.password" ng-minlength="8" required>
                    <p class="form-error" ng-show="signup.psw.$invalid && signup.psw.$touched">
                        Password must have at least 8 digts.</p>

                    <label for="phone"><b>Phone Number *</b></label>
                    <input type="number" name="phone" placeholder="Enter Phone Number" ng-required="true" ng-model="user.phone" ng-minlength="10" required>
                    <p class="form-error" ng-show="signup.phone.$invalid && signup.phone.$touched">
                        Please enter the 10-digit phone number starting with 0</p>

                    <label for="address"><b>Address *</b></label>
                    <input type="text" placeholder="Enter Address" name="address" ng-required="true" ng-model="user.address" required>
                    <p class="form-error" ng-show="signup.address.$invalid && signup.address.$touched">
                        Please input your address.</p>
                    <div class="g-recaptcha" data-sitekey="6Lc44aMUAAAAAECVNd6g325osPqN_TzBb_fll6RT" style="margin: auto"></div>
                    <button type="submit" class="btn" ng-disabled="signup.$invalid">Signup</button>
                    <button type="button" class="btn" onclick="closeSignupForm()">Close</button>
                </div>
            </form>
        </div>
        <div id="title">
            <h1>Let's Eat</h1>
        </div>
    </header>
    <hr id="hr-head" size="0.8px">
    <!-- *** NAVBAR *** -->
    <nav id="nav-container">
        <ul id="nav">
            <li>
                <a href="<?php echo base_url() . 'home/' ?>">Home</a>
            </li>
            <li>
                <a href="<?php echo base_url() . 'restaurants/' ?>">Restaurants</a>
            </li>
            <li>
                <a href="<?php echo base_url() . 'cart/'?>">Order Online</a>
            </li>
            <!-- <li>
                <a>Contact Us</a>
            </li> -->
        </ul>
    </nav>