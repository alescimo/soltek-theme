<?php
/**
 * Services Archive Template
 *
 * @package Soltek
 */

get_header();
?>

<div class="container" style="padding: 4rem 1rem;">
    <header style="text-align: center; margin-bottom: 3rem;">
        <h1 class="section-title"><?php _e('I Nostri Servizi', 'soltek'); ?></h1>
        <p class="section-subtitle"><?php _e('Assistenza tecnica professionale e soluzioni IT su misura per privati e aziende.', 'soltek'); ?></p>
        <p class="font-handwriting" style="font-size: 1.5rem; color: #3b82f6; transform: rotate(-1deg);">
            <?php _e('Problemi col PC? Ci pensiamo noi!', 'soltek'); ?>
        </p>
    </header>

    <?php if (have_posts()) : ?>
        <div class="grid-2" style="display: grid; grid-template-columns: repeat(1, 1fr); gap: 1.5rem;">
            <?php while (have_posts()) : the_post();
                $icon = get_post_meta(get_the_ID(), '_soltek_service_icon', true) ?: '🔧';
                $price = get_post_meta(get_the_ID(), '_soltek_service_price', true);
                ?>
                <div class="card" style="display: flex; flex-direction: row; align-items: flex-start; padding: 1.5rem; gap: 1rem;">
                    <span style="font-size: 2.5rem;"><?php echo esc_html($icon); ?></span>
                    <div style="flex: 1;">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.5rem;">
                            <h3 class="card-title" style="margin: 0;"><?php the_title(); ?></h3>
                            <?php if ($price) : ?>
                                <span style="background: #eff6ff; color: #2563eb; font-weight: 700; font-size: 0.875rem; padding: 0.25rem 0.75rem; border-radius: 9999px; white-space: nowrap;">
                                    <?php echo esc_html($price); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <p class="card-description" style="margin: 0;"><?php the_excerpt(); ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <style>
            @media (min-width: 768px) {
                .grid-2 { grid-template-columns: repeat(2, 1fr); }
            }
        </style>

    <?php else : ?>
        <p class="text-center"><?php _e('Nessun servizio disponibile.', 'soltek'); ?></p>
    <?php endif; ?>

    <!-- CTA -->
    <div class="cta-section" style="margin-top: 4rem;">
        <h2 class="cta-title"><?php _e('Hai bisogno di assistenza?', 'soltek'); ?></h2>
        <p class="cta-subtitle"><?php _e('Contattaci per un preventivo gratuito o passa direttamente in negozio.', 'soltek'); ?></p>
        <div class="cta-buttons">
            <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', get_theme_mod('soltek_phone', '0935686694'))); ?>" class="btn btn-primary" style="background: white; color: #1e3a8a;">
                📞 <?php _e('Chiama', 'soltek'); ?> <?php echo esc_html(get_theme_mod('soltek_phone', '0935 686694')); ?>
            </a>
            <a href="<?php echo esc_url(home_url('/prenota')); ?>" class="btn btn-outline">
                <?php _e('Prenota Appuntamento', 'soltek'); ?>
            </a>
        </div>
    </div>
</div>

<?php
get_footer();
