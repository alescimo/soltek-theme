<?php
/**
 * Soltek Theme Functions
 *
 * @package Soltek
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

define('SOLTEK_VERSION', '1.0.0');
define('SOLTEK_DIR', get_template_directory());
define('SOLTEK_URI', get_template_directory_uri());

/**
 * Fallback menu if no menu is set
 */
function soltek_fallback_menu() {
    $current = '';
    if (is_front_page()) $current = 'home';
    ?>
    <a href="<?php echo esc_url(home_url('/')); ?>" class="<?php echo $current === 'home' ? 'current' : ''; ?>">Home</a>
    <a href="<?php echo esc_url(home_url('/negozio')); ?>">Negozio</a>
    <a href="<?php echo esc_url(home_url('/servizi')); ?>">Servizi</a>
    <a href="<?php echo esc_url(home_url('/corsi')); ?>">Corsi</a>
    <a href="<?php echo esc_url(home_url('/chi-siamo')); ?>">Chi Siamo</a>
    <a href="<?php echo esc_url(home_url('/contatti')); ?>">Contatti</a>
    <?php
}

/**
 * Theme Setup
 */
function soltek_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');

    // Custom logo support
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Register nav menus
    register_nav_menus(array(
        'primary'   => __('Menu Principale', 'soltek'),
        'footer'    => __('Menu Footer', 'soltek'),
    ));

    // HTML5 support
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // WooCommerce support
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    // Responsive embeds
    add_theme_support('responsive-embeds');

    // Editor styles
    add_theme_support('editor-styles');
}
add_action('after_setup_theme', 'soltek_setup');

/**
 * Enqueue scripts and styles
 */
function soltek_scripts() {
    // Google Fonts
    wp_enqueue_style(
        'soltek-fonts',
        'https://fonts.googleapis.com/css2?family=Caveat:wght@400;700&family=Inter:wght@300;400;500;600;700&display=swap',
        array(),
        null
    );

    // Main stylesheet
    wp_enqueue_style(
        'soltek-style',
        get_stylesheet_uri(),
        array(),
        SOLTEK_VERSION
    );

    // Lucide Icons (via CDN)
    wp_enqueue_script(
        'lucide-icons',
        'https://unpkg.com/lucide@latest',
        array(),
        null,
        true
    );

    // Main JS
    wp_enqueue_script(
        'soltek-scripts',
        SOLTEK_URI . '/assets/js/main.js',
        array(),
        SOLTEK_VERSION,
        true
    );

    // Chat Widget
    wp_enqueue_script(
        'soltek-chat',
        SOLTEK_URI . '/assets/js/chat-widget.js',
        array(),
        SOLTEK_VERSION,
        true
    );

    // Pass data to JS
    wp_localize_script('soltek-scripts', 'soltekData', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('soltek_nonce'),
        'homeUrl' => home_url('/'),
    ));
}
add_action('wp_enqueue_scripts', 'soltek_scripts');

/**
 * Register widget areas
 */
function soltek_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'soltek'),
        'id'            => 'sidebar-1',
        'description'   => __('Aggiungi widget qui.', 'soltek'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Footer 1', 'soltek'),
        'id'            => 'footer-1',
        'description'   => __('Prima colonna footer.', 'soltek'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => __('Footer 2', 'soltek'),
        'id'            => 'footer-2',
        'description'   => __('Seconda colonna footer.', 'soltek'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => __('Footer 3', 'soltek'),
        'id'            => 'footer-3',
        'description'   => __('Terza colonna footer.', 'soltek'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'soltek_widgets_init');

/**
 * Custom Post Type: Servizi
 */
function soltek_register_services_cpt() {
    register_post_type('servizio', array(
        'labels' => array(
            'name'               => __('Servizi', 'soltek'),
            'singular_name'      => __('Servizio', 'soltek'),
            'add_new'            => __('Aggiungi Servizio', 'soltek'),
            'add_new_item'       => __('Aggiungi Nuovo Servizio', 'soltek'),
            'edit_item'          => __('Modifica Servizio', 'soltek'),
            'view_item'          => __('Visualizza Servizio', 'soltek'),
            'all_items'          => __('Tutti i Servizi', 'soltek'),
        ),
        'public'       => true,
        'has_archive'  => true,
        'rewrite'      => array('slug' => 'servizi'),
        'supports'     => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'menu_icon'    => 'dashicons-hammer',
        'show_in_rest' => true,
    ));
}
add_action('init', 'soltek_register_services_cpt');

/**
 * Custom Post Type: Corsi
 */
function soltek_register_courses_cpt() {
    register_post_type('corso', array(
        'labels' => array(
            'name'               => __('Corsi', 'soltek'),
            'singular_name'      => __('Corso', 'soltek'),
            'add_new'            => __('Aggiungi Corso', 'soltek'),
            'add_new_item'       => __('Aggiungi Nuovo Corso', 'soltek'),
            'edit_item'          => __('Modifica Corso', 'soltek'),
            'view_item'          => __('Visualizza Corso', 'soltek'),
            'all_items'          => __('Tutti i Corsi', 'soltek'),
        ),
        'public'       => true,
        'has_archive'  => true,
        'rewrite'      => array('slug' => 'corsi'),
        'supports'     => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'menu_icon'    => 'dashicons-welcome-learn-more',
        'show_in_rest' => true,
    ));
}
add_action('init', 'soltek_register_courses_cpt');

/**
 * Add custom fields meta box for Servizi
 */
function soltek_service_meta_boxes() {
    add_meta_box(
        'soltek_service_details',
        __('Dettagli Servizio', 'soltek'),
        'soltek_service_meta_box_callback',
        'servizio',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'soltek_service_meta_boxes');

function soltek_service_meta_box_callback($post) {
    wp_nonce_field('soltek_service_meta', 'soltek_service_meta_nonce');

    $price = get_post_meta($post->ID, '_soltek_service_price', true);
    $icon = get_post_meta($post->ID, '_soltek_service_icon', true);
    ?>
    <p>
        <label for="soltek_service_price"><strong><?php _e('Prezzo:', 'soltek'); ?></strong></label><br>
        <input type="text" id="soltek_service_price" name="soltek_service_price" value="<?php echo esc_attr($price); ?>" placeholder="Es: Da €30" style="width: 100%;">
    </p>
    <p>
        <label for="soltek_service_icon"><strong><?php _e('Icona (emoji):', 'soltek'); ?></strong></label><br>
        <input type="text" id="soltek_service_icon" name="soltek_service_icon" value="<?php echo esc_attr($icon); ?>" placeholder="Es: 🔧" style="width: 100%;">
    </p>
    <?php
}

function soltek_save_service_meta($post_id) {
    if (!isset($_POST['soltek_service_meta_nonce']) ||
        !wp_verify_nonce($_POST['soltek_service_meta_nonce'], 'soltek_service_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (isset($_POST['soltek_service_price'])) {
        update_post_meta($post_id, '_soltek_service_price', sanitize_text_field($_POST['soltek_service_price']));
    }

    if (isset($_POST['soltek_service_icon'])) {
        update_post_meta($post_id, '_soltek_service_icon', sanitize_text_field($_POST['soltek_service_icon']));
    }
}
add_action('save_post_servizio', 'soltek_save_service_meta');

/**
 * Add custom fields meta box for Corsi
 */
function soltek_course_meta_boxes() {
    add_meta_box(
        'soltek_course_details',
        __('Dettagli Corso', 'soltek'),
        'soltek_course_meta_box_callback',
        'corso',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'soltek_course_meta_boxes');

function soltek_course_meta_box_callback($post) {
    wp_nonce_field('soltek_course_meta', 'soltek_course_meta_nonce');

    $price = get_post_meta($post->ID, '_soltek_course_price', true);
    $duration = get_post_meta($post->ID, '_soltek_course_duration', true);
    $level = get_post_meta($post->ID, '_soltek_course_level', true);
    ?>
    <p>
        <label for="soltek_course_price"><strong><?php _e('Prezzo:', 'soltek'); ?></strong></label><br>
        <input type="text" id="soltek_course_price" name="soltek_course_price" value="<?php echo esc_attr($price); ?>" placeholder="Es: €80" style="width: 100%;">
    </p>
    <p>
        <label for="soltek_course_duration"><strong><?php _e('Durata:', 'soltek'); ?></strong></label><br>
        <input type="text" id="soltek_course_duration" name="soltek_course_duration" value="<?php echo esc_attr($duration); ?>" placeholder="Es: 10 ore" style="width: 100%;">
    </p>
    <p>
        <label for="soltek_course_level"><strong><?php _e('Livello:', 'soltek'); ?></strong></label><br>
        <select id="soltek_course_level" name="soltek_course_level" style="width: 100%;">
            <option value="Base" <?php selected($level, 'Base'); ?>>Base</option>
            <option value="Intermedio" <?php selected($level, 'Intermedio'); ?>>Intermedio</option>
            <option value="Avanzato" <?php selected($level, 'Avanzato'); ?>>Avanzato</option>
            <option value="Su misura" <?php selected($level, 'Su misura'); ?>>Su misura</option>
        </select>
    </p>
    <?php
}

function soltek_save_course_meta($post_id) {
    if (!isset($_POST['soltek_course_meta_nonce']) ||
        !wp_verify_nonce($_POST['soltek_course_meta_nonce'], 'soltek_course_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (isset($_POST['soltek_course_price'])) {
        update_post_meta($post_id, '_soltek_course_price', sanitize_text_field($_POST['soltek_course_price']));
    }

    if (isset($_POST['soltek_course_duration'])) {
        update_post_meta($post_id, '_soltek_course_duration', sanitize_text_field($_POST['soltek_course_duration']));
    }

    if (isset($_POST['soltek_course_level'])) {
        update_post_meta($post_id, '_soltek_course_level', sanitize_text_field($_POST['soltek_course_level']));
    }
}
add_action('save_post_corso', 'soltek_save_course_meta');

/**
 * WooCommerce: Change add to cart text
 */
function soltek_woocommerce_add_to_cart_text() {
    return __('Aggiungi al Carrello', 'soltek');
}
add_filter('woocommerce_product_single_add_to_cart_text', 'soltek_woocommerce_add_to_cart_text');
add_filter('woocommerce_product_add_to_cart_text', 'soltek_woocommerce_add_to_cart_text');

/**
 * WooCommerce: Products per page
 */
function soltek_woocommerce_products_per_page() {
    return 12;
}
add_filter('loop_shop_per_page', 'soltek_woocommerce_products_per_page');

/**
 * WooCommerce: Grid columns
 */
function soltek_woocommerce_loop_columns() {
    return 3;
}
add_filter('loop_shop_columns', 'soltek_woocommerce_loop_columns');

/**
 * Customizer settings
 */
function soltek_customize_register($wp_customize) {
    // Contact Info Section
    $wp_customize->add_section('soltek_contact', array(
        'title'    => __('Informazioni Contatto', 'soltek'),
        'priority' => 30,
    ));

    // Phone
    $wp_customize->add_setting('soltek_phone', array(
        'default'           => '0935 686694',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('soltek_phone', array(
        'label'   => __('Telefono', 'soltek'),
        'section' => 'soltek_contact',
        'type'    => 'text',
    ));

    // Email
    $wp_customize->add_setting('soltek_email', array(
        'default'           => 'info@soltek.it',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('soltek_email', array(
        'label'   => __('Email', 'soltek'),
        'section' => 'soltek_contact',
        'type'    => 'email',
    ));

    // Address
    $wp_customize->add_setting('soltek_address', array(
        'default'           => 'Via delle Rose 12, Piazza Armerina (EN)',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('soltek_address', array(
        'label'   => __('Indirizzo', 'soltek'),
        'section' => 'soltek_contact',
        'type'    => 'text',
    ));

    // P.IVA
    $wp_customize->add_setting('soltek_piva', array(
        'default'           => '01133640860',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('soltek_piva', array(
        'label'   => __('P.IVA', 'soltek'),
        'section' => 'soltek_contact',
        'type'    => 'text',
    ));

    // Social Media Section
    $wp_customize->add_section('soltek_social', array(
        'title'    => __('Social Media', 'soltek'),
        'priority' => 35,
    ));

    // Facebook
    $wp_customize->add_setting('soltek_facebook', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('soltek_facebook', array(
        'label'   => __('Facebook URL', 'soltek'),
        'section' => 'soltek_social',
        'type'    => 'url',
    ));

    // Instagram
    $wp_customize->add_setting('soltek_instagram', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('soltek_instagram', array(
        'label'   => __('Instagram URL', 'soltek'),
        'section' => 'soltek_social',
        'type'    => 'url',
    ));
}
add_action('customize_register', 'soltek_customize_register');

/**
 * AJAX handler for chat (placeholder - needs API key)
 */
function soltek_chat_handler() {
    check_ajax_referer('soltek_nonce', 'nonce');

    $message = isset($_POST['message']) ? sanitize_text_field($_POST['message']) : '';

    // Placeholder response - integrate with Gemini API
    $response = array(
        'success' => true,
        'message' => 'Grazie per il messaggio! Un nostro operatore ti risponderà presto. Per assistenza immediata chiama lo 0935 686694.',
    );

    wp_send_json($response);
}
add_action('wp_ajax_soltek_chat', 'soltek_chat_handler');
add_action('wp_ajax_nopriv_soltek_chat', 'soltek_chat_handler');
