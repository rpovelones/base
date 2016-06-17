jQuery(document).ready(function( $ ) {

	function loadContent( pagename ) {
		var wrapper = $('#js-wrapper'),
				context = wrapper.attr('data-context'),
				url = '/wp/wp-json/base/'+context;

		if( context == 'page' ) url += '?pagename='+pagename;
		if( context == 'post' ) url += '?name='+pagename;

		$.get( url, function( data ) {
		  	
			$(data).each(function(){
				wrapper.empty();
				wrapper.append(this.html);			
			});

			wrapper.fadeIn(300);
			$('#loader').addClass('loaded');

		});
	}

	function loadPage() {
		var url = window.location.href,
				parts = url.split("/"),
				pagename = parts[parts.length - 2];;

		if( pagename == 'wp' ) {
			pagename = 'home';
		} 

		$('#js-wrapper').hide();
		loadContent(pagename);
	}

	loadPage();

});
