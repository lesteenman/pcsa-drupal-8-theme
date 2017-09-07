<?php
/*
 * Available vars:
 * - $description: Contains the description of the FlickrGallery module you
 *   provided at the settings page.
 * - $albums: An Array that contains the image and titles with links.
 */
?>
<div id='flickrgallery'>
  <div id='flickrgallery-description'><?php print $description; ?></div>
  <div id='flickrgallery-albums'>
    <?php foreach ($albums as $key => $album) : ?>
	    <?php dpm($album, $key); ?>
		  <div class='flickr-album' style="background-image: url(<?=$album['cover_image']?>)">
        <a class='flickr-overlay' href='<?=$album['link']?>'>
          <div class='flickr-title'>
            <?=$album['title']?>
          </div>
        </a>
		  </div>
    <?php endforeach; ?>
  </div>
</div>

