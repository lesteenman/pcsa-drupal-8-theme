<?php
/**
* @file
* Returns the HTML for a single Drupal page.
*
* Complete documentation for this file is available online.
* @see https://drupal.org/node/1728148
*/
?>

<nav id="navigation" class="container<?php echo drupal_is_front_page() ? ' frontpage' : ''; ?>">
    <div id="navbar">
        <a href="/">
            <h1><?php print $site_name; ?></h1>
        </a>
        <div id='menu-button'></div>
    </div>
    <?php print render($page['header']); ?>
</nav>

<?php if (drupal_is_front_page()) : ?>
    <div id="intro-wrapper">
        <section id="intro">
            <div id="intro-inner">
                <div id="background-wrapper">
                    <div id="background-overlay"></div>
                    <?php srand(date('Ymdh')); // New image every hour ?>
                    <img id="background-image" src="<?php echo path_to_theme() ?>/images/promo/promo_<?php echo rand(1,6); ?>.jpg" />
                </div>
                <img id="wapen"/src="<?php echo path_to_theme() ?>/images/wapen-nieuw.png"/>
                <h2>Heerendispuut P.C.S.A. Incognito</h2>
            </div>
        </section>
    </div>
<?php endif ?>

<div id="page">

    <?php if (drupal_is_front_page()) : ?>

        <?php if (user_is_anonymous()) :?>
            <section id="welkom">
                <div class="container">
                    <h3>Welkom</h3>
                    <span>
                        Welkom op de website van Heerendispuut P.C.S.A. Incognito: het eerste, oudste, voornaemste en tevens rijckste dispuut van Europese studentenvereniging AEGEE-Enschede. Primum Collegium Societatis AEGEE-Enschede Incognito is op 26 augustus 1991 opgericht vanuit de gedachte en het streven om de kennis en ervaring verzameld binnen AEGEE niet verloren te laten gaan, maar om deze vast te houden en door te geven middels een dispuut.
                    </span>
                    <br /><a href="/geschiedenis" class="button">Geschiedenis</a>
                </div>
            </section>
            <section id="nieuws" class="content">
                <?php print render($page['frontpage_news']); ?>
            </section>
        <?php else : ?>
            <section id="new_activity" class="content">
                <?php print render($page['frontpage_updates']); ?>
            </section>
        <?php endif ?>

    <?php else : ?>
    <div id="content" class="column" role="main">
        <?php print render($page['highlighted']); ?>
        <?php print render($title_prefix); ?>
        <?php if ($title): ?>
            <h1 class="page__title title" id="page-title"><?php print $title; ?></h1>
        <?php endif; ?>
        <?php print render($title_suffix); ?>
        <?php print $messages; ?>
        <?php print render($tabs); ?>
        <?php print render($page['help']); ?>
        <?php if ($action_links): ?>
        <ul class="action-links"><?php print render($action_links); ?></ul>
        <?php endif; ?>
        <section class="content">
            <?php print render($page['content']); ?>
        </section>
    </div>
    <?php endif; ?>

    <section>
        <?php print render($page['bottom']); ?>
    </section>

    <section id="footer">
        Copyright &copy; 1991-<?php echo date("Y"); ?> Heerendispuut P.C.S.A. Incognito. Alle rechten voorbehouden.
        <?php print render($page['footer']); ?>
    </section>



</div>
