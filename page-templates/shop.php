<?php
/* Template Name: Shop */
?>
<!DOCTYPE html>
<html lang="<?php bloginfo("language");?>"> 
    <!-- dynamisk -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        bloginfo();
        ?>
    </title>
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri()?>">

</head>
<body>
    <!-- Header -->
    <?php
    get_template_part("parts/header");
    ?>
    
    <!-- INDHOLD -->
    <main class="main">
        <?php
            if ( have_posts() ) {
                //Main loop
                while ( have_posts() ) {
                    the_post();
                    the_title("<h1 class='heading'>", "</h1>");
                    ?>

                    <div class="shop">
                        <?php
                        the_content();
                        ?>
                    </div>
                    <?php
                }

            }
            else{
                echo "404 ingenting fundet";
            }
        ?>
    </main>
    
    <!-- Footer -->
    <?php
    get_template_part("parts/footer");
    ?>
</body>
</html>