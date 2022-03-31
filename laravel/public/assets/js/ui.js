/************************************HIDE SEARCH FORM WHEN SCROLLING DOWN ON MOBILE ************************************/
//Important must use user agent so doesn't hide on desktops 


    var prevScrollpos = window.pageYOffset;
	window.onscroll = function() {

var currentScrollPos = window.pageYOffset;
if ($(window).width() < 480 && $(window).height() < 840) 
{
  if (prevScrollpos > currentScrollPos) 
  {
    document.getElementById("top-navbar").style.position = "relative";
    document.getElementById("top-navbar").style.top = "0";
  } else 
  {
    document.getElementById("top-navbar").style.position = "fixed";
    document.getElementById("top-navbar").style.top = "-150px";
  }
  prevScrollpos = currentScrollPos;
}
else 
{
	document.getElementById("top-navbar").style.position = "relative";
    document.getElementById("top-navbar").style.top = "0";
}
}



$(document).ready(function(){

	/************************************MAKE SIDEBARS STICK TO THE TOP********************************************/

	function posStickySupported() 
	{

		var elem = document.createElement('div');

		elem.style.cssText = 'position:sticky';

		if (elem.style.position.match('sticky')) return true;

		return false;

	}

	if (!posStickySupported()) 
	{
		sticky("#left-sidebar");
		sticky("#navigation-sidebar");

	}

	function sticky(elmnt)
	{
		var elementStuck = document.querySelector(elmnt);
		console.log('not supported');
		console.log(elementStuck);
		console.log('not found');
		var elementPosition = elementStuck.getBoundingClientRect();

		var placeholder = document.createElement('div');

		//placeholder.style.width = elementPosition.width + 'px';

		placeholder.style.height = elementPosition.height + 'px';

		var isAdded = false;
		window.addEventListener('scroll', function() 
		{
		  if ($(window).width() > 720 && $(window).height() > 840) 
			{
			if (window.pageYOffset >= elementPosition.top && !isAdded) 
			{

				elementStuck.classList.add('sticky');

				elementStuck.parentNode.insertBefore(placeholder, elementStuck);

				isAdded = true;
				document.querySelector("#tab-panes").style.marginLeft = "14rem";
				console.log("stuck");

			} else if (window.pageYOffset < elementPosition.top && isAdded) 
			{

				elementStuck.classList.remove('sticky');

				elementStuck.parentNode.removeChild(placeholder);

				isAdded = false;
				document.querySelector("#tab-panes").style.marginLeft = "1.3rem";

			}
		}

		});
	}
});
