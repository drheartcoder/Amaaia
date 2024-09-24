$( function() {
	$( "#buttonsearch" ).on( "click", function() {
		$( "#effectsearch" ).toggleClass( "newsearchshow", 1000);
	});

	var formid = $('form').attr('id');
	
	$('#'+formid).on('submit',function()
    { 
        var form = $('#'+formid);
        if(form.valid())
        {
            showProcessingOverlay();
            return true;
        }
    });

} );



var stickyNavTop = $('.header').offset().top;

var stickyNav = function() {
	var scrollTop = $(window).scrollTop();

	if (scrollTop > stickyNavTop) {
		$('.header').addClass('sticky');
	} else {
		$('.header').removeClass('sticky');
	}
};

stickyNav();

$(window).scroll(function() {
	stickyNav();
});

$( function() {
	$( ".footer_heading" ).on( "click", function() {
		$(this).toggleClass( "active");
		$(this).next( ".menu_name" ).slideToggle("slow");
		$(this).parent(".abc").siblings().find(".menu_name").slideUp();   
		$(this).parent(".abc").siblings().children().removeClass("active");
	});    
} );

function openNav() {
	document.getElementById("mySidenav").style.width = "250px";
	$("body").css({
		"margin-left": "250px",
		"overflow-x": "hidden",
		"transition": "margin-left .5s",
		"position": "fixed"
	});
	$("#main").addClass("overlay");
}
function closeNav() {
	document.getElementById("mySidenav").style.width = "0";
	$("body").css({
		"margin-left": "0px",
		"transition": "margin-left .5s",
		"position": "relative"
	});
	$("#main").removeClass("overlay");
}

$(".min-menu > li > .drop-block").click(function() {
	if (false == $(this).next().hasClass('menu-active')) {
		$('.sub-menu > ul').removeClass('menu-active');
	}
	$(this).next().toggleClass('menu-active');
	return false;
});
$("body").click(function() {
	$('.sub-menu > ul').removeClass('menu-active');
});

jQuery(document).ready(function($){
	var offset = 300,
	offset_opacity = 1200,
	scroll_top_duration = 700,
	$back_to_top = $('.cd-top');
	$(window).scroll(function(){
		( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
		if( $(this).scrollTop() > offset_opacity ) { 
			$back_to_top.addClass('cd-fade-out');
		}
	});
	$back_to_top.on('click', function(event){
		event.preventDefault();
		$('body,html').animate({
			scrollTop: 0 ,
		}, scroll_top_duration
		);
	});

});

function chk_validation(ref)
{
  var yourInput = $(ref).val();
  re = /[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
  var isSplChar = re.test(yourInput);
  if(isSplChar)
  {
    var no_spl_char = yourInput.replace(/[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
    $(ref).val(no_spl_char);
  }
}