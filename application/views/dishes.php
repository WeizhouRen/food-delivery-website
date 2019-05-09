<main>
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
        <div class="container">
        <?php foreach ($comment as $com): ?>
            <div class="dish-comment">
                <h3><?php echo $com["username"]; ?></h3>
                <p class="com-text">"<?php echo $com["text"];?>"</p>
                <p class="com-date"><?php echo $com["date"];?></p>
                <hr>
            </div>
        <?php endforeach; ?>       
            <form class="add-comment" method="POST" action="<?php echo base_url().'dishes/add_comment'?>">
                <div class="comment-option">
                    <label>Write down your comment: </label>
                    <input id="comment" class="comment" name="comment" type="text" require>
                </div>
                

                <div class="comment-option">
                    <label>Rate the restaurant</label>
                    <select name="rate" id="rate" class="rate">
                        <option value="5">5</option>
                        <option value="4">4</option>
                        <option value="3">3</option>
                        <option value="2">2</option>
                        <option value="1">1</option>
                    </select>
                </div>
                
                <input id="rid" class="rid" name="rid" type="hidden" value="<?php echo $info["rid"];?>">
                <button type="submit" class="btn" width="100px"> Submit </button>
            </form>
        </div>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDquVJm5txorTXLfWgOQPBSRbRTKPi8EAU&callback=initMap" async defer></script>
    <?php else : ?>
        <p class="text-center">Please sign in first!</p>
    <?php endif ?>
</main>