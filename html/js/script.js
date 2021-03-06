$(document).ready(function(){
	$('.main-slider').slick({
		dots:true,
		arrows:false,
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1
	});



	$('.publishers .owl').owlCarousel({
		items:10,
		autoWidth:true,
		margin:20,
		center: true,
		loop:true,
	});
	$('.owl-catalog-1').owlCarousel({
		items:6,
		responsive:{
			0:{
				items:2,
			},
			550:{
				items:3,
			},
			991:{
				items:4,
			},
			1230:{
				items:6,
			}

		}
	});
	$('.random-product').owlCarousel({
		items:5,
		margin:20,
		responsive:{
			0:{
				items:2,
			},
			550:{
				items:3,
			},
			991:{
				items:4,
				margin:10,
			},
			1230:{
				items:5,
			}

		}
	});
	$('.owl-catalog-2').owlCarousel({
		items:4,
		responsive:{
			0:{
				items:1,
			},
			550:{
				items:2,
			},
			991:{
				items:3,
			},
			1230:{
				items:4,
			}
		}
	});
	// Switch List
	$('.panel').each(function(i){
		$(this).next('.switch-list').find('.list').hide();
		$(this).next('.switch-list').find($(this).find('.switch a:first-child').addClass('selected').attr('href')).show();
	});
	$('.panel .switch a').click(function(){
		$(this).addClass('selected').siblings('a').removeClass('selected');
		$(this).parents('.panel').next('.switch-list').find('.list').hide();
		$(this).parents('.panel').next('.switch-list').find($(this).attr('href')).show();
		return false;
	});
	$('.menu-button').click(function(){
		$(this).toggleClass('open');
	});
	$('.menu a').click(function(){
		if($(this).siblings('.sub-menu').length>0){
			$(this).parent('li').toggleClass('open');
			return false;
		}
	});
	$('.open-build-in').click(function(){
		$($(this).data('popup')).slideToggle(400);
		return false;
	});
	$(".detail-button").click(function(){
		$(this).toggleClass("active");
		var buttonWrapper = $(this).parent();
		buttonWrapper.siblings(".more-detail").toggleClass("active");
	});
	$(".add-number").click(function(){
		var newNumber = $(".new-number");
		if(newNumber.hasClass("active")){
			newNumber.clone().removeClass("new-number").addClass("clone").insertAfter(newNumber);
		}
		else{
			$(".new-number").addClass("active");
		}

	});

	$('.remove-number-block').click(function(){
		console.log('hwiehf');
		$(this).parent().removeClass("active");
	})
	$(document).on('click','.remove-number-block',function(){
		var parent =$(this).parent()
		parent.removeClass("active");
	});

	//add address
	$(".add-address").click(function(){
		var newNumber = $(".new-address");
		if(newNumber.hasClass("active")){
			newNumber.clone().removeClass("new-address").addClass("clone").insertAfter(newNumber);
		}
		else{
			$(".new-address").addClass("active");
		}

	});

	$('.remove-address-block').click(function(){
		$(this).parent().removeClass("active");
	})
	$(document).on('click','.remove-address-block',function(){
		var parent =$(this).parent()
		parent.removeClass("active");
	});

	//filter
	$('.filter li').click(function(){
		$(this).toggleClass("active");
	});
	$(".reset-filter").click(function(){
		$(".filter li").removeClass("active");
	});
	//==== Promo ======
	$('.enter-promo').click(function(){
		$(this).toggleClass("active");
		$('.promo-field').toggleClass("active");
	});

	//===== Radio ======
	$('.courier').change(function(){
		if($(this).prop( "checked", true )){
			$(".delivery-info").addClass("active");
		}
		else{
			$(".delivery-info").removeClass("active");
		}
	});
	$('.no-courier').change(function(){

			$(".delivery-info").removeClass("active");

	});
	//==== addComent ======
	$('.add-order-comment').click(function(){
		$(this).toggleClass("active");
		$('.order-comment').toggleClass("active");
	});

	$(".add-wish").click(function(){
		$(this).toggleClass("active");
	});

	//==== product-slider =====
	$('.big-slider-product').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		fade: true,
		asNavFor: '.nav-big-slider'
	});
	$('.nav-big-slider').slick({
		slidesToShow: 3,
		slidesToScroll: 1,
		asNavFor: '.big-slider-product',
		dots: false,
		centerMode: false,
		focusOnSelect: true,
		vertical: true,
		customPaging:'10px'
	});

	//======== modal =====



		 $('.main-product-slider .item, .big-slider-product .item').click( function(){

			 event.preventDefault();
			 $('#overlay').fadeIn(100,
				 function(){
					 $('#modal_form')
						 .css('display', 'block') //
						 .animate({opacity: 1, top: '10%'}, 100);


						 $('.modal-slide').slick({
							 dots: true,
							 arrows: false,
							 infinite: true,
							 slidesToShow: 1,
							 slidesToScroll: 1
						 });

			 });

		 });

		 $('.close, #overlay').click( function(){
			 $('#modal_form')
				 .animate({opacity: 0, top: '45%'}, 100,
					 function(){
						 $(this).css('display', 'none');
						 $('#overlay').fadeOut(100);
					 }
				 );
		 });
		 alignCenter($('#modal_form'));
		 function alignCenter(elem) {
		 elem.css({
		   left: ($(window).width() - elem.width()) / 2 + 'px',
		   top: ($(window).height() - elem.height()) / 2 + 'px'
		 })
	   }


	//login modal
	$('.password-modal').click( function(){
		event.preventDefault();
		$('#overlay').fadeIn(100,
				function(){
					$('.password-modal')
							.css('display', 'block') //
							.animate({opacity: 1}, 100);
				});

	});

	$('.enter-modal-btn').click( function(){
		event.preventDefault();
		$('#overlay').fadeIn(100,
				function(){
					$('.enter-modal')
							.css('display', 'block') //
							.animate({opacity: 1}, 100);
				});

	});



	$('.close, #overlay').click( function(){
		$('.modal')
				.animate({opacity: 0, top: '45%'}, 100,
						function(){
							$(this).css('display', 'none');
							$('#overlay').fadeOut(100);
						}
				);
	});

});
