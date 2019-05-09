<main>
    <?php if (isset($_SESSION["username"])) : ?>
        <section id="cart-container">
            <div id="cart-content">
                <div id="cart-column-1" class="order-list">
                    <div id="cart-username">
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
                <form id="cart-column-2" class="checkout-form">
                    <h2>Your Order Form</h2>
                    <div id="total-price">
                        <section class="checkout-ele">
                            <h3>Delivery Address:</h3>
                            <input class="checkout-info" name="address" value="<?php echo $user['address']; ?>" type="text">
                        </section>
                        <section class="checkout-ele">
                            <h3>Phone:</h3>
                            <input class="checkout-info" name="address" value="<?php echo $user['phone']; ?>" type="number">
                        </section>
                        <section class="checkout-ele">
                            <p id="total">TOTAL: $<?php echo $total; ?></p>
                        </section>
                    </div>
                    <!-- <button class="btn">CHECK OUT</button> -->
                </form>

            </div>
        </section>
    <?php else : ?>
    <p class="text-center">Please sign in first!</p>
    <?php endif ?>
</main>