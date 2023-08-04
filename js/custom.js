$(window).scroll(function () {
  if($(window).scrollTop() > 200) {
	$(".rws-header").addClass('rws-sticky');
	$('#rws-scrolltop').css('opacity', '1');	
  } else {
	$(".rws-header").removeClass('rws-sticky');
	$('#rws-scrolltop').css('opacity', '0');
  }
  
  
  if($(window).scrollTop() < 600) {
	 $('.scroll_transition').css('transform',  'translateY('+$(window).scrollTop()*1.1+'px)');
  }
    
});

AOS.init();

// Menu Code
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}

// JQuery Function Codes
(function ($) {
  
  // Owl Carousel
  $('.owl-testimonial').owlCarousel({
		loop:true,
		margin:30,
		responsiveClass:true,
		autoplay:true,
		autoplayTimeout:5000,
		autoplayHoverPause:false,
		responsive:{
			0:{
				items:1,
				nav:false
			},
			600:{
				items:2,
				nav:false
			},
			900:{
				items:3,
				nav:false,
				loop:true
			}
		}
	});
	
	$('.owl-featuredempgallery').owlCarousel({
		loop:true,
		margin:10,
		responsiveClass:true,
		autoplay:true,
		autoplayTimeout:5000,
		autoplayHoverPause:false,
		responsive:{
			0:{
				items:1,
				nav:false
			},
			600:{
				items:3,
				nav:false
			},
			900:{
				items:4,
				nav:false,
				loop:true
			}
		}
	});
	
	$('.owl-featuredempcourses').owlCarousel({
		loop:true,
		margin:30,
		responsiveClass:true,
		autoplay:true,
		autoplayTimeout:5000,
		autoplayHoverPause:false,
		responsive:{
			0:{
				items:1,
				nav:false
			},
			600:{
				items:3,
				nav:false
			},
			900:{
				items:4,
				nav:false,
				loop:true
			}
		}
	});
	
	// Owl Carousel
  $('.owl-spdealscl').owlCarousel({
		loop:true,
		margin:30,
		responsiveClass:true,
		autoplay:true,
		autoplayTimeout:5000,
		autoplayHoverPause:false,
		responsive:{
			0:{
				items:1,
				nav:false
			},
			600:{
				items:1,
				nav:false
			},
			900:{
				items:1,
				nav:false,
				loop:true
			}
		}
	});
	
	 // Owl Carousel
	  $('.owl-gallery').owlCarousel({
			loop:true,
			margin:0,
			responsiveClass:true,
			autoplay:true,
		autoplayTimeout:5000,
		autoplayHoverPause:false,
			responsive:{
				0:{
					items:1,
					nav:false
				},
				600:{
					items:2,
					nav:false
				},
				900:{
					items:3,
					nav:false,
					loop:true
				}
			}
		});
		
		// Owl Carousel
	  $('.owl-singlegallery').owlCarousel({
			loop:true,
			margin:0,
			responsiveClass:true,
			autoplay:true,
		autoplayTimeout:5000,
		autoplayHoverPause:false,
			responsive:{
				0:{
					items:1,
					nav:false
				},
				600:{
					items:1,
					nav:false
				},
				900:{
					items:1,
					nav:false,
					loop:true
				}
			}
		});
		
		// Owl Carousel
	  $('.owl-gallery2').owlCarousel({
			loop:true,
			margin:0,
			center: true,
			responsiveClass:true,
			
			responsive:{
				0:{
					items:1,
					nav:false
				},
				600:{
					items:3,
					nav:true
				},
				900:{
					items:3,
					nav:true,
					loop:true
				}
			}
		});
	
	$(".fancybox").fancybox();
	
	$(".dropdown").hover(function(){			
		var dropdownMenu = $(this).children(".dropdown-menu");			
		$(this).toggleClass("show");
		dropdownMenu.toggleClass("show");
  	});
	
	
	$(".rws-booknow h6").click(function(){
		
		var parentdiv = $(this).parent("div").parent("div");
		
		if(parentdiv.hasClass("gtrowactive"))
		{
			
		}
		else
		{
			$(".rws-showhideac").removeClass("gtrowactive");
			parentdiv.addClass("gtrowactive")
		}
  	});
	
	
})(jQuery);

function validatebookingengine1() {
	//var $v = jQuery.noConflict();
	//var country = $("#BookingEngine_ddlCountry").val();
	//var hotel = $("#token").val();
	var checkin = jQuery("#check_in").val();
	var checkout = jQuery("#check_out").val();
	

	//alert(checkin);
	//          if (country == "0") {
	//              alert("please select country");
	//              return false;
	//
	//          }
	//          else if (hotel == "0") {
	//              alert("please select hotel");
	//              return false;
	//          }

	         if (checkin == "") {
	            alert("please select check in date");
	             return false;
	         }

	          else if (checkout == "") {
	             alert("please select check out date");
	             return false;
	         }
	//          else
	//          {
	//              var location = "https://secure.staah.com/common-cgi/package/packagebooking.pl?propertyId=3356&Ln=en&checkIn="
	//
	var location = "https://secure.staah.com/common-cgi/package/packagebooking.pl?propertyId=47921&Ln=en&checkIn=" + checkin + "&checkOut=" + checkout;
	
	var location = "https://www.wyndhamhotels.com/ramada/new-delhi-india/ramada-new-delhi-pitampura/rooms-rates?brand_id=RA&checkInDate=12/28/2019&checkOutDate=12/29/2019&useWRPoints=false&children=1&childAge=0&adults=1&rooms=1";
	
	//alert(location);
	window.open(location, "_blank");

	// window.open(location, "_parent");
	//          }



	}
	
	
	
function trim (el) {

    el.value = el.value.

       replace (/(^\s*)|(\s*$)/gi, "").

       replace (/[ ]{2,}/gi," ").

       replace (/\n +/,"\n");

    return;

}

/* Employment History Multiple Creation */
$('#rwsaddposition').on("click", function() {
		var num     = $('.clonedInput').length; // how many "duplicatable" input fields we currently have
		var newNum  = new Number(num + 1);      // the numeric ID of the new input field being added
		// create the new element via clone(), and manipulate it's ID using newNum value
		var lastid = $('.clonedInput').last().attr('id');		
		var newElem = $('#' + lastid).clone().attr('id', 'nameinput' + newNum);		
		
		// insert the new element after the last "duplicatable" input field		
		$('#' + lastid).after(newElem);
		$('#nameinput' + newNum).find('input[type="text"]').val('');
		$('#nameinput' + newNum).find('textarea').val('');		
		$('#nameinput' + newNum).find('select').val('');
		$('#nameinput' + newNum).find('input[type="checkbox"]').attr('checked', false);	
		$('#nameinput' + newNum).find('input[type="radio"]').attr('checked', false);
		$('#nameinput' + newNum).find('input.gtavailability').removeClass('hasDatepicker').datepicker({ minDate: "+1D", maxDate: "+24M +10D", changeMonth: true, dateFormat: 'dd-mm-yy', changeYear: true});	
		$('#nameinput' + newNum).children(".rws-mcontent").children('.rwsdelete1').show();
		// enable the "remove" button		
		// business rule: you can only add 5 names		
		if (newNum == 15)
			$('#rwsaddposition').hide();
		});		
	
	$(document).on('click', '.rwsdeletetraining1', function() {	
		var parentdiv = $('.clonedInput').last().remove();
		var num  = $('.clonedInput').length;
		if (num<15) { $('#rwsaddposition').show(); }
		if (num<2) { $('.rwsdelete1').hide(); }
	});	
	
	$(document).on('click', '.categorysc', function() {	
		document.getElementById("gtfilterform").submit(); 
	});
	
	function update_tick_status(int_dogid, status)
	{
		document.getElementById("redirecturl").value = int_dogid;
		$('.messagetoshow').html('<div class="default-notice-landing-text-center-red-bg2"><i class="fa fa-times-circle" aria-hidden="true"></i> To update status to ' + status + ', click on Update Status button.</div>');
		
		$("#exampleModal_status").modal();
		
		
	}


	function validatepopupform()
	{
		document.location.href=document.getElementById("redirecturl").value;
		return false;	
	}
	
	jQuery(document).on('click', '.rwsjbsection', function(){
		var sectionid = jQuery(this).val();
		var gtbaseurl = document.getElementById("gtbaseurl").value;		
		jQuery.ajax({
			type: "GET",
			url: gtbaseurl+"ajaxdata/get_user_section_category.php?id=1",
			data: 	'sectionid='+sectionid+	
					"&requestfrom=frontend",							
			success: function(json){
					var obj = jQuery.parseJSON(json);						
					if(obj.proceed==0) 
					{ 
												
					} 
					else 
					{ 						
						jQuery(".rwscategorylist").html(obj.categoryhtml); 
					
					}
			}
			});
});


/*************************************
* Theme Name: Jobvivo
* Author: Themez Hub
* Version: 1.0
* Last Change: Dec 27 2017
  Author URI    : http://www.themezhub.com/
**************************************
* 01. Testimonial 1 Script
* 02. Employer Slide
* 03. Category Slide
* 04. Fast Click Select
* 05. Bootstrap wysihtml5 editor
* 06. Add field Script
**************************************/
(function($){
	"use strict";

	/*------ Testimonial 1 Script ----*/
	$('.testimonial-carousel').slick({
	  slidesToShow:2,
	  arrows: false,
	  autoplay:true,
	  responsive: [
		{
		  breakpoint: 768,
		  settings: {
			arrows: false,
			centerPadding: '0px',
			slidesToShow:2
		  }
		},
		{
		  breakpoint: 480,
		  settings: {
			arrows: false,
			centerPadding: '0px',
			slidesToShow: 1
		  }
		}
	  ]
	});
	
	/*--- Employer Slide ---*/
	$('.employer-slide').slick({
	  centerMode: true,
	  centerPadding: '0px',
	  slidesToShow: 4,
	  responsive: [
		{
		  breakpoint:1024,
		  settings: {
			arrows: false,
			centerMode: true,
			centerPadding: '0px',
			slidesToShow: 3
		  }
		},
		{
		  breakpoint: 768,
		  settings: {
			arrows: false,
			centerMode: true,
			centerPadding: '0px',
			slidesToShow: 3
		  }
		},
		{
		  breakpoint:600,
		  settings: {
			arrows: false,
			centerMode: true,
			centerPadding: '0px',
			slidesToShow:2
		  }
		},
		{
		  breakpoint: 480,
		  settings: {
			arrows: false,
			centerMode: true,
			centerPadding: '0px',
			slidesToShow: 1
		  }
		}
	  ]
	});
	
	/*---- Category Slide ---*/
	$('.category-slide').slick({
	  centerMode: true,
	  centerPadding: '60px',
	  slidesToShow: 3,
	  responsive: [
		{
		  breakpoint: 768,
		  settings: {
			arrows: false,
			centerMode: true,
			centerPadding: '40px',
			slidesToShow: 2
		  }
		},
		{
		  breakpoint: 480,
		  settings: {
			arrows: false,
			centerMode: true,
			centerPadding: '40px',
			slidesToShow: 1
		  }
		}
	  ]
	});
	
	/*----- Fast Click Select ------*/
	  $('select').niceSelect();

	/*---Bootstrap wysihtml5 editor --*/	
	//$('.textarea').wysihtml5();    
	
	/*-----Add field Script------*/
	$('.extra-field-box').each(function() {
	var $wrapp = $('.multi-box', this);
	$(".add-field", $(this)).on('click', function() {
		$('.dublicat-box:first-child', $wrapp).clone(true).appendTo($wrapp).find('input').val('').focus();
	});
	$('.dublicat-box .remove-field', $wrapp).on('click', function() {
		if ($('.dublicat-box', $wrapp).length > 1)
			$(this).parent('.dublicat-box').remove();
		});
	});
	

})(jQuery);