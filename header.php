<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="header-main">
        <!-- Logo -->
        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <img src="<?php echo esc_url(SOLTEK_URI . '/assets/images/logo.png'); ?>" alt="<?php bloginfo('name'); ?>">
            <?php endif; ?>
            <span><?php bloginfo('name'); ?></span>
        </a>

        <!-- Desktop Navigation -->
        <nav class="main-nav">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container'      => false,
                'items_wrap'     => '%3$s',
                'fallback_cb'    => 'soltek_fallback_menu',
            ));
            ?>
        </nav>

        <!-- Header Actions -->
        <div class="header-actions">
            <!-- Search -->
            <button type="button" id="search-toggle" aria-label="<?php esc_attr_e('Cerca', 'soltek'); ?>">
                <i data-lucide="search"></i>
            </button>

            <!-- Cart (WooCommerce) -->
            <?php if (function_exists('WC')) : ?>
                <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="cart-link" style="position: relative;">
                    <i data-lucide="shopping-cart"></i>
                    <?php if (WC()->cart->get_cart_contents_count() > 0) : ?>
                        <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                    <?php endif; ?>
                </a>
            <?php endif; ?>

            <!-- Account -->
            <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>" class="hidden sm:block" style="display: flex; align-items: center; gap: 0.25rem; padding: 0.5rem 1rem; background: #f3f4f6; border-radius: 9999px; font-size: 0.875rem; font-weight: 500; color: #374151;">
                <i data-lucide="user" style="width: 18px; height: 18px;"></i>
                <span><?php echo is_user_logged_in() ? __('Account', 'soltek') : __('Login', 'soltek'); ?></span>
            </a>

            <!-- CTA Button -->
            <a href="<?php echo esc_url(home_url('/prenota')); ?>" class="btn btn-primary hidden md:block" style="display: none;">
                <?php _e('Prenota Consulenza', 'soltek'); ?>
            </a>
            <a href="<?php echo esc_url(home_url('/prenota')); ?>" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.875rem;">
                <?php _e('Prenota Consulenza', 'soltek'); ?>
            </a>

            <!-- Mobile Menu Toggle -->
            <button type="button" class="mobile-menu-toggle" id="mobile-menu-toggle" aria-label="<?php esc_attr_e('Menu', 'soltek'); ?>">
                <i data-lucide="menu" id="menu-icon-open"></i>
                <i data-lucide="x" id="menu-icon-close" style="display: none;"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <nav class="mobile-menu" id="mobile-menu">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'primary',
            'container'      => false,
            'items_wrap'     => '%3$s',
            'fallback_cb'    => 'soltek_fallback_menu',
        ));
        ?>
        <a href="<?php echo esc_url(home_url('/prenota')); ?>" class="btn btn-primary" style="text-align: center;">
            <?php _e('Prenota Consulenza', 'soltek'); ?>
        </a>
    </nav>
</header>

<?php
/**
 * Fallback menu if no menu is set
 */
function soltek_fallback_menu() {
    ?>
    <a href="<?php echo esc_url(home_url('/')); ?>" class="<?php echo is_front_page() ? 'current' : ''; ?>">Home</a>
    <a href="<?php echo esc_url(home_url('/negozio')); ?>" class="<?php echo is_shop() ? 'current' : ''; ?>">Negozio</a>
    <a href="<?php echo esc_url(home_url('/servizi')); ?>">Servizi</a>
    <a href="<?php echo esc_url(home_url('/corsi')); ?>">Corsi</a>
    <a href="<?php echo esc_url(home_url('/chi-siamo')); ?>">Chi Siamo</a>
    <a href="<?php echo esc_url(home_url('/contatti')); ?>">Contatti</a>
    <?php
}
?>

<main id="main-content">
