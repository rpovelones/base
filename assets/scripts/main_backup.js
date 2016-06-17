jQuery(function($) {

	function loadContent( pagename ) {
		var wrapper = $('#js-wrapper'),
			pageTitle = '',
			pageContent = '',
			pageUrl = window.location.href,
			context = wrapper.attr('data-context'),
			url = '/wp/wp-json/base/'+context;

		if( context == 'page' ) url += '?pagename='+pagename;
		if( context == 'post' ) url += '?name='+pagename;

		$.get( url, function( data ) {
		  	
			$(data).each(function(){
				pageTitle = this.pageTitle;
				pageContent = this.html;

				wrapper.fadeOut(200, function() {
					wrapper.empty();
					wrapper.append(pageContent);
				}).fadeIn(200);
				
			});

			document.title = pageTitle;
	    	window.history.pushState({"html":pageContent,"pageTitle":pageTitle},"", pagename);

	    	window.onpopstate = function(e){
			    if(e.state){
			    	wrapper.fadeOut(200, function() {
			    		wrapper.empty();
				        wrapper.append(e.state.html);
				        document.title = e.state.pageTitle;
			    	}).fadeIn(200);

			    }
			};
		});
		
	}

	$(window).on('load', function() {
		var url = window.location.href,
			parts = url.split("/"),
			pagename = parts[parts.length - 2];;

		loadContent(pagename);
	});

	$('#main-menu li > a').click(function(e){
		e.preventDefault();
		var url = $(this).attr('href'),
			parts = url.split("/"),
			pagename = parts[parts.length - 2];;

		loadContent(pagename);
	})


});

// http://stackoverflow.com/questions/824349/modify-the-url-without-reloading-the-page/3354511#3354511
// function processAjaxData(response, urlPath){
//      document.getElementById("content").innerHTML = response.html;
//      document.title = response.pageTitle;
//      window.history.pushState({"html":response.html,"pageTitle":response.pageTitle},"", urlPath);
//  }
// You can then use window.onpopstate to detect the back/forward button navigation:
// window.onpopstate = function(e){
//     if(e.state){
//         document.getElementById("content").innerHTML = e.state.html;
//         document.title = e.state.pageTitle;
//     }
// };