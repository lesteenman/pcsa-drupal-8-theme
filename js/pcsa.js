//Google maps stuff
function initialize() {

	var map = new google.maps.Map(document.getElementById('map-canvas'), {
		zoom: 1,
		center: new google.maps.LatLng(52.225089, 6.887767),
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		// draggable: false,
		// scrollwheel: false,
		// panControl: false,
		// disableDefaultUI: true,
	}),

		myMapsId = 'zTJMnapVaP1o.km0KB9QZ43hM';
	new google.maps
		.KmlLayer({
			map: map,
			url: 'https://www.google.com/maps/d/kml?mid=' + myMapsId
		});

	var styles = [{"featureType":"road","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"hue":149},{"saturation":-78},{"lightness":0}]},{"featureType":"road.highway","stylers":[{"hue":-31},{"saturation":-20},{"lightness":-20.8}]},{"featureType":"poi","elementType":"label","stylers":[{"visibility":"off"}]},{"featureType":"landscape","stylers":[{"hue":163},{"saturation":-26},{"lightness":20.1}]},{"featureType":"transit","stylers":[{"visibility":"off"}]},{"featureType":"water","stylers":[{"hue":2},{"saturation":100},{"lightness":-80.1}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"off" }]}];
	map.setOptions({styles: styles});
}

jQuery(document).ready(function(){    
	console.log('start');

	// Scrollbar change
	var scroll_start = jQuery('body').scrollTop();
	var offset = 300;
	
	if (location.pathname == Drupal.settings.basePath || location.pathname == '/home') {
		//Change nav on scroll
		jQuery(window).scroll(function() { 
			scroll_start = jQuery('body').scrollTop();

			if(scroll_start > offset) {
				jQuery(".navbar").addClass("navScroll");
				jQuery("#admin-menu").css("margin-top", "50px");
			} else {
				jQuery(".navbar").removeClass("navScroll");
				jQuery("#admin-menu").css("margin-top", "80px");
			}
		});
		jQuery("#admin-menu").css("margin-top", "80px");
	} else {
		jQuery(".navbar").css("transition", "none");
		jQuery(".navbar").addClass("navScroll");
		jQuery('.navbar').addClass('navbar-relative');
	}

  if (jQuery(window).scrollTop() > offset) {
    jQuery(".navbar").addClass("navScroll");
  }

	//Hide/show login form
	// jQuery("#loginlink").click(function(){
		// jQuery('#login').toggle("fast");
	// });

	jQuery(".navbar-toggle").click(function(){
		if(!jQuery(this).hasClass("collapsed")){ //If we collapse the menu
			if(jQuery('#login:visible').length == 1){ //And if login is open
				jQuery('#login').hide(0); //Hide login
			}
		}
	});

	//Adjust height if needed
	jQuery( "#main .container" ).each(function() {
		jQuerythis = jQuery( this );
		if(jQuery("#heerinfo").height() > jQuery( this ).height()){
			jQuerythis.height( jQuery("#heerinfo").height() + 200);
		}
	});

	//Only load map if on '/reizen' page
	if (jQuery("#map-canvas").length > 0) {
		google.maps.event.addDomListener(window, 'load', initialize);
	}

});
