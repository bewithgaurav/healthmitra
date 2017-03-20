(function($){
  $(function(){

    $(" .button-collapse").sideNav({
      menuWidth: 200, // Default is 240
      edge: 'left', // Choose the horizontal origin
      closeOnClick: true,
	  draggable:true// Closes side-nav on <a> clicks, useful for Angular/Meteor
    // Choose whether you can drag to open on touch screens
    }
	 
  );
  $('.collapsible').collapsible();
  $('.scrollspy').scrollSpy();
    $('.parallax').parallax();

  }); // end of document ready
})(jQuery); // end of jQuery name space

  
    