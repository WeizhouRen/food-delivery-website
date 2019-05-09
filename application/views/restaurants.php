<main>
    <!-- *** RESTAURANT *** -->
    <?php if (isset($_SESSION["username"])) : ?>
    <!-- *** PICKER AJAX REQUEST*** -->
    <div id="select-category">
        
        <form action=""> 
            <h2 id="category-title">CATEGORIES</h2>
            <select id="picker" name="restaurant" onchange="showRestaurant(this.value)">
                <option value="">All Restaurants</option>
                <option value="Fast Food">Fast Food</option>
                <option value="Healthy ">Healthy</option>
                <option value="Chinese">Chinese</option>
            </select>
        </form>
        <!-- <div id="txtHint"></div> -->
        <section id="restaurant-list">
            <?php 
            foreach ($restaurant as $row) : ?>
                <div class="restaurant">
                    <figure class="restaurant-cover">
                        <img src="<?php echo $row["rcover"]?>" width="300px" height="200px">
                    </figure>
                    
                    <a class="restaurant-name" <?php echo 'href="'.base_url().'dishes/index?rid='.$row["rid"].'"' ?>><?php echo $row["rname"]?></a>
                    <div class="restaurant-keywords"><?php echo $row["suburb"]?></div>
                    
                </div>
            <?php endforeach;?>
        </section>
    </div>
    <?php else : ?>
    <p class="text-center">Please sign in first!</p>
    <?php endif ?>
</main>