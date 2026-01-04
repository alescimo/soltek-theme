<?php
/**
 * Generic Page Template
 *
 * @package Soltek
 */

get_header();
?>

<div class="container" style="padding: 4rem 1rem;">
    <?php while (have_posts()) : the_post(); ?>
        <article class="page-content">
            <header style="text-align: center; margin-bottom: 3rem;">
                <h1 style="font-size: 2.5rem; font-weight: 800; color: #1e3a8a; margin-bottom: 1rem;">
                    <?php the_title(); ?>
                </h1>
                <?php if (has_excerpt()) : ?>
                    <p style="font-size: 1.125rem; color: #6b7280; max-width: 42rem; margin: 0 auto;">
                        <?php the_excerpt(); ?>
                    </p>
                <?php endif; ?>
            </header>

            <?php if (has_post_thumbnail()) : ?>
                <div style="margin-bottom: 3rem; border-radius: 1rem; overflow: hidden;">
                    <?php the_post_thumbnail('large', array('style' => 'width: 100%; height: auto;')); ?>
                </div>
            <?php endif; ?>

            <div class="entry-content" style="max-width: 65ch; margin: 0 auto; font-size: 1.125rem; line-height: 1.8; color: #374151;">
                <?php the_content(); ?>
            </div>
        </article>
    <?php endwhile; ?>
</div>

<?php
get_footer();
