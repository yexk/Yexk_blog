/**
 * 英文
 */
function __write(name)
{
	var language = {
			'yexk' : 'YEXK',
			'title' : 'Hello, my name is John Doe and I am',
			'content' : 'Full Stack Web Developer',
			'start' : 'creating modern and responsive Web Application',
			'home' : 'HOME',
			'service' : 'SERVICES',
			'works' : 'WORKS',
			'skills' : 'Skills',
			'testimonials' : 'Testimonials',
			'contact' : 'Contact',
			'company' : 'company websites:',
			'make_in_china' : 'Made with <span class="fa fa-heart fa-2x animated pulse"></span> in China',
	}
	document.write(language[name]);
}