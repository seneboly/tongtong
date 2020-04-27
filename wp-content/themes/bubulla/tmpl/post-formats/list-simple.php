<?php
/**
 * The default template for displaying standard post format
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="ltx-photo">
	<?php

        echo '<a href="'.get_the_permalink().'">';
		  the_post_thumbnail();
        echo '</a>';
		
	?>
    </div>
    <div class="ltx-description">
        <?php

            bubulla_get_the_cats_archive();

            echo '<a href="'.get_the_permalink().'" class="ltx-header">';
                echo '<h6>'.get_the_title().'</h6>';
            echo '</a>';

            the_excerpt();
            
            bubulla_get_the_post_headline();
            
        ?>         
    </div>    
</article>