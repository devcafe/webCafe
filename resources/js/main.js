$(document).ready(function(){
	var content = $('#contentWrapper');

	function getParameterByName(name) {
	    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	        results = regex.exec(location.search);
	    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	}

	var page = getParameterByName('page');
	var mod = getParameterByName('mod');

	if(page == "home"){
		content.load( "home.php" );
	} else {
		content.load( "modulos/"+ mod +"/view/"+ page +".php" );
	}

})	