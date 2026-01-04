<?php
/**
 * Main template file
 *
 * @package Soltek
 */

get_header();
?>

<div class="container" style="padding: 4rem 1rem;">
    <?php if (have_posts()) : ?>
        <div class="grid-3">
            <?php while (have_posts()) : the_post(); ?>
                <article class="card">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="card-image">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium_large'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="card-content">
                        <h2 class="card-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <div class="card-description">
                            <?php the_excerpt(); ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="btn btn-primary" style="margin-top: 1rem;">
                            <?php _e('Leggi tutto', 'soltek'); ?>
                        </a>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>

        <?php the_posts_pagination(array(
            'prev_text' => '&laquo; ' . __('Precedente', 'soltek'),
            'next_text' => __('Successivo', 'soltek') . ' &raquo;',
        )); ?>

    <?php else : ?>
        <div class="text-center" style="padding: 4rem;">
            <h2><?php _e('Nessun contenuto trovato', 'soltek'); ?></h2>
            <p><?php _e('Prova a effettuare una ricerca.', 'soltek'); ?></p>
        </div>
    <?php endif; ?>
</div>

<?php
get_footer();
