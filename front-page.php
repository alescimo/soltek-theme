<?php
/**
 * Homepage Template - Matching React Design
 *
 * @package Soltek
 */

get_header();
?>

<!-- Hero Section -->
<section class="relative overflow-hidden bg-white" style="padding: 3rem 0;">
    <div class="container" style="display: flex; flex-wrap: wrap; align-items: center; gap: 4rem;">
        <div style="flex: 1; min-width: 300px; text-align: center;" class="hero-text">
            <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: #eff6ff; color: #1d4ed8; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.875rem; font-weight: 600; margin-bottom: 1.5rem;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                <span>Dal 1995 al tuo servizio</span>
            </div>
            <div style="position: relative;">
                <h1 style="font-size: 2.5rem; font-weight: 800; color: #1e3a8a; line-height: 1.1; margin-bottom: 1.5rem;">
                    Il tuo partner tecnologico a <span style="color: #2563eb;">Piazza Armerina</span>
                </h1>
                <span class="font-handwriting" style="position: absolute; top: -2rem; right: 0; font-size: 1.75rem; color: #eab308; transform: rotate(12deg); display: none;">
                    Ciao! 👋
                </span>
            </div>
            <p style="font-size: 1.125rem; color: #4b5563; margin-bottom: 0.5rem; max-width: 36rem;">
                Computer, assistenza e soluzioni su misura per privati e aziende. L'informatica resa semplice da oltre 25 anni.
            </p>
            <p class="font-handwriting" style="font-size: 1.5rem; color: #3b82f6; transform: rotate(-1deg); margin-bottom: 2rem;">
                Parliamo la tua lingua, non il "computerese"!
            </p>
            <div style="display: flex; flex-wrap: wrap; gap: 1rem; justify-content: center;">
                <a href="<?php echo esc_url(home_url('/negozio')); ?>" class="btn btn-primary" style="padding: 1rem 2rem; font-size: 1rem; box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);">
                    Scopri i nostri prodotti
                </a>
                <a href="<?php echo esc_url(home_url('/prenota')); ?>" style="padding: 1rem 2rem; background: white; border: 2px solid #e5e7eb; color: #374151; border-radius: 0.75rem; font-weight: 700; text-decoration: none; position: relative;">
                    Consulenza Gratuita
                    <span class="font-handwriting" style="position: absolute; bottom: -1.5rem; left: 50%; transform: translateX(-50%); font-size: 1rem; color: #6b7280; white-space: nowrap;">
                        Senza impegno!
                    </span>
                </a>
            </div>
        </div>
        <div style="flex: 1; min-width: 300px; position: relative;" class="hero-image-container">
            <div style="position: absolute; top: 0; left: -1rem; width: 18rem; height: 18rem; background: #bfdbfe; border-radius: 9999px; filter: blur(60px); opacity: 0.4;"></div>
            <div style="position: absolute; top: 0; right: -1rem; width: 18rem; height: 18rem; background: #c7d2fe; border-radius: 9999px; filter: blur(60px); opacity: 0.4;"></div>
            <div style="position: relative;">
                <img src="https://images.unsplash.com/photo-1593642632559-0c6d3fc62b89?w=800&h=600&fit=crop" alt="Tecnologia Soltek" style="border-radius: 1rem; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); border: 8px solid white; width: 100%;">
                <div class="font-handwriting" style="position: absolute; bottom: -1.5rem; right: -1.5rem; background: #fef3c7; padding: 1rem; border-radius: 0.75rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); border: 1px solid #fde68a; transform: rotate(3deg);">
                    <p style="font-size: 1.25rem; color: #92400e; font-weight: 700; margin: 0;">
                        Siamo qui per te! ❤️
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
@media (min-width: 1024px) {
    .hero-text { text-align: left !important; }
    .hero-text > div:last-child { justify-content: flex-start !important; }
    .hero-text span[style*="absolute"][style*="rotate(12deg)"] { display: block !important; }
}
</style>

<!-- Services Section -->
<section style="padding: 5rem 0; background: #f9fafb;">
    <div class="container">
        <div style="text-align: center; max-width: 48rem; margin: 0 auto 4rem;">
            <h2 style="font-size: 1.875rem; font-weight: 700; color: #111827; margin-bottom: 1rem;">Soluzioni informatiche complete</h2>
            <p style="color: #4b5563;">
                Non vendiamo solo prodotti: ti affianchiamo nella scelta, nella configurazione e nell'assistenza.
                Il nostro team conosce le esigenze del territorio e sa consigliarti la soluzione più adatta.
            </p>
        </div>
        <div class="grid-4">
            <?php
            $services = array(
                array('icon' => '🛡️', 'title' => 'Assistenza Tecnica', 'desc' => 'Riparazione computer, notebook e periferiche di ogni marca.'),
                array('icon' => '🖥️', 'title' => 'Assemblaggio PC', 'desc' => 'Creiamo il tuo PC ideale per gaming o lavoro su misura.'),
                array('icon' => '🌐', 'title' => 'Reti Aziendali', 'desc' => 'Configurazione e manutenzione reti LAN/Wi-Fi per uffici.'),
                array('icon' => '💡', 'title' => 'Consulenza IT', 'desc' => 'Ti guidiamo nella trasformazione digitale della tua attività.'),
            );
            foreach ($services as $service) :
            ?>
            <div class="service-card" style="background: white; padding: 2rem; border-radius: 1rem; border: 1px solid #f3f4f6; transition: all 0.3s;">
                <div style="width: 3.5rem; height: 3.5rem; background: #eff6ff; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; font-size: 1.75rem;">
                    <?php echo $service['icon']; ?>
                </div>
                <h3 style="font-size: 1.25rem; font-weight: 700; color: #111827; margin-bottom: 1rem;"><?php echo $service['title']; ?></h3>
                <p style="color: #6b7280; font-size: 0.875rem; line-height: 1.75; margin-bottom: 1.5rem;"><?php echo $service['desc']; ?></p>
                <a href="<?php echo esc_url(home_url('/servizi')); ?>" style="display: inline-flex; align-items: center; color: #2563eb; font-weight: 700; font-size: 0.875rem; text-decoration: none;">
                    Scopri di più
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-left: 0.25rem;"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Products Section -->
<?php if (function_exists('WC')) : ?>
<section style="padding: 5rem 0; background: white;">
    <div class="container">
        <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-end; gap: 1.5rem; margin-bottom: 3rem;">
            <div style="max-width: 36rem;">
                <h2 style="font-size: 1.875rem; font-weight: 700; color: #111827; margin-bottom: 1rem;">Tutto per il tuo ufficio e la tua casa</h2>
                <p style="color: #4b5563;">Dai notebook alle stampanti, dai componenti agli accessori: trovi tutto in negozio o lo ordini online e lo ritiri da noi.</p>
            </div>
            <a href="<?php echo esc_url(home_url('/negozio')); ?>" style="padding: 0.75rem 1.5rem; border: 2px solid #e5e7eb; border-radius: 0.75rem; font-weight: 700; color: #374151; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
                Vai al Negozio
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 7h10v10"/><path d="M7 17 17 7"/></svg>
            </a>
        </div>
        <div class="grid-4">
            <?php
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => 4,
                'orderby' => 'date',
                'order' => 'DESC',
            );
            $products = new WP_Query($args);
            if ($products->have_posts()) :
                while ($products->have_posts()) : $products->the_post();
                    global $product;
                    ?>
                    <div class="card" style="position: relative;">
                        <?php if ($product->is_on_sale()) : ?>
                            <span style="position: absolute; top: 1rem; left: 1rem; z-index: 10; background: #2563eb; color: white; font-size: 0.625rem; font-weight: 700; padding: 0.25rem 0.75rem; border-radius: 9999px; text-transform: uppercase;">Offerta</span>
                        <?php endif; ?>
                        <div class="card-image">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('woocommerce_thumbnail'); ?>
                            </a>
                        </div>
                        <div class="card-content">
                            <span class="card-category"><?php echo wc_get_product_category_list($product->get_id(), ', '); ?></span>
                            <h3 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="card-footer">
                                <div>
                                    <?php if ($product->is_on_sale() && $product->get_regular_price()) : ?>
                                        <span class="card-price-old">€<?php echo $product->get_regular_price(); ?></span>
                                    <?php endif; ?>
                                    <span class="card-price">€<?php echo $product->get_price(); ?></span>
                                </div>
                                <a href="<?php the_permalink(); ?>" style="padding: 0.5rem; background: #eff6ff; color: #2563eb; border-radius: 0.5rem; display: flex;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata();
            else : ?>
                <p style="grid-column: 1 / -1; text-align: center; color: #6b7280;">Aggiungi prodotti in WooCommerce per visualizzarli qui.</p>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Why Choose Us -->
<section style="padding: 5rem 0; background: #1e3a8a; color: white; position: relative; overflow: hidden;">
    <div style="position: absolute; top: 0; right: 0; width: 33%; height: 100%; background: #1e40af; transform: skewX(-12deg) translateX(5rem); display: none;"></div>
    <div class="container" style="position: relative; z-index: 10;">
        <div style="display: grid; grid-template-columns: 1fr; gap: 4rem; align-items: center;">
            <div>
                <h2 style="font-size: 2.25rem; font-weight: 700; margin-bottom: 3rem;">Perché scegliere Soltek</h2>
                <div style="display: flex; flex-direction: column; gap: 2rem;">
                    <?php
                    $reasons = array(
                        array('icon' => '📍', 'title' => 'Esperienza locale', 'desc' => 'Oltre 25 anni di presenza sul territorio. Conosciamo le esigenze di Piazza Armerina e della provincia.'),
                        array('icon' => '🛡️', 'title' => 'Assistenza garantita', 'desc' => 'Ogni acquisto include supporto tecnico. Se hai un problema, ci siamo: in negozio, al telefono o a domicilio.'),
                        array('icon' => '⚡', 'title' => 'Soluzioni su misura', 'desc' => 'Non esistono clienti uguali. Ascoltiamo le tue esigenze e ti proponiamo la configurazione ideale, senza sprechi.'),
                    );
                    foreach ($reasons as $reason) :
                    ?>
                    <div style="display: flex; align-items: flex-start; gap: 1.5rem;">
                        <div style="width: 3rem; height: 3rem; background: #2563eb; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 1.5rem;">
                            <?php echo $reason['icon']; ?>
                        </div>
                        <div>
                            <h4 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 0.5rem;"><?php echo $reason['title']; ?></h4>
                            <p style="color: #bfdbfe; font-size: 0.875rem;"><?php echo $reason['desc']; ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div style="background: #1e40af; padding: 2rem; border-radius: 1.5rem; border: 1px solid #3b82f6; position: relative;">
                <div class="font-handwriting" style="position: absolute; top: -1rem; right: -1rem; background: white; color: #1e3a8a; padding: 0.5rem 1rem; border-radius: 0.5rem; font-size: 1.25rem; font-weight: 700; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); transform: rotate(6deg); z-index: 20;">
                    Fidati dell'esperienza!
                </div>
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 2rem; text-align: center;">
                    <div>
                        <span style="font-size: 3rem; font-weight: 800; display: block;">25+</span>
                        <span style="color: #bfdbfe; font-size: 0.875rem;">Anni di Attività</span>
                    </div>
                    <div>
                        <span style="font-size: 3rem; font-weight: 800; display: block;">10k+</span>
                        <span style="color: #bfdbfe; font-size: 0.875rem;">Clienti Soddisfatti</span>
                    </div>
                    <div>
                        <span style="font-size: 3rem; font-weight: 800; display: block;">5k+</span>
                        <span style="color: #bfdbfe; font-size: 0.875rem;">Riparazioni Effettuate</span>
                    </div>
                    <div>
                        <span style="font-size: 3rem; font-weight: 800; display: block;">100%</span>
                        <span style="color: #bfdbfe; font-size: 0.875rem;">Supporto Locale</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section style="padding: 5rem 0; background: white;">
    <div class="container">
        <div style="text-align: center; max-width: 48rem; margin: 0 auto 4rem;">
            <h2 style="font-size: 1.875rem; font-weight: 700; color: #111827; margin-bottom: 1rem;">Il team Soltek</h2>
            <p style="color: #4b5563;">Professionisti appassionati che uniscono competenza tecnica e attenzione al cliente.</p>
            <p class="font-handwriting" style="font-size: 1.5rem; color: #3b82f6; margin-top: 1rem; transform: rotate(-1deg);">
                Mettiamo la faccia su ogni riparazione!
            </p>
        </div>
        <div class="grid-4" style="text-align: center;">
            <?php
            $team = array(
                array('name' => 'Angelo S.', 'role' => 'Founder & Senior Tech', 'img' => 'https://i.pravatar.cc/150?u=angelo'),
                array('name' => 'Luca B.', 'role' => 'Hardware Expert', 'img' => 'https://i.pravatar.cc/150?u=luca'),
                array('name' => 'Simona M.', 'role' => 'Customer Support', 'img' => 'https://i.pravatar.cc/150?u=simona'),
                array('name' => 'Fabio T.', 'role' => 'Networking Specialist', 'img' => 'https://i.pravatar.cc/150?u=fabio'),
            );
            foreach ($team as $member) :
            ?>
            <div>
                <div style="position: relative; width: 12rem; height: 12rem; margin: 0 auto 1.5rem;">
                    <div style="position: absolute; inset: 0; background: #2563eb; border-radius: 1.5rem; transform: rotate(6deg);"></div>
                    <img src="<?php echo esc_url($member['img']); ?>" alt="<?php echo esc_attr($member['name']); ?>" style="position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; border-radius: 1.5rem; border: 4px solid white; z-index: 10;">
                </div>
                <h3 style="font-size: 1.25rem; font-weight: 700; color: #111827;"><?php echo $member['name']; ?></h3>
                <p style="color: #2563eb; font-weight: 500; font-size: 0.875rem;"><?php echo $member['role']; ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section style="padding: 5rem 0; background: #f9fafb;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 4rem;">
            <h2 style="font-size: 1.875rem; font-weight: 700; color: #111827;">Dicono di noi</h2>
        </div>
        <div class="grid-3">
            <?php
            $testimonials = array(
                array('text' => "Ho acquistato il mio primo PC da Soltek nel 2010 e da allora mi affido sempre a loro. Competenti e disponibili.", 'name' => 'Marco R.', 'location' => 'Piazza Armerina', 'avatar' => 'https://i.pravatar.cc/150?u=marco'),
                array('text' => "Avevo bisogno di sistemare la rete aziendale: sono venuti, hanno analizzato la situazione e risolto tutto in mezza giornata.", 'name' => 'Studio Commercialista Ferrara', 'location' => 'Enna', 'avatar' => 'https://i.pravatar.cc/150?u=studio'),
                array('text' => "Prezzi onesti e assistenza vera. Quando il portatile si è bloccato prima di un esame, me l'hanno sistemato in giornata.", 'name' => 'Giulia S.', 'location' => 'Piazza Armerina', 'avatar' => 'https://i.pravatar.cc/150?u=giulia'),
            );
            foreach ($testimonials as $t) :
            ?>
            <div class="testimonial-card">
                <div style="display: flex; color: #facc15; margin-bottom: 1rem;">
                    <?php for ($i = 0; $i < 5; $i++) : ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    <?php endfor; ?>
                </div>
                <p style="color: #4b5563; font-style: italic; line-height: 1.75; margin-bottom: 2rem;">"<?php echo $t['text']; ?>"</p>
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <img src="<?php echo esc_url($t['avatar']); ?>" alt="<?php echo esc_attr($t['name']); ?>" style="width: 3rem; height: 3rem; border-radius: 9999px; border: 2px solid #eff6ff;">
                    <div>
                        <h5 style="font-weight: 700; color: #111827;"><?php echo $t['name']; ?></h5>
                        <span style="font-size: 0.75rem; color: #6b7280;"><?php echo $t['location']; ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Final CTA -->
<section style="padding: 5rem 0; background: white;">
    <div class="container">
        <div style="background: #2563eb; border-radius: 1.5rem; padding: 3rem; text-align: center; color: white; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); position: relative; overflow: hidden;">
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0.1; background: radial-gradient(circle at 50% 50%, #fff, transparent);"></div>
            <h2 style="font-size: 2rem; font-weight: 700; margin-bottom: 1rem; position: relative; z-index: 10;">Hai bisogno di assistenza o vuoi un nuovo PC?</h2>
            <p style="color: #bfdbfe; margin-bottom: 2rem; position: relative; z-index: 10; max-width: 40rem; margin-left: auto; margin-right: auto;">Chiamaci ora o prenota una consulenza gratuita in negozio a Piazza Armerina.</p>
            <div style="display: flex; flex-wrap: wrap; justify-content: center; align-items: center; gap: 1.5rem; position: relative; z-index: 10;">
                <a href="<?php echo esc_url(home_url('/contatti')); ?>" style="padding: 1rem 2.5rem; background: white; color: #2563eb; border-radius: 0.75rem; font-weight: 700; font-size: 1.125rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
                    Contattaci
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                </a>
                <a href="tel:0935686694" style="color: white; font-weight: 700; font-size: 1.25rem; text-decoration: none;">
                    0935 686694
                </a>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
