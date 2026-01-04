<?php
/**
 * WooCommerce Main Template
 *
 * @package Soltek
 */

get_header();
?>

<div class="container" style="padding: 4rem 1rem;">
    <?php woocommerce_content(); ?>
</div>

<?php
get_footer();
