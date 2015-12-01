To add promo images, simply drop them in this folder, rename them to promo_#.jpg, and change the following line in templates/page.tpl.php:

<img id="background-image" src="<?php echo path_to_theme() ?>/images/promo/promo_<?php echo rand(1,6); ?>.jpg" />
Change the rand(1,6) to rand(1,#), where # is one higher than the last highest number used.
