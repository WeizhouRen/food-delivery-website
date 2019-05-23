<main>
    <script type="text/javascript">
        function getScrollY() {
            var y = document.getElementsByID("add-comment-form").scrollTop;
            window.location.href = window.location.href.split('?')[0] + '?page_y=' + page_y;
        }
    </script>
    <!-- *** BACKGROUND *** -->
    <section id="restaurant-page-bg">
        <div class="restaurant-detail">
            <h2 class="detail-info"><?php echo $info["rname"] ?></h2>
            <p class="detail-info details">Phone: <?php echo $info["rphone"] ?></p>
            <p class="detail-info details">Address: <?php echo $info["raddress"] ?></p>
            <label class="detail-info details">Category: <?php echo $info["category"] ?></label>
        </div>
    </section>



    <!-- *** RESTAURANT *** -->
    <?php if (isset($_SESSION["username"])) : ?>
        <!-- *** PICKER AJAX REQUEST*** -->
        <div id="dishes-list">
            <?php foreach ($dishes as $row) : ?>
                <div class="dish">
                    <figure class="dish-cover">
                        <img src="<?php echo $row['photo'] ?>" width="300px" height="200px">
                    </figure>
                    <div class="dish-select">
                        <div class="dish-info">
                            <div class="dish-name"><?php echo $row["name"] ?></div>
                            <div class="dish-price">$<?php echo $row["price"] ?></div>
                        </div>
                        <a href="<?php echo base_url() ?>cart/add?did=<?php echo $row["did"] ?>">
                            <button class="btn">Add to Cart</button>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- *** DISPLAY GOOGLE MAP *** -->
        <div id="map"></div>
        <script>
            var map;
            var position = {
                lat: <?php echo $info["lat"] ?>,
                lng: <?php echo $info["lng"] ?>
            };

            function initMap() {
                map = new google.maps.Map(document.getElementById('map'), {
                    // Brisbane as Center
                    center: {
                        lat: <?php echo $info["lat"] ?>,
                        lng: <?php echo $info["lng"] ?>
                    },
                    zoom: 15
                });
                var marker = new google.maps.Marker({
                    position: position,
                    map: map
                });
            }
        </script>

        <!-- *** COMMENTS *** -->
        <div id= "comments-container" class="container">
            <?php foreach ($comment as $com) : ?>
                <div class="dish-comment">
                    <div class="comment-user">
                        <figure class="small-avatar">
                            <img src="<?php echo $com["avatar"] ?>" width="50px">
                        </figure>
                        <h3><?php echo $com["username"]; ?></h3>
                    </div>

                    <div class="display-rating" data-rating="<?php echo $com['rate'] ?>">
                        <?php
                        $score = $com["rate"];
                        for ($i = 0; $i < 5; $i++) {
                            if ($score >= 1) {
                                echo '<label class="display-star display-full"></label>';
                                echo '<label class="display-star display-base"></label>';
                                $score--;
                            } else {
                                if ($score >= 0.5) {
                                    echo '<label class="display-star display-half"></label>';
                                    echo '<label class="display-star display-base"></label>';
                                    $score -= 0.5;
                                } else if ($score == 0) {
                                    echo '<label class="display-star display-base"></label>';
                                }
                            }
                        }
                        ?>
                    </div>

                    <p class="com-text">"<?php echo $com["text"]; ?>"</p>
                    <p class="com-date">Created <?php echo $com["date"]; ?></p>
                    <hr>
                </div>
            <?php endforeach; ?>
            <form id="add-comment-form" class="add-comment" method="POST" action="<?php echo base_url() . 'dishes/add_comment' ?>">

                <div class="comment-option">
                    <h1>Rate the restaurant</h1>
                    <fieldset class="rating">
                        <input type="radio" id="star5" name="rating" value="5" checked /><label class="full" for="star5" title="Awesome - 5 stars"></label>
                        <input type="radio" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                        <input type="radio" id="star4" name="rating" value="4" /><label class="full" for="star4" title="Pretty good - 4 stars"></label>
                        <input type="radio" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                        <input type="radio" id="star3" name="rating" value="3" /><label class="full" for="star3" title="Meh - 3 stars"></label>
                        <input type="radio" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                        <input type="radio" id="star2" name="rating" value="2" /><label class="full" for="star2" title="Kinda bad - 2 stars"></label>
                        <input type="radio" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                        <input type="radio" id="star1" name="rating" value="1" /><label class="full" for="star1" title="Sucks big time - 1 star"></label>
                        <input type="radio" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                    </fieldset>
                </div>

                <div class="comment-option">
                    <h1>Leave your comment: </h1>
                    <input id="comment" class="comment" name="comment" type="text" required>
                </div>

                <input id="rid" class="rid" name="rid" type="hidden" value="<?php echo $info["rid"]; ?>">
                <button type="submit" class="btn submit-comment" width="100px"> Submit </button>
            </form>
        </div>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDquVJm5txorTXLfWgOQPBSRbRTKPi8EAU&callback=initMap" async defer></script>
    <?php else : ?>
        <p class="text-center">Please sign in first!</p>
    <?php endif ?>
</main>