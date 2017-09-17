
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

var particlesEnabled = false;

window.resizeParticles = function() {
	if (!resizeParticles)
		return;

	var particles = $('#particles-features');
	particles.height($('#section-features').outerHeight());

};

$(window).resize(function(event) {
	resizeParticles();
});

window.initParticles = function() {
	particlesEnabled = true;
	resizeParticles();
	particlesJS.load('particles-header', 'config/particles_header.json');
	particlesJS.load('particles-features', 'config/particles.json');
};