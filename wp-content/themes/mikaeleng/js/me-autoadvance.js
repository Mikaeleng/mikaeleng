$(window).load(function(){

	// The window.load event guarantees that
	// all the images are loaded before the
	// auto-advance begins.

	var timeOut = null;
	var t;
	var timer_is_on=0;
	
	function timedCount()
	{
		t=setTimeout("timedCount()",2000);
	}
	
	function doTimer()
	{
	//if (!timer_is_on)
	//  {
	  timer_is_on=1;
	  timedCount();
	//  }
	}
	
	function stopCount()
	{
	clearTimeout(t);
	timer_is_on=0;
	var r = setTimeout(restart, 1000);
		function restart(){
			timedCount();
		}
	}

	$('#slideshow .arrow').click(function(e,simulated){

		// The simulated parameter is set by the
		// trigger method.

		if(!simulated){

			// A real click occured. Cancel the
			// auto advance animation.

			//clearTimeout(timeOut);
			stopCount();		
		}
	});
	
	// A self executing named function expression:

	(function autoAdvance(){

		// Simulating a click on the next arrow.
		$('#slideshow .next').trigger('click',[true]);

		// Schedulling a time out in 5 seconds.
		//timeOut = setTimeout(autoAdvance,2000);
		doTimer();
	})();

});