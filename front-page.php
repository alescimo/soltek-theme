<?php
/**
 * Homepage Template
 *
 * @package Soltek
 */

get_header();
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-content">
        <div>
            <p class="font-handwriting" style="font-size: 1.5rem; color: #fcd34d; margin-bottom: 1rem; transform: rotate(-2deg);">
                <?php _e('Il tuo negozio di fiducia dal 1995', 'soltek'); ?>
            </p>
            <h1 class="hero-title">
                <?php _e('Tecnologia & Assistenza a Piazza Armerina', 'soltek'); ?>
            </h1>
            <p class="hero-subtitle">
                <?php _e('Vendita computer, assistenza tecnica, corsi di formazione. Da oltre 25 anni al servizio del territorio.', 'soltek'); ?>
            </p>
            <div class="hero-buttons">
                <a href="<?php echo esc_url(home_url('/negozio')); ?>" class="btn btn-primary" style="background: white; color: #1e3a8a;">
                    <?php _e('Sfoglia il Negozio', 'soltek'); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/prenota')); ?>" class="btn btn-outline">
                    <?php _e('Prenota Consulenza', 'soltek'); ?>
                </a>
            </div>
        </div>
        <div class="hero-image">
            <img src="https://images.unsplash.com/photo-1593642632559-0c6d3fc62b89?w=600&h=400&fit=crop" alt="<?php _e('Tecnologia Soltek', 'soltek'); ?>">
        </div>
    </div>
</section>

<!-- Featured Products -->
<?php if (function_exists('WC')) : ?>
<section class="section">
    <div class="container">
        <h2 class="section-title"><?php _e('Prodotti in Evidenza', 'soltek'); ?></h2>
        <p class="section-subtitle"><?php _e('Scopri le nostre migliori offerte selezionate per te.', 'soltek'); ?></p>

        <div class="grid-4">
            <?php
            $args = array(
                'post_type'      => 'product',
                'posts_per_page' => 4,
                'meta_key'       => '_featured',
                'meta_value'     => 'yes',
            );
            $featured = new WP_Query($args);

            if (!$featured->have_posts()) {
                $args = array(
                    'post_type'      => 'product',
                    'posts_per_page' => 4,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                );
                $featured = new WP_Query($args);
            }

            if ($featured->have_posts()) :
                while ($featured->have_posts()) : $featured->the_post();
                    global $product;
                    ?>
                    <div class="card" style="position: relative;">
                        <?php if ($product->is_on_sale()) : ?>
                            <span class="badge"><?php _e('Offerta', 'soltek'); ?></span>
                        <?php endif; ?>
                        <div class="card-image">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('woocommerce_thumbnail'); ?>
                            </a>
                        </div>
                        <div class="card-content">
                            <span class="card-category"><?php echo wc_get_product_category_list($product->get_id()); ?></span>
                            <h3 class="card-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <p class="card-description"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                            <div class="card-footer">
                                <div>
                                    <?php if ($product->is_on_sale()) : ?>
                                        <span class="card-price-old"><?php echo $product->get_regular_price(); ?>€</span>
                                    <?php endif; ?>
                                    <span class="card-price"><?php echo $product->get_price(); ?>€</span>
                                </div>
                                <a href="?add-to-cart=<?php echo $product->get_id(); ?>" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.875rem;">
                                    <i data-lucide="shopping-cart" style="width: 16px; height: 16px;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            else : ?>
                <p class="text-center" style="grid-column: 1 / -1;">
                    <?php _e('Nessun prodotto disponibile. Aggiungi prodotti in WooCommerce.', 'soltek'); ?>
                </p>
            <?php endif; ?>
        </div>

        <div class="text-center" style="margin-top: 3rem;">
            <a href="<?php echo esc_url(home_url('/negozio')); ?>" class="btn btn-primary">
                <?php _e('Vedi tutti i prodotti', 'soltek'); ?> →
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Services Section -->
<section class="section section-gray">
    <div class="container">
        <h2 class="section-title"><?php _e('I Nostri Servizi', 'soltek'); ?></h2>
        <p class="section-subtitle"><?php _e('Assistenza tecnica professionale per ogni esigenza.', 'soltek'); ?></p>
        <p class="font-handwriting text-center" style="font-size: 1.5rem; color: #3b82f6; margin-bottom: 2rem;"><?php _e('Problemi col PC? Ci pensiamo noi!', 'soltek'); ?></p>

        <div class="grid-4">
            <?php
            $services = new WP_Query(array(
                'post_type'      => 'servizio',
                'posts_per_page' => 4,
            ));

            if ($services->have_posts()) :
                while ($services->have_posts()) : $services->the_post();
                    $icon = get_post_meta(get_the_ID(), '_soltek_service_icon', true) ?: '🔧';
                    $price = get_post_meta(get_the_ID(), '_soltek_service_price', true);
                    ?>
                    <div class="service-card">
                        <span class="service-icon"><?php echo esc_html($icon); ?></span>
                        <h3 class="service-title"><?php the_title(); ?></h3>
                        <p class="service-description"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                        <?php if ($price) : ?>
                            <p style="color: #2563eb; font-weight: 700; margin-top: 1rem;"><?php echo esc_html($price); ?></p>
                        <?php endif; ?>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                // Fallback services
                $default_services = array(
                    array('icon' => '🔧', 'title' => 'Riparazione PC', 'desc' => 'Diagnosi e riparazione hardware e software'),
                    array('icon' => '🖥️', 'title' => 'Assemblaggio PC', 'desc' => 'PC su misura per gaming o lavoro'),
                    array('icon' => '🌐', 'title' => 'Reti Aziendali', 'desc' => 'Configurazione reti LAN e Wi-Fi'),
                    array('icon' => '🏠', 'title' => 'Assistenza a Domicilio', 'desc' => 'Interventi direttamente a casa tua'),
                );
                foreach ($default_services as $service) :
                    ?>
                    <div class="service-card">
                        <span class="service-icon"><?php echo $service['icon']; ?></span>
                        <h3 class="service-title"><?php echo $service['title']; ?></h3>
                        <p class="service-description"><?php echo $service['desc']; ?></p>
                    </div>
                    <?php
                endforeach;
            endif;
            ?>
        </div>

        <div class="text-center" style="margin-top: 3rem;">
            <a href="<?php echo esc_url(home_url('/servizi')); ?>" class="btn btn-primary">
                <?php _e('Tutti i servizi', 'soltek'); ?> →
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section">
    <div class="cta-section">
        <div style="position: absolute; top: 1rem; right: 2rem;" class="font-handwriting hidden md:block" style="font-size: 1.5rem; color: #fcd34d; transform: rotate(12deg);">
            <?php _e('Ti aspettiamo!', 'soltek'); ?>
        </div>
        <h2 class="cta-title"><?php _e('Hai bisogno di assistenza?', 'soltek'); ?></h2>
        <p class="cta-subtitle"><?php _e('Contattaci per un preventivo gratuito o passa in negozio.', 'soltek'); ?></p>
        <div class="cta-buttons">
            <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', get_theme_mod('soltek_phone', '0935686694'))); ?>" class="btn btn-primary" style="background: white; color: #1e3a8a;">
                📞 <?php _e('Chiama', 'soltek'); ?> <?php echo esc_html(get_theme_mod('soltek_phone', '0935 686694')); ?>
            </a>
            <a href="<?php echo esc_url(home_url('/prenota')); ?>" class="btn btn-outline">
                <?php _e('Prenota Appuntamento', 'soltek'); ?>
            </a>
        </div>
    </div>
</section>

<!-- Courses Section -->
<section class="section section-gray">
    <div class="container">
        <h2 class="section-title"><?php _e('Corsi di Formazione', 'soltek'); ?></h2>
        <p class="section-subtitle"><?php _e('Impara a usare il computer con i nostri corsi.', 'soltek'); ?></p>

        <div class="grid-3">
            <?php
            $courses = new WP_Query(array(
                'post_type'      => 'corso',
                'posts_per_page' => 3,
            ));

            if ($courses->have_posts()) :
                while ($courses->have_posts()) : $courses->the_post();
                    $price = get_post_meta(get_the_ID(), '_soltek_course_price', true);
                    $duration = get_post_meta(get_the_ID(), '_soltek_course_duration', true);
                    $level = get_post_meta(get_the_ID(), '_soltek_course_level', true);
                    ?>
                    <div class="card">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="card-image">
                                <?php the_post_thumbnail('medium_large'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="card-content">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                <span style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: #6b7280;"><?php echo esc_html($level); ?></span>
                                <?php if ($duration) : ?>
                                    <span style="font-size: 0.75rem; color: #9ca3af;">🕐 <?php echo esc_html($duration); ?></span>
                                <?php endif; ?>
                            </div>
                            <h3 class="card-title"><?php the_title(); ?></h3>
                            <p class="card-description"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                            <div class="card-footer">
                                <span class="card-price"><?php echo esc_html($price); ?></span>
                                <a href="<?php echo esc_url(home_url('/prenota')); ?>" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.875rem;">
                                    <?php _e('Iscriviti', 'soltek'); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                // Fallback
                ?>
                <p class="text-center" style="grid-column: 1 / -1;">
                    <?php _e('Aggiungi corsi dalla sezione Corsi nel pannello admin.', 'soltek'); ?>
                </p>
            <?php endif; ?>
        </div>

        <div class="text-center" style="margin-top: 3rem;">
            <a href="<?php echo esc_url(home_url('/corsi')); ?>" class="btn btn-primary">
                <?php _e('Tutti i corsi', 'soltek'); ?> →
            </a>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="section">
    <div class="container">
        <h2 class="section-title"><?php _e('Cosa Dicono di Noi', 'soltek'); ?></h2>
        <p class="section-subtitle"><?php _e('La fiducia dei nostri clienti è il nostro successo.', 'soltek'); ?></p>

        <div class="grid-3">
            <?php
            $testimonials = array(
                array(
                    'text'     => "Ho acquistato il mio primo PC da Soltek nel 2010 e da allora mi affido sempre a loro. Competenti e disponibili.",
                    'name'     => 'Marco R.',
                    'location' => 'Piazza Armerina',
                    'avatar'   => 'https://i.pravatar.cc/150?u=marco',
                ),
                array(
                    'text'     => "Avevo bisogno di sistemare la rete aziendale: sono venuti, hanno analizzato la situazione e risolto tutto in mezza giornata.",
                    'name'     => 'Studio Commercialista Ferrara',
                    'location' => 'Enna',
                    'avatar'   => 'https://i.pravatar.cc/150?u=studio',
                ),
                array(
                    'text'     => "Prezzi onesti e assistenza vera. Quando il portatile si è bloccato prima di un esame, me l'hanno sistemato in giornata.",
                    'name'     => 'Giulia S.',
                    'location' => 'Piazza Armerina',
                    'avatar'   => 'https://i.pravatar.cc/150?u=giulia',
                ),
            );

            foreach ($testimonials as $testimonial) :
                ?>
                <div class="testimonial-card">
                    <p class="testimonial-text">"<?php echo esc_html($testimonial['text']); ?>"</p>
                    <div class="testimonial-author">
                        <img src="<?php echo esc_url($testimonial['avatar']); ?>" alt="<?php echo esc_attr($testimonial['name']); ?>" class="testimonial-avatar">
                        <div>
                            <p class="testimonial-name"><?php echo esc_html($testimonial['name']); ?></p>
                            <p class="testimonial-location"><?php echo esc_html($testimonial['location']); ?></p>
                        </div>
                    </div>
                </div>
                <?php
            endforeach;
            ?>
        </div>
    </div>
</section>

<?php
get_footer();
