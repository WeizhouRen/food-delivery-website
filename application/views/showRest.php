<main>
    <div class="restaurant">

        <figure class="restaurant-cover">
            <img src="<?php echo $rest_info['rcover'] ?>" width="300px" height="200px">
        </figure>

        <a class="restaurant-name" href=<?php echo base_url() . 'dishes?rid='.$rest_info["rid"] ?>>
            <?php echo $rest_info['rname'] ?>
        </a>

        <div class="restaurant-keywords"><?php echo $rest_info['suburb'] ?></div>

    </div>
</main>