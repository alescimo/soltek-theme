<?php
/**
 * Courses Archive Template
 *
 * @package Soltek
 */

get_header();
?>

<div class="container" style="padding: 4rem 1rem;">
    <header style="text-align: center; margin-bottom: 3rem;">
        <h1 class="section-title"><?php _e('Corsi di Formazione', 'soltek'); ?></h1>
        <p class="section-subtitle"><?php _e('Impara a usare il computer con i nostri corsi per ogni livello.', 'soltek'); ?></p>
        <p class="font-handwriting" style="font-size: 1.5rem; color: #3b82f6; transform: rotate(1deg);">
            <?php _e('Imparare è facile con noi!', 'soltek'); ?>
        </p>
    </header>

    <?php if (have_posts()) : ?>
        <div class="grid-3">
            <?php while (have_posts()) : the_post();
                $price = get_post_meta(get_the_ID(), '_soltek_course_price', true);
                $duration = get_post_meta(get_the_ID(), '_soltek_course_duration', true);
                $level = get_post_meta(get_the_ID(), '_soltek_course_level', true);

                $level_colors = array(
                    'Base'       => '#22c55e',
                    'Intermedio' => '#3b82f6',
                    'Avanzato'   => '#8b5cf6',
                    'Su misura'  => '#6b7280',
                );
                $color = isset($level_colors[$level]) ? $level_colors[$level] : '#6b7280';
                ?>
                <div class="card">
                    <div style="height: 0.5rem; background: <?php echo esc_attr($color); ?>;"></div>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="card-image">
                            <?php the_post_thumbnail('medium_large'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="card-content">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                            <span style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; padding: 0.25rem 0.75rem; border-radius: 9999px; background: <?php echo esc_attr($color); ?>20; color: <?php echo esc_attr($color); ?>;">
                                <?php echo esc_html($level); ?>
                            </span>
                            <?php if ($duration) : ?>
                                <span style="font-size: 0.75rem; color: #9ca3af;">🕐 <?php echo esc_html($duration); ?></span>
                            <?php endif; ?>
                        </div>
                        <h3 class="card-title"><?php the_title(); ?></h3>
                        <p class="card-description"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                        <div class="card-footer">
                            <span class="card-price"><?php echo esc_html($price); ?></span>
                            <a href="<?php echo esc_url(home_url('/prenota')); ?>" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.875rem;">
                                <?php _e('Iscriviti', 'soltek'); ?>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

    <?php else : ?>
        <p class="text-center"><?php _e('Nessun corso disponibile.', 'soltek'); ?></p>
    <?php endif; ?>

    <!-- Stats -->
    <div class="section-gray" style="margin-top: 4rem; padding: 3rem; border-radius: 1.5rem;">
        <div class="grid-4" style="text-align: center;">
            <div>
                <span style="font-size: 2.5rem; font-weight: 800; color: #1e3a8a; display: block;">500+</span>
                <span style="color: #6b7280; font-size: 0.875rem;"><?php _e('Studenti formati', 'soltek'); ?></span>
            </div>
            <div>
                <span style="font-size: 2.5rem; font-weight: 800; color: #1e3a8a; display: block;">15+</span>
                <span style="color: #6b7280; font-size: 0.875rem;"><?php _e('Anni di esperienza', 'soltek'); ?></span>
            </div>
            <div>
                <span style="font-size: 2.5rem; font-weight: 800; color: #1e3a8a; display: block;">98%</span>
                <span style="color: #6b7280; font-size: 0.875rem;"><?php _e('Soddisfazione', 'soltek'); ?></span>
            </div>
            <div>
                <span style="font-size: 2.5rem; font-weight: 800; color: #1e3a8a; display: block;">1:4</span>
                <span style="color: #6b7280; font-size: 0.875rem;"><?php _e('Rapporto docente/studenti', 'soltek'); ?></span>
            </div>
        </div>
        <p class="font-handwriting" style="text-align: center; font-size: 1.25rem; color: #3b82f6; margin-top: 1.5rem;">
            <?php _e('Piccoli gruppi per imparare meglio!', 'soltek'); ?>
        </p>
    </div>
</div>

<?php
get_footer();
