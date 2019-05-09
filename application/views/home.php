    <main>
        <!-- *** BACKGROUND *** -->
        <section id="fixed-background">
            <div id="order-now">
                <label>To Discover Your Food</label>
            </div>
        </section>
        <!-- *** RECOMMONDATION *** -->
        <section id="recommondation">
            <div id="recom-title">
                <h2>Dont't Know What to Eat?</h2>
            </div>
            <div id="newest-restaurant" class="recom-container">
                <figure id="newest-pic" data-scroll-class="visible fadeInLeft" class="hidden animated recom-pic">
                    <img src="<?php echo base_url(); ?>img/recom1.jpg">
                </figure>
                <article id="newest-description" class="hidden animated recom-desc" data-scroll-class="visible fadeInRight">
                    <h2 class="recom-dishes-title">New Restaurant</h2>
                    <p>I'm Dana! I cook simple, delicious recipes with three easy rules: I use only 1 bowl, up to 10 ingredients, and take just 30 minutes or less to prepare. Bon Appetit!</p>
                </article>
            </div>

            <div id="popular-restaurant" class="recom-container">
                <article id="popular-description" data-scroll-class="visible fadeInLeft" class="hidden animated recom-desc">
                    <h2 class="recom-dishes-title">The Most Popular Restaurant: <?php echo $popular["rname"]?></h2>
                    <p>THIS is selected by calculating the average rate from all users! Only the restaurant who has the first top score can be dsiplayed in the homepage!</p>
                </article>
                <figure id="popular-pic" data-scroll-class="visible fadeInRight" class="hidden animated recom-pic">
                    <a href="<?php echo base_url() . 'dishes/index?rid=' . $popular['rid']?>">
                        <img src="<?php echo $popular["rcover"]?>">
                        <p class="popular-info">CURRENT RATE: <?php echo $popular["rate"]?></p>
                    </a>
                </figure>

            </div>
        </section>
    </main>