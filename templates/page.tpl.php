<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */
?>

    <?php if ($main_menu || $secondary_menu): ?>
      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">

          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
            </button>
            <?php if ($site_name): ?>
              <a class="navbar-brand" href="/"><?php print $site_name; ?></a>
            <?php endif; ?>
          </div>

          <!-- display the navigation items, load them from the selected main_menu in drupal -->
          <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
            <div id='main-menu-mobile'>
            <?php
              $logged_in_menu = menu_navigation_links('menu-logged-in-menu');
              $combined = array_merge($main_menu, $logged_in_menu);
              print theme('links__system_main_menu', array('links' => $combined, 'attributes' => array('class' => array('nav navbar-nav'))));
            ?>
            </div>
            <div id='main-menu-desktop'>
            <?php
            print theme('links__system_main_menu', array('links' => $main_menu, 'attributes' => array('class' => array('nav navbar-nav'))));
            ?>
            </div>
          </div>

        </div>
      </nav>
    <?php endif; ?> <!-- $main_menu, $secondary_menu -->

<div id="page-wrapper" class="<?php if ($is_admin): ?>admin-user<?php endif ?>">
  <div id="page">

    <?php if (drupal_is_front_page()): ?>
        <section id="header">
          <div id="header-image-1" class='header-image'></div>
          <div id="header-image-2" class='header-image'></div>
          <div id="header-image-preload" class='header-image'></div>
          <div class="container">
            <img src="/<?php echo path_to_theme() ?>/images/wapen-nieuw.png" alt="Logo" class="img-responsive" nopin="nopin"/>
            <h1 class='frontpage-title'>Heerendispuut P.C.S.A. Incognito</h1>
          </div>
        </section>
    <?php endif ?>

	<?php print render($page['top_menu']); ?>

	<div id="main-wrapper">
      <section class="row clearfix">
        <!-- <div class="container"> -->

          <!-- highlighted -->
          <?php if ($page['highlighted']): ?>
            <div id="highlighted"><?php print render($page['highlighted']); ?></div>
          <?php endif; ?>

          <!-- link? -->
          <a id="main-content"></a>

          <!-- title -->
          <?php print render($title_prefix); ?>
          <?php if ($title): ?>
            <div class="main-title">
              <div class="container">
                <h1 class="title" id="page-title"><?php print $title; ?></h1>
              </div>
            </div>
          <?php endif; ?>
          <?php print render($title_suffix); ?>

          <?php print render($page['help']); ?>

          <!-- action links -->
          <?php if ($action_links): ?>
            <ul class="action-links"><?php print render($action_links); ?></ul>
          <?php endif; ?>

          <!-- content -->
          <?php print render($page['content']); ?>

          <!-- tabs -->
          <?php if ($tabs): ?>
            <div class="tabs"><?php print render($tabs); ?></div>
          <?php endif; ?>

          <?php print $feed_icons; ?>
        <!-- </div> -->
      </section>
    </div>

	
    <!--<?php if ($breadcrumb): ?><div id="breadcrumb" class="col-md-12">
	 <?php print $breadcrumb; ?>
	</div><?php endif; ?>-->
	
	<!--<?php if ($messages): ?><div class="col-md-12">
    <?php print $messages; ?>
	</div><?php endif; ?>-->
	
      <!-- <div id="content" class="column <?php echo $contentclass; ?>">
        <div class="section">

          
        </div>
      </div> -->

      <!--<?php if ($page['sidebar_first'] ?? false): ?>
        <div id="sidebar-first" class="column sidebar col-sm-3 <?php echo $firstsidebarpush; ?>"><div class="section">
          <?php print render($page['sidebar_first']); ?>
        </div></div>
      <?php endif; ?>-->

      <!--<?php if ($page['sidebar_second'] ?? false): ?>
        <div id="sidebar-second" class="column sidebar col-sm-3"><div class="section">
          <?php print render($page['sidebar_second']); ?>
        </div></div>
      <?php endif; ?>-->

    <!-- </div></div> --> <!-- /#main, /#main-wrapper -->

	<section id="footer">
	  <div class="container">
		<?php print render($page['footer']); ?>
	  </div>
	</section> <!-- /.section, /#footer -->

  </div> <!-- /#page -->
</div> <!-- /#page-wrapper -->
