var transition_time = 10000;
var transition_duration = 2500;
var preload_duration = 750;

var theme_image_root = Drupal.settings.image_root;
console.log('Image root:', theme_image_root, Drupal.settings);

var urls = [
	{
		// Original: https://www.flickr.com/photos/pcsa-incognito/8731624016/in/album-72157633476703042/
		"preload": "https://farm8.staticflickr.com/7441/8731624016_31cdcd479a_m_d.jpg",
		"small": "https://farm8.staticflickr.com/7441/8731624016_31cdcd479a_z_d.jpg",
		"large": "https://farm8.staticflickr.com/7441/8731624016_31cdcd479a_b_d.jpg",
	},
	{
		"preload": "https://farm4.staticflickr.com/3072/3107540308_abb51305e1_m_d.jpg",
		"small": "https://farm4.staticflickr.com/3072/3107540308_abb51305e1_z_d.jpg",
		"large": "https://farm4.staticflickr.com/3072/3107540308_abb51305e1_b_d.jpg",
	},
	{
		// Original: https://www.flickr.com/photos/pcsa-incognito/4031332857/in/album-72157622507239469/
		"preload": "https://farm3.staticflickr.com/2446/4031332857_33e846d70f_m_d.jpg",
		"small": "https://farm3.staticflickr.com/2446/4031332857_33e846d70f_z_d.jpg",
		"large": "https://farm3.staticflickr.com/2446/4031332857_33e846d70f_b_d.jpg",
	},
	{
		"preload": "https://farm2.staticflickr.com/1263/1453503542_ccafba5687_m_d.jpg",
		"small": "https://farm2.staticflickr.com/1263/1453503542_ccafba5687_z_d.jpg",
		"large": "https://farm2.staticflickr.com/1263/1453503542_ccafba5687_b_d.jpg",
	},
];

var loadCounter = 0;
function preload(images, size) {
	for (i = 0; i < images.length; i++) {
		var img = new Image();
		img.src = images[i][size];
		jQuery(img).on('load', function() {
			loadCounter--;
			if (loadCounter == 0) {
				hidePreload();
			}
		});
		loadCounter++;
	}
}

var current_header_image;
var imageSize = '';
updateHeaderImageSize = function(animated) {
	var newSize = document.body.clientWidth < 640 ? 'medium' : 'large';
	if (newSize != imageSize) {
		imageSize = newSize;

		current_header_image = Math.floor(Math.random() * urls.length);
		setPreloadImage(current_header_image);

		preload(urls, imageSize);

		if (animated) nextHeaderImage();
		else setHeaderImage(2, current_header_image);
	}
};

nextHeaderImage = function() {
	setHeaderImage(1, current_header_image);
	current_header_image = (current_header_image + 1) % urls.length;

	setTimeout(function() {
		jQuery('#header #header-image-2').css('transition', 'none');
		jQuery('#header #header-image-2').css('opacity', 0);
		setHeaderImage(2, current_header_image);
		setTimeout(function() {
			jQuery('#header #header-image-2').css('transition', 'opacity ' + transition_duration + 'ms ease');
			jQuery('#header #header-image-2').css('opacity', 1);
		}, 150);
	});
};

hidePreload = function() {
	console.log('hiding preload image');
	jQuery('#header #header-image-preload').css('transition', 'opacity ' + preload_duration + 'ms ease');
	jQuery('#header #header-image-preload').css('opacity', 0);
}

setPreloadImage = function(image) {
	// console.log('setPreloadImage', image, urls[image].preload);
	jQuery('#header #header-image-preload').css('background-image', 'url(' + urls[image].preload + ')');
}

setHeaderImage = function(header, image) {
	// console.log('setHeaderImage', header, image, urls[image][imageSize]);

	// Try preferred width first, else fallback to either large or small
	image = urls[image][imageSize];
	if (!image) image = urls[image].large;
	if (!image) image = urls[image].small;

	jQuery('#header #header-image-' + header).css('background-image', 'url(' + image + ')');
};

setInterval(function() {
	nextHeaderImage();
}, transition_time);

jQuery(document).ready(function() {
	jQuery(window).resize(function() {
		updateHeaderImageSize(true);
	});
	updateHeaderImageSize(false);
});


