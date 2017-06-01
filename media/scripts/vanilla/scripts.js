// Toggle mobile navigation.
var navigationTrigger = document.querySelector('#js-menu-toggle');
navigationTrigger && navigationTrigger.addEventListener('click', function(e) {
	e.preventDefault();

	document.querySelector('.hamburger').classList.toggle('hamburger--active');

	var nav = document.querySelector('.navigation__list').classList;
	var overlay = document.querySelector('.navigation__overlay').classList;

	overlay.toggle( 'navigation__overlay--active');
	nav.toggle( 'navigation__list--active' );


	return false;
});

var parent_link = document.querySelectorAll('.navigation__link--not-clickable');
var count_parent_link = parent_link.length;

for( var i = 0; i < count_parent_link; i++ ) {

	parent_link[i].addEventListener("click", function( e ) {
		e.preventDefault();
	});
}

var figure = document.querySelectorAll('figure');
var figureCount = figure.length;
var body = document.querySelector("body");

console.log(figure);

for (var  f = 0; f < figureCount; f++ ) {

	figure[f].querySelector("img").addEventListener("click", function() {

		showLightbox( this.parentElement );

	});

}

var lightbox = document.createElement("div");
lightbox.classList.add("lightbox");

body.appendChild( lightbox );

lightbox.addEventListener("click", function() {
	var div = lightbox.querySelector("div");

	lightbox.removeChild( div );

	lightbox.classList.remove("lightbox--visible");
});

function showLightbox( figure ) {

	var figureImage = figure.querySelector("img");
	var figCaption = figure.querySelector("figcaption");

	var imgContainer = document.createElement("div");
	imgContainer.classList.add("lightbox__img-container");

	var img = document.createElement("img");
	img.classList.add("lightbox__img");
	img.src = figureImage.src;

	imgContainer.appendChild( img );

	if ( figCaption ) {

		var caption = document.createElement("p");
		caption.innerHTML = figCaption.innerHTML;
		caption.classList.add("lightbox__caption");

		imgContainer.appendChild(caption);

	}

	lightbox.appendChild(imgContainer);
	lightbox.classList.add("lightbox--visible");
}

(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));