//Google maps stuff
function initialize() {

  var map = new google.maps.Map(document.getElementById('map-canvas'), {
    zoom: 1,
    center: new google.maps.LatLng(52.225089, 6.887767),
    mapTypeId: google.maps.MapTypeId.ROADMAP
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


$(document).ready(function(){    

  // Scrollbar change
  var scroll_start = $(this).scrollTop();
  var offset = 300;

  //Change nav on scroll
  $(document).scroll(function() { 
    scroll_start = $(this).scrollTop();

    if(scroll_start > offset) {
      $(".navbar").addClass("navScroll");
      //$(".secondary").addClass("navScroll");
    } else {
      $(".navbar").removeClass("navScroll");
      //$(".secondary").removeClass("navScroll");
    }

  });

  //Hide/show login form
  $("#loginlink").click(function(){
    $('#login').toggle("fast");
  });

  $(".navbar-toggle").click(function(){
    if(!$(this).hasClass("collapsed")){ //If we collapse the menu
      if($('#login:visible').length == 1){ //And if login is open
        $('#login').hide(0); //Hide login
      }
    }
  });

  //Adjust height if needed
  $( "#main .container" ).each(function() {
    $this = $( this );
      if($("#heerinfo").height() > $( this ).height()){
        $this.height( $("#heerinfo").height() + 200);
      }
  });

  //Only load map if on Reizen page
  if ($("#map-canvas").length > 0) {
    google.maps.event.addDomListener(window, 'load', initialize);
  }

});