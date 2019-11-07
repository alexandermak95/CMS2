$ = jQuery;
days = 7;
function initBanner(data){


	if(getCookie('cookie-banner')){
		return;
	}
	if(!data.text){
		return
	}

	if(data.days){
		days = data.days
	}


	var html = "<div class='cookie-banner'>";

			html += "<div class='inner'><span class='close'></span>";
			html += "<div class='text'>"+data.text;
			html += "<div class='link'><a href='"+data.link.link_url+"'>"+data.link.link_title+"</a></div>";


	html +="</div></div></div></div>";
	$('body').append(html);
}



function setCookie(name, value, days) {
	var expires = "";
	if (days) {
		var date = new Date();
		date.setTime(date.getTime() + (days*24*60*60*1000));
		expires = "; expires=" + date.toUTCString();
	}
	document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}
function getCookie(cname) {
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for(var i = 0; i < ca.length; i++) {
	  var c = ca[i];
	  while (c.charAt(0) == ' ') {
		c = c.substring(1);
	  }
	  if (c.indexOf(name) == 0) {
		return c.substring(name.length, c.length);
	  }
	}
	return "";
}

$( document ).ready(function() {
    $('.cookie-banner .close').click(function(){
		setCookie('cookie-banner', 'active', days );
		$('.cookie-banner').slideUp(400);
	});

	$('.cookie-banner .link').click(function(){
		setCookie('cookie-banner', 'active', days );
		$('.cookie-banner').slideUp(400);
	})
	console.log(days);
});
