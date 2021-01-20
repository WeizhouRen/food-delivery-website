    <main id="profile-container">
        <?php if (isset($_SESSION["username"])) : ?>
            <div id="profile-username">
                <h1><?php echo 'Welcome ' . $info["identity"] . ' ' . $_SESSION["username"] ?></h1>';
            </div>
            <div id="profile-userinfo">

                <div id="profile-column1">
                    <figure>
                        <img src="<?php echo $info['avatar']; ?>" width="400px height=400px">
                    </figure>
                </div>

                <div id="profile-column2">
                    <div id="profile-username" class="profile-info-component">
                        <label class="profile-info">
                            <p>Username</p>
                        </label>
                        <label class="profile-content"><?php echo $info["username"]; ?></label>

                    </div>
                    <div id="profile-email" class="profile-info-component">
                        <label class="profile-info">
                            <p>Email</p>
                        </label>
                        <label class="profile-content"><?php echo $info["email"]; ?></label>
                    </div>
                    <div id="profile-phone" class="profile-info-component">
                        <label class="profile-info">
                            <p>Phone</p>
                        </label>
                        <label class="profile-content"><?php echo $info["phone"]; ?></label>
                    </div>

                    <div id="profile-address" class="profile-info-component">
                        <label class="profile-info">
                            <p>Address</p>
                        </label>
                        <label class="profile-content"><?php echo $info["address"]; ?></label>
                    </div>
                    <button class="btn" onclick="openUpdateForm()">Update</button>
                </div>
            </div>

            <div class="popup-form" id="update-form">
                <form ng-app action="<?php echo base_url() . 'profile/update' ?>" method="POST" class="form-container" id="update-form-container" name="update" enctype="multipart/form-data">
                    <div id="signup-left" class="signup-div">
                        <h1>Update My Information</h1>
                        <div>
                            <label><b>Change Avatar</b></label>
                            <figure class="preview-avatar">
                                <img id="update-preview" class="preview-avatar-image" width="150px" src="<?php echo $info['avatar']; ?>">
                            </figure>
                            <input type="file" name="update-avatar" id="update-avatar" onchange="document.getElementById('update-preview').src = window.URL.createObjectURL(this.files[0])">
                        </div>

                        <label for="username"><b>Username *</b></label>
                        <input id="update-username" type="text" name="fake" value="<?php echo $info['username'] ?>" disabled>
                        <input type="hidden" name="username" value="<?php echo $info['username'] ?>">

                        <label for="email"><b>Email</b></label>
                        <input id="update-email" type="email" name="email" value="<?php echo $info['email'] ?>" ng-model="user.email" ng-required="true">
                    </div>

                    <div id="signup-right" class="signup-div">

                        <label for="psw"><b>Password *</b></label>
                        <input type="password" name="psw" value="<?php echo $info['password'] ?>" ng-required="true" ng-model="user.password" ng-minlength="8" required>

                        <label for="phone"><b>Phone Number *</b></label>
                        <input type="number" name="phone" value="<?php echo $info['phone'] ?>" ng-required="true" ng-model="user.phone" ng-minlength="10" required>

                        <label for="address"><b>Address *</b></label>
                        <input type="text" value="<?php echo $info['address'] ?>" name="address" ng-required="true" ng-model="user.address">

                        <button type="submit" class="btn" ng-disabled="update.$invalid">Update</button>
                        <button type="button" class="btn" onclick="closeUpdateForm()">Close</button>
                    </div>
                </form>
            </div>

            <?php if ($info['identity'] == 'staff') : ?>
                <div id="profile-table">
                    <h2><?php echo $rname; ?></h2>

                    <form id="add-dish" action="<?php echo base_url() . 'dishes/add' ?>" method="POST" enctype="multipart/form-data">
                        <div id="add-c1">
                            <input type="hidden" value="<?php echo $rid ?>" name="rid" />
                            <input type="hidden" value="<?php echo $rname ?>" name="rname" />
                            <div class="add-ele">
                                <label>Dish Name</label>
                                <input class="profile-dish" type="text" name="dish-name" required />
                            </div>
                            <div class="add-ele">
                                <label>Price</label>
                                <input class="profile-dish" type="number" step="0.01" name="dish-price" required />
                            </div>
                            <div class="add-ele">
                                <label>Upload dish photo</label>
                                <input class="profile-dish" type="file" name="photo" required>
                            </div>
                        </div>
                        <div class="add-ele">
                            <label>Description</label>
                            <input class="profile-dish" type="text" name="dish-desc" required />
                        </div>
                        <button type="submit" class="btn dish-btn">Add</button>
                    </form>


                    <table id="dishes-table">
                        <tr>
                            <th>Dish Name</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Operations</th>
                        </tr>
                        <?php foreach ($dishes as $dish) : ?>
                            <form action="<?php echo base_url() . 'dishes/update' ?>" method="POST">
                                <input type="hidden" name="dish-id" value="<?php echo $dish['did']?>">
                                <tr class="profile-dish-info">
                                    <td>
                                        <input class="profile-dish" value='<?php echo $dish["name"] ?>' type="text" name="dish-name" />
                                    </td>
                                    <td>
                                        <input class="profile-dish" value='$<?php echo $dish["price"] ?>' type="text" name="dish-price" />
                                    </td>
                                    <td>
                                        <input class="profile-dish" value='<?php echo $dish["description"] ?>' type="text" name="dish-desc" />
                                    </td>
                                    <td class="operation-buttons">
                                        <button type="submit" class="btn dish-btn update-btn">UPDATE</button>
                                        <a class="btn dish-btn delete-btn" href="<?php echo base_url()?>dishes/delete?did=<?php echo $dish["did"]?>">Delete</a>
                                    </td>
                                </tr>
                            <form>
                        <?php endforeach; ?>
                    </table>
                </div>

            <?php endif; ?>
        <?php else : ?>
            <p class="text-center">Please sign in first!</p>
        <?php endif ?>
    </main>