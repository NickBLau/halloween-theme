<?php
get_template_part("parts/head");
?>
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
                    <div class="content">
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