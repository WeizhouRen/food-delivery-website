<main>
    <?php if (isset($_SESSION["username"])) : ?>
        <section id="cart-container">
            <div id="cart-content">
                <div id="cart-column-1" class="order-list">
                    <div class="cart-username">
                        <?php
                        $my_cart = $_SESSION["username"] . "'s Cart";
                        echo '<h1>' . $my_cart . '</h1>';
                        ?>
                    </div>
                    <?php
                    if ($dishes != NULL) :
                        foreach ($dishes as $dish) :
                            ?>
                            <hr>
                            <div class="dish-block">
                                <figure class="dish-pic">
                                    <img src="<?php echo $dish["photo"] ?>">
                                </figure>
                                <div class="dish-info">
                                    <p class="dish-info-name"><?php echo $dish["name"] ?></p>
                                    <p class="dish-info-price">$<?php echo $dish["price"] ?></p>
                                    <form class="update-block" action="<?php echo base_url() . "cart/remove" ?>" method="POST">
                                        <div class="qty">
                                            <p>QTY: </p>
                                            <input type="number" name="qty" value="1" class="qty-input" width="20px" height="20px">
                                            <input type="hidden" name="did" value="<?php echo $dish["did"] ?>">
                                        </div>
                                        <button type="submit" class="remove-btn">Remove</button>
                                    </form>
                                </div>
                            </div>
                            

                        <?php
                    endforeach;
                else :
                    echo '<a href="' . base_url() . 'restaurants/index' . '" class="text-center">No dishes added!</a>';
                endif;
                ?>
                </div>
                <form id="cart-column-2" class="checkout-form" method="POST" action="<?php echo base_url()?>cart/checkout">
                    <h2>Your Order Form</h2>
                    <div id="total-price">
                        <section class="checkout-ele">
                            <h3>Delivery Address:</h3>
                            <input class="checkout-info" name="address" value="<?php echo $user['address']; ?>" type="text" <?php if ($hasConfirmed || $dishes == null): echo 'disabled'; endif;?>>
                        </section>
                        <section class="checkout-ele">
                            <h3>Phone:</h3>
                            <input class="checkout-info" name="phone" value="<?php echo $user['phone']; ?>" type="number" <?php if ($hasConfirmed || $dishes == null): echo 'disabled'; endif;?>>
                        </section>
                        <section class="checkout-ele">
                            <p id="total">TOTAL: $<?php echo $total; ?></p>
                        </section>
                    </div>
                    <!-- <button class="btn" type="submit" onclick="showSummary()" <?php if ($dishes == null): echo 'disabled'; endif;?>>CONFIRM</button> -->
                    <input type="submit" class="btn" name="confirm-btn" value="CONFIRM" <?php if ($hasConfirmed || $dishes == null): echo 'disabled'; endif;?>>
                </form>

            </div>
        </section>


        <?php if (isset($_POST["confirm-btn"])):?>
        <section id="checkout-form">
            <h1>Summary</h2>
            <p>Order Number: <?php echo $ordernumber?></p>
            <p>Username: <?php echo $_SESSION["username"]?></p>
            <p>Mobile: <?php echo $orderphone?></p>
            <p>Address: <?php echo $orderaddress?></p>
            <hr>
            <?php foreach ($ordered_dishes as $od) :?>
                <div class="od">
                    <label>Dish Name: <?php echo $od["name"]?></label><br>
                    <label>Dish Price: <?php echo $od["price"]?></label><br>
                </div>
            <?php endforeach;?>
        </section>
        <?php endif;?>
    <?php else : ?>
    <p class="text-center">Please sign in first!</p>
    <?php endif ?>
</main>