<?php
    wp_head();
    if (is_user_logged_in()) {
        ?>
        
        <?php
    }
?>
 <div class="heading">
        <?php
        wp_nav_menu(
            array(
                "menu"            => "Primary Menu",
                "container"       => "nav",
                "container_class" => "main-nav"
            )
        );

        echo get_search_form(); 
        ?>
    </div>
<header class="header">
    <?php the_custom_logo(); ?>
<div class="slogan">
    <?php dynamic_sidebar("header-widget"); ?>
    </div>
   
</header>
