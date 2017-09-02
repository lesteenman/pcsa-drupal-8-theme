var transition_time = 16000;
var transition_duration = 2500;

var theme_image_root = Drupal.settings.image_root;
console.log('Image root:', theme_image_root, Drupal.settings);

var urls = {
	'small': [ // 640
		"https://farm8.staticflickr.com/7441/8731624016_31cdcd479a_z_d.jpg",
		"https://farm4.staticflickr.com/3072/3107540308_abb51305e1_z_d.jpg",
		"https://farm3.staticflickr.com/2446/4031332857_33e846d70f_z_d.jpg",
		"https://farm2.staticflickr.com/1263/1453503542_ccafba5687_z_d.jpg",
		// "https://farm8.staticflickr.com/7460/8731776008_720c223802_z_d.jpg",
		"https://farm2.staticflickr.com/1149/1433774588_2d9dae328a_z_d.jpg",
		// theme_image_root + "/end_of_summer.jpg",
	],
	'medium': [ // 1024
		"https://farm8.staticflickr.com/7441/8731624016_31cdcd479a_b_d.jpg",
		"https://farm4.staticflickr.com/3072/3107540308_abb51305e1_b_d.jpg",
		"https://farm3.staticflickr.com/2446/4031332857_33e846d70f_b_d.jpg",
		"https://farm2.staticflickr.com/1263/1453503542_ccafba5687_b_d.jpg",
		// theme_image_root + "/end_of_summer.jpg",
	],
};

function preload(images) {
	for (i = 0; i < images.length; i++) {
		var img = new Image()
		img.src = images[i]
	}
}

function getImageUrls(size) {
	windowSize = document.body.clientWidth;

	if (windowSize <= 640) var size = 'small';
	else size = 'medium';

	return urls[size];
}

var current_header_image;
var imageSize = '';
updateHeaderImageSize = function(animated) {
	var newSize = document.body.clientWidth < 640 ? 'medium' : 'large';
	if (newSize != imageSize) {
		imageSize = newSize;
		header_images = getImageUrls(imageSize);
		preload(header_images);

		current_header_image = Math.floor(Math.random() * header_images.length);

		if (animated) nextHeaderImage();
		else setHeaderImage(2, current_header_image);
	}
};

nextHeaderImage = function() {
	setHeaderImage(1, current_header_image);
	current_header_image = (current_header_image + 1) % header_images.length;

	jQuery('#header #header-image-2').css('transition', 'none');
	jQuery('#header #header-image-2').css('opacity', 0);
	setHeaderImage(2, current_header_image);
	setTimeout(function() {
		jQuery('#header #header-image-2').css('transition', 'opacity ' + transition_duration + 'ms ease');
		jQuery('#header #header-image-2').css('opacity', 1);
	});
};

setHeaderImage = function(header, image) {
	console.log('setHeaderImage', header, image, header_images[image]);
	jQuery('#header #header-image-' + header).css('background-image', 'url(' + header_images[image] + ')');
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


