</main><!-- #main-content -->

<footer class="site-footer">
    <div class="footer-grid">
        <!-- Company Info -->
        <div class="footer-section">
            <div class="site-logo" style="margin-bottom: 1rem;">
                <img src="<?php echo esc_url(SOLTEK_URI . '/assets/images/logo.png'); ?>" alt="<?php bloginfo('name'); ?>" style="height: 2rem; filter: invert(1);">
                <span style="font-size: 1.25rem; font-weight: 700;"><?php bloginfo('name'); ?></span>
            </div>
            <p>Il tuo partner tecnologico di fiducia a Piazza Armerina dal 1995. Vendita, assistenza e consulenza specializzata.</p>
            <div class="footer-social">
                <?php if (get_theme_mod('soltek_facebook')) : ?>
                    <a href="<?php echo esc_url(get_theme_mod('soltek_facebook')); ?>" target="_blank" rel="noopener" aria-label="Facebook">
                        <i data-lucide="facebook" style="width: 18px; height: 18px;"></i>
                    </a>
                <?php endif; ?>
                <?php if (get_theme_mod('soltek_instagram')) : ?>
                    <a href="<?php echo esc_url(get_theme_mod('soltek_instagram')); ?>" target="_blank" rel="noopener" aria-label="Instagram">
                        <i data-lucide="instagram" style="width: 18px; height: 18px;"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="footer-section">
            <h4><?php _e('Link Rapidi', 'soltek'); ?></h4>
            <ul>
                <li><a href="<?php echo esc_url(home_url('/negozio')); ?>"><?php _e('Negozio Online', 'soltek'); ?></a></li>
                <li><a href="<?php echo esc_url(home_url('/servizi')); ?>"><?php _e('Servizi Assistenza', 'soltek'); ?></a></li>
                <li><a href="<?php echo esc_url(home_url('/corsi')); ?>"><?php _e('Corsi e Formazione', 'soltek'); ?></a></li>
                <li><a href="<?php echo esc_url(home_url('/prenota')); ?>"><?php _e('Prenota Appuntamento', 'soltek'); ?></a></li>
                <li><a href="<?php echo esc_url(home_url('/contatti')); ?>"><?php _e('Contattaci', 'soltek'); ?></a></li>
            </ul>
        </div>

        <!-- Contacts -->
        <div class="footer-section">
            <h4><?php _e('Contattaci', 'soltek'); ?></h4>
            <ul>
                <li style="display: flex; align-items: flex-start; gap: 0.75rem;">
                    <i data-lucide="map-pin" style="width: 18px; height: 18px; color: #60a5fa; flex-shrink: 0; margin-top: 2px;"></i>
                    <span><?php echo esc_html(get_theme_mod('soltek_address', 'Via delle Rose 12, Piazza Armerina (EN)')); ?></span>
                </li>
                <li style="display: flex; align-items: center; gap: 0.75rem;">
                    <i data-lucide="phone" style="width: 18px; height: 18px; color: #60a5fa; flex-shrink: 0;"></i>
                    <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', get_theme_mod('soltek_phone', '0935686694'))); ?>">
                        <?php echo esc_html(get_theme_mod('soltek_phone', '0935 686694')); ?>
                    </a>
                </li>
                <li style="display: flex; align-items: center; gap: 0.75rem;">
                    <i data-lucide="mail" style="width: 18px; height: 18px; color: #60a5fa; flex-shrink: 0;"></i>
                    <a href="mailto:<?php echo esc_attr(get_theme_mod('soltek_email', 'info@soltek.it')); ?>">
                        <?php echo esc_html(get_theme_mod('soltek_email', 'info@soltek.it')); ?>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Newsletter -->
        <div class="footer-section">
            <h4><?php _e('Offerte Tech', 'soltek'); ?></h4>
            <p><?php _e('Iscriviti per ricevere le ultime novità e sconti esclusivi.', 'soltek'); ?></p>
            <form class="newsletter-form" style="display: flex; margin-top: 1rem;">
                <input type="email" placeholder="<?php esc_attr_e('La tua email', 'soltek'); ?>" style="flex: 1; padding: 0.5rem 1rem; background: #1f2937; border: none; border-radius: 0.5rem 0 0 0.5rem; color: white; font-size: 0.875rem;">
                <button type="submit" style="padding: 0.5rem 0.75rem; background: #2563eb; border: none; border-radius: 0 0.5rem 0.5rem 0; cursor: pointer;">
                    <i data-lucide="arrow-right" style="width: 18px; height: 18px; color: white;"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- Bottom -->
    <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?> sas. <?php _e('Tutti i diritti riservati.', 'soltek'); ?> P.IVA <?php echo esc_html(get_theme_mod('soltek_piva', '01133640860')); ?></p>
        <div class="footer-bottom-links">
            <a href="<?php echo esc_url(home_url('/privacy-policy')); ?>"><?php _e('Privacy Policy', 'soltek'); ?></a>
            <a href="<?php echo esc_url(home_url('/termini-condizioni')); ?>"><?php _e('Termini e Condizioni', 'soltek'); ?></a>
            <a href="#" id="cookie-settings"><?php _e('Cookie Settings', 'soltek'); ?></a>
        </div>
    </div>
</footer>

<!-- Chat Widget -->
<div class="chat-widget" id="chat-widget">
    <button class="chat-button" id="chat-toggle">
        <i data-lucide="message-square" style="width: 24px; height: 24px;"></i>
        <span class="hidden md:inline"><?php _e("Chiedi all'esperto AI", 'soltek'); ?></span>
    </button>
</div>

<!-- Chat Window (loaded via JS) -->
<div id="chat-window" style="display: none;"></div>

<?php wp_footer(); ?>

<script>
// Initialize Lucide icons
document.addEventListener('DOMContentLoaded', function() {
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    // Mobile menu toggle
    const menuToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIconOpen = document.getElementById('menu-icon-open');
    const menuIconClose = document.getElementById('menu-icon-close');

    if (menuToggle && mobileMenu) {
        menuToggle.addEventListener('click', function() {
            mobileMenu.classList.toggle('active');
            menuIconOpen.style.display = mobileMenu.classList.contains('active') ? 'none' : 'block';
            menuIconClose.style.display = mobileMenu.classList.contains('active') ? 'block' : 'none';
        });
    }
});
</script>
</body>
</html>
