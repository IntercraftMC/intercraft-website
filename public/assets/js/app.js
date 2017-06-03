var particlesEnabled = false;

var resizeParticles = function() {
	if (!resizeParticles)
		return;

	var particles = $('#particles-features');
	particles.height($('#section-features').outerHeight());

};

$(window).resize(function(event) {
	resizeParticles();
});

var initParticles = function() {
	particlesEnabled = true;
	resizeParticles();
	particlesJS.load('particles-header', 'assets/config/particles_header.json');
	particlesJS.load('particles-features', 'assets/config/particles.json');
};