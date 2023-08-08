<section class="hero-front container">
    <h1 class="hero-front__title galderglynn-CdRg">transformation. <br>software. <br>experts.</h1>

    <div class="hero-front__subtitle galderglynn-CdRg">A Full stack DEVELOPMENT COMPANY with focus on improving business processes</div>

    <div class="hero-front__buttons">
        <div class="hero-front__buttons__item site-btn">DEVELOP a solution</div>
        <div class="hero-front__buttons__item site-btn">hire a team</div>
        <div class="hero-front__buttons__item site-btn">future-proof processes</div>
        <div class="hero-front__buttons__item site-btn">design UI/UX</div>
        <div class="hero-front__buttons__item site-btn">check it-security</div>
        <!-- <div class="hero-front__buttons__item site-btn">support</div> -->
    </div>
</section>

<section class="marquee-front container">
    <div class="partners-title galderglynn-CdRg">partner of</div>
    <div id="marquee-fronts" class="marquee-front__content not-moving">
        <?php axiomasoft_partners_logo(); ?>
    </div>
</section>

<section class="section-page services">
    <h2 class="section-title container galderglynn-CdRg">You get</h2>

    <div class="services__content container">
        <?php axiomasoft_services_list();?>
    </div>
</section>

<section class="section-page featured container">
    <h2 class="section-title galderglynn-CdRg">Featured digitization projects</h2>
    <div class="featured__content">
        <?php axiomasoft_projects_items(6, 'cards'); ?>
    </div>
</section>

<section class="extras">
    <h2 class="section-title section-title-number container galderglynn-CdRg">
        <span class="section-title-number__text">All delivered projects</span>
        <span class="section-title-number__number">(<?php echo wp_count_posts('projects')->publish;?>)</span>
    </h2>

    <div class="extras__content container">
        <?php axiomasoft_projects_items(6, 'list'); ?>
    </div>
</section>
