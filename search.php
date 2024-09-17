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
        <h1 class="cat-title">
            Søgeresultater
        </h1>
        <?php
            if ( have_posts() ) {
                //Main loop
                while ( have_posts() ) {
                    the_post();

                    $link = get_the_permalink();
                    echo "<a href='$link'>";
                        the_title("<h4 class='heading'>", "</h4>");
                        ?>
                        <figure class="thumb">
                            <?php
                            the_post_thumbnail("thumbnail");
                            ?>
                        </figure>
                        <div class="content">
                            <?php
                            the_excerpt();
                            ?>
                        </div>
                    
                        </a>
                        <hr>
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