<?php
/**
 * The template for displaying the footer
 */
?>
        </div>
    </div>
<?php

    bubulla_the_before_footer();
    
?>
    <div class="ltx-footer-wrapper">
<?php

    bubulla_the_footer_overlay();

    /**
     * Before Footer area
     */
    bubulla_the_subscribe_block();

    /**
     * Footer widgets area
     */
    bubulla_the_footer_widgets();

    /**
     * Copyright
     */
    bubulla_the_copyrights_section();
?>
    </div>
<?php 

    bubulla_the_go_top();

    /**
     * WordPress Core Function
     */   
    wp_footer();
?>
</body>
</html>
