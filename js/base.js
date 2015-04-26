/*jslint sloppy: true, vars: true, white: true, maxerr: 50, indent: 4 */
function slideSwitch() 
{
	/* 
	*
	* Slideshow adaptado a partir del original de Jon Raasch
	* http://jonraasch.com/blog/a-simple-jquery-slideshow 
	* 
	*/
	var $active = $('#galeria img.active');
	if ($active.length === 0) { $active = $('#galeria img:last'); }
	var $next =  $active.next().length ? $active.next() : $('#galeria img:first');
	
	$active.addClass('last-active');

	$next.css( {opacity: 0.0} )
		.addClass('active')
		.animate({opacity: 1.0}, 1000, function() {
			$active.removeClass('active last-active');
		});
}

function init ()
{
    var intervaloGaleria = setInterval( slideSwitch, 3000 );
}

$(document).ready(function () 
{
    init();

    if(!Modernizr.input.placeholder)
    {

		$('[placeholder]').focus(function() {
		  var input = $(this);
		  if (input.val() == input.attr('placeholder')) 
		  {
			input.val('');
			input.removeClass('placeholder');
		  }
		}).blur(function() {
		  var input = $(this);
		  if (input.val() == '' || input.val() == input.attr('placeholder')) {
			input.addClass('placeholder');
			input.val(input.attr('placeholder'));
		  }
		}).blur();

		$('[placeholder]').parents('form').submit(function() {
		  $(this).find('[placeholder]').each(function() {
			var input = $(this);
			if (input.val() == input.attr('placeholder')) {
			  input.val('');
			}
		  })
		});

	}

});

