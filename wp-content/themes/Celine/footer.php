<!--FOOTER-->



<div id="footerWrapper">



	<footer id="footer">



        <ul id="socialMedia">



        	<li><span>CONNECT WITH CELINE</span></li>



        	<li><a id="fb" href="https://www.facebook.com/pages/CLN/141662582646965"></a></li>



        	<li><a id="tweet" href="https://twitter.com/CLNph"></a></li>



            <li><a id="instagram" href="http://instagram.com/clnph"></a></li>



        </ul>



        <ul id="copyright">



        	<li><span>Copyright &copy;2012.All Rights Reserved.</span></li>



            <li><a href="<?php bloginfo('url')?>/">HOME</a></li>



            <li><a href="<?php bloginfo('url')?>/terms-and-conditions">TERMS AND CONDITION</a></li>



            <li><a href="<?php bloginfo('url')?>/privacy-policy">PRIVACY POLICY</a></li>



        </ul>



    </footer>



	<div class="clr"></div>



</div>



<script type="text/javascript">



/*



* Author:      Marco Kuiper (http://www.marcofolio.net/)



*/



// Speed of the automatic slideshow



var slideshowSpeed = 7000;







// Variable to store the images we need to set as background







// which also includes some text and url's.











var photos = [ {







		"title" : "",



		"image" : "slideshow01.jpg",



		"url" : "",



		"firstline" : "",



		"secondline" : ""





		}, {











		"title" : "",



		"image" : "womens.jpg",



		"url" : "http://cln.com.ph/events/",



		"firstline" : "",



		"secondline" : "<span id='clnpromo'></span>"

		

		

		

		

		}, {











		"title" : "",



		"image" : "cln-women.jpg",



		"url" : "http://cln.com.ph/whats-new/",



		"firstline" : "",



		"secondline" : "<span id='clnpromo'></span>"



		



	







	



	}, {











		"title" : "",



		"image" : "slideshow02.jpg",



		"url" : "",



		"firstline" : "",



		"secondline" : ""



		



	}, {







		"title" : "",



		"image" : "slideshow05.jpg",



		"url" : "",



		"firstline" : "",



		"secondline" : ""



	}, {







		"title" : "",



		"image" : "slideshow06.jpg",



		"url" : "",



		"firstline" : "",



		"secondline" : ""



		



	}, {







		"title" : "",



		"image" : "slideshow07.jpg",



		"url" : "",



		"firstline" : "",



		"secondline" : ""



	}, {







		"title" : "",



		"image" : "slideshow08.jpg",



		"url" : "",



		"firstline" : "",



		"secondline" : ""







	}, {







		"title" : "",



		"image" : "slideshow09.jpg",



		"url" : "",



		"firstline" : "",



		"secondline" : ""



	}, {







		"title" : "",



		"image" : "slideshow10.jpg",



		"url" : "",



		"firstline" : "",



		"secondline" : ""











	}







];







$(document).ready(function() {







	// Backwards navigation















	$("#back").click(function() {



		stopAnimation();



		navigate("back");



	});







	// Forward navigation







	$("#next").click(function() {



		stopAnimation();



		navigate("next");



	});











	var interval;



	$("#control").toggle(function(){



		stopAnimation();



	}, function() {



		// Change the background image to "pause"



		$(this).css({ "background-image" : "url(images/btn_pause.png)" });



		// Show the next image



		navigate("next");



		// Start playing the animation







		interval = setInterval(function() {



			navigate("next");



		}, slideshowSpeed);



	});



	var activeContainer = 1;	



	var currentImg = 0;



	var animating = false;



	var navigate = function(direction) {



		// Check if no animation is running. If it is, prevent the action







		if(animating) {







			return;







		}







		// Check which current image we need to show















		if(direction == "next") {















			currentImg++;















			if(currentImg == photos.length + 1) {















				currentImg = 1;







			}







		} else {







			currentImg--;















			if(currentImg == 0) {















				currentImg = photos.length;







			}







		}







		// Check which container we need to use















		var currentContainer = activeContainer;















		if(activeContainer == 1) {















			activeContainer = 2;















		} else {







			activeContainer = 1;







		}







		showImage(photos[currentImg - 1], currentContainer, activeContainer);







	};







	var currentZindex = -1;















	var showImage = function(photoObject, currentContainer, activeContainer) {















		animating = true;







		// Make sure the new container is always on the background







		currentZindex--;







		// Set the background image of the new active container















		$("#headerimg" + activeContainer).css({







			"background-image" : "url(<?= get_template_directory_uri(); ?>/images/" + photoObject.image + ")",







			"display" : "block",







			"z-index" : currentZindex







		});







		// Hide the header text







		$("#headertxt").css({"display" : "none"});







		// Set the new header text







		if( photoObject.image  == 'memorata.jpg' ){



			$("#firstline").addClass('condline');



		} else {



			$("#firstline").removeClass('condline');



		}







		$("#firstline").html(photoObject.firstline);







		$("#secondline")







			.attr("href", photoObject.url)







			.html(photoObject.secondline);











		$("#pictureduri")







			.attr("href", photoObject.url)







			.html(photoObject.title);







		// Fade out the current container







		// and display the header text when animation is complete







		$("#headerimg" + currentContainer).fadeOut(function() {







			setTimeout(function() {







				$("#headertxt").css({"display" : "block"});







				animating = false;







			}, 500);







		});







	};







	/*$(".formInfo").tooltip({tooltipcontentclass:"mycontent",fade: 100});







*/







	var stopAnimation = function() {















		// Change the background image to "play"















		$("#control").css({ "background-image" : "url(images/btn_play.png)" });







		// Clear the interval







		clearInterval(interval);







	};







	// We should statically set the first image



	navigate("next");



	// Start playing the animation







	interval = setInterval(function() {



		navigate("next");



	}, slideshowSpeed);







});















</script>







<script type="text/javascript">







$(document).ready(function(){







    jQuery('.changeImage').click(function(){







        var rel = $(this).attr('rel');







		$('.items img').fadeIn(3000);







		$('.items').hide();







		$('#item'+rel).show();







        //$("#imageBox").html("<img src='" + rel + "' />");







    })







});















</script>















<!--END-->