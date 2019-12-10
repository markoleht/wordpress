jQuery(window).load(function() {
	var transition_effect = freesiaempire_slider_value.transition_effect;
	var transition_delay = freesiaempire_slider_value.transition_delay;
	var transition_duration = freesiaempire_slider_value.transition_duration;
	jQuery('.layer-slider').cycle({ 
		timeout: transition_delay,
		fx: transition_effect,
		activePagerClass: 'active',
		pager: '.slider-button',	
		pause: 1,
		pauseOnPagerHover: 1,
		width: '100%',
		containerResize: 0, 
		fit: 1,
		next: '#next2', 
		prev: '#prev2' ,
		speed: transition_duration,
		after: function ()	{
					jQuery(this).parent().css("height", jQuery(this).height());
				},
	   cleartypeNoBg: true,
	});
});