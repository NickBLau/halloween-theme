<?php

//Menu

register_nav_menus(
    array(
        "primary_menu" => "Primary Menu",
        "footer_menu"  => "Footer Menu"
    )
);

//Styles and scripts

/**
 * Proper way to enqueue scripts and styles.
 */

function wpdocs_theme_name_scripts() {
    wp_enqueue_style( 'style', get_template_directory_uri()."/style.css" );
    wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/script.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );




function return_excerpt_length ($length){
    return 10;
}

add_filter("excerpt_length", "return_excerpt_length", 999);



//THEME SUPPORT
add_theme_support("post-thumbnails");
add_theme_support("custom-logo");




//Widgets

function custom_widgets(){
    register_sidebar(
        array(
            "name"          => "Footer Widgets",
            "id"            => "footer-widget",
            "before_widget" => "<div class='widget>'",
            "after_widget"  => "</div>"
        )
    );
    register_sidebar(
        array(
            "name"          => "Header Widgets",
            "id"            => "header-widget",
            "before_widget" => "<div class='widget>'",
            "after_widget"  => "</div>"
        )
    );
    register_sidebar(
        array(
            "name"          => "My Widget",
            "id"            => "my-widget",
            "before_widget" => "<div class='widget>'",
            "after_widget"  => "</div>"
        )
    );
}

add_action("widgets_init", "custom_widgets");



//Short codes

function greeting(){
    return "Have a spooooooky halloween";
}

add_shortcode("greeting","greeting");

function widget_shortcode(){
    $author = get_the_author();
    $published = get_the_date();
    return "Skrevet af $author - $published";
}
add_shortcode("signature", "widget_shortcode");



function print_products (){
        ob_start();
        $query = new WP_query(
            [
                "post_status"   => "publish",
                "order"         => "DSC",
                "orderby"       => "name",
                "posts_per_page" => "100",
                "post_type"     => "product"
            ]
            );
            while ($query->have_posts()){
                $query->the_post();

                $price = get_post_meta(get_the_id(), "pris", true);
                $stock = get_post_meta(get_the_id(), "lager", true);

                ?>
                <a href="<?php echo get_the_permalink() ?>">
                    <h2><?php the_title() ?></h2>
                    <?php the_post_thumbnail('thumbnail');
                    if ($price == "" || $stock == ""){
                        echo "<p>Ring for pris og lagerstatus</p>";
                    }
                    else{
                        ?>
                        <p class="meta-price">Pris: <?php echo $price ?> kr.</p>
                        <p class="meta-stock">Lagerstatus: <?php echo $stock ?></p>
                    <?php
                    }
                ?>
                </a>

                <?php
            }
            return ob_get_clean();
}

add_shortcode("shop", "print_products");

//Custom Postypes
//Products


function product_post_type () {
    register_post_type(
        "product",
        [
            "show_in_rest"  => true,
             "labels"       => [
                "name"          =>"Produkter", 
                "singular_name" =>"Produkt",
                "add_new"       => "Tilføj nyt produkt"
             ],
             "public"               => true,
             "exclude_from_search" => true,
             "has_archive"         => true,
             "rewrite"             => false,
             "supports"            => [
                "title",
                "editor",
                "thumbnail",
                "custom-fields"
             ]
        ]
    );
}

add_action("init", "product_post_type");