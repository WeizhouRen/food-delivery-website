<main id="dashoboard-container">
    <?php if (isset($_SESSION["username"])) : ?>
        <div id="dashboard-username">
            <h1><?php echo 'Welcome ' . $_SESSION["username"] ?></h1>';
        </div>
        <div id="dashboard-userinfo">

            <div id="dashboard-nav" class="dashboard-column">
                <figure>
                    <img src="<?php echo $avatar; ?>" width="400px height=400px">
                </figure>
            </div>

            <div id="dashboard-content" class="dashboard-column">
                <div id="dashboard-rname" class="dashboard-info-component">
                    <label class="dashboard-info">
                        <p>Restaurant Name</p>
                    </label>
                    <label class="dashboard-content"><?php echo $rname; ?></label>
                </div>

                <div id="dashboard-email" class="dashboard-info-component">
                    <label class="dashboard-info">
                        <p>Email</p>
                    </label>
                    <label class="dashboard-content"><?php echo $email; ?></label>
                </div>
                
                <div id="dashboard-phone" class="dashboard-info-component">
                    <label class="dashboard-info">
                        <p>Phone</p>
                    </label>
                    <label class="dashboard-content"><?php echo $phone; ?></label>
                </div>

                <div id="dashboard-address" class="dashboard-info-component">
                    <label class="dashboard-info">
                        <p>Address</p>
                    </label>
                    <label class="dashboard-content"><?php echo $address; ?></label>
                </div>
                <button class="btn" onclick="openUpdateForm()">Update</button>
            </div>
        </div>

        <div class="popup-form" id="update-form">
            <form ng-app action="<?php echo base_url() . 'dashboard/update' ?>" method="POST" class="form-container" id="update-form-container" name="update" enctype="multipart/form-data">
                <div id="signup-left" class="signup-div">
                    <h1>Update My Information</h1>
                    <div>
                        <label><b>Change Avatar</b></label>
                        <figure class="preview-avatar">
                            <img class="preview-avatar-image" width="150px" src="<?php echo $avatar; ?>">
                        </figure>
                        <input type="file" name="avatar" id="update-avatar">
                    </div>

                    <label for="username"><b>Username *</b></label>
                    <input id="update-username" type="text" name="fake" value="<?php echo $username ?>" disabled>
                    <input type="hidden" name="username" value="<?php echo $username ?>">

                    <label for="email"><b>Email</b></label>
                    <input id="update-email" type="email" name="email" value="<?php echo $email ?>" ng-model="user.email" ng-required="true">
                </div>

                <div id="signup-right" class="signup-div">

                    <label for="psw"><b>Password *</b></label>
                    <input type="password" name="psw" value="<?php echo $password ?>" ng-required="true" ng-model="user.password" ng-minlength="8" required>

                    <label for="phone"><b>Phone Number *</b></label>
                    <input type="number" name="phone" value="<?php echo $phone ?>" ng-required="true" ng-model="user.phone" ng-minlength="10" required>

                    <label for="address"><b>Address *</b></label>
                    <input type="text" value="<?php echo $address ?>" name="address" ng-required="true" ng-model="user.address">

                    <button type="submit" class="btn" ng-disabled="update.$invalid">Update</button>
                    <button type="button" class="btn" onclick="closeUpdateForm()">Close</button>
                </div>
            </form>
        </div>
    <?php else : ?>
        <p class="text-center">Please sign in first!</p>
    <?php endif ?>
</main>