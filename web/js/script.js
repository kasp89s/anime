$(document).ready(function(){
	var INDEX = 0;
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

	$(".add-number-order").on('click', function () {
		$('.new-number-order').toggle();
	});

	$(".add-address-order").on('click', function () {
		$('.new-address-order').toggle();
	});

	$(".add-number").click(function(){
		// var newNumber = $(".new-number.template");
		// 	newNumber.clone().removeClass("template").addClass("active").insertAfter($(".new-number").last()).find('input').val('');

		$.post(
			'/ajax/get-number-field',
			{
				_csrf: $('[name="_csrf"]').val(),
				maskedValidator: $('.new-number.template').find('input').data('plugin-inputmask')
			},
			function (response) {
				$(response).insertAfter($(".new-number").last());
			}
		);
	});

	//add address
	$(".add-address").click(function(){
		var newNumber = $(".new-address.template"),
			newAddress = newNumber.clone().removeClass("template").addClass("active").insertAfter($(".new-address").last()),
			newAddressFields = newAddress.find('input');

		newAddressFields.each(function( index ) {
			var name = $( this ).attr('name').replace("{index}", INDEX);
			$( this ).attr('name', name);
		});
		INDEX++;
	});

	$('.remove-number-block').click(function(){
		console.log('hwiehf');
		$(this).parent().removeClass("active");
	});

	$(document).on('click','.remove-number-block',function(){
		var parent =$(this).parent()
		parent.removeClass("active");
	});

	$('.remove-address-block').click(function(){
		$(this).parent().removeClass("active");
	});

	$(document).on('click','.remove-address-block',function(){
		var parent =$(this).parent()
		parent.removeClass("active");
	});

	//filter
	$('.filter li').click(function(){
        $(this).toggleClass("active");
        location.href = $(this).data('url');
	});
	$(".reset-filter").click(function(){
		$(".filter li").removeClass("active");
        location.href = $(this).data('url');
	});
	//==== Promo ======
	$('.enter-promo').click(function(){
		$(this).toggleClass("active");
		$('.promo-field').toggleClass("active");
		$('.make-order').toggle();
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

    $('ul.rating.active li').mouseover(
        function () {
            $(this).addClass('active');
            var count = $(this).prevAll("li").addClass('active').length;
            $(this).nextAll("li").removeClass('active');

            $('[name="Comment[rating]"]').val(count + 1);
        }
    );

	$('.add-wish').on('click', function () {
		var element = $(this);
		$.post(
			'/ajax/add-wish',
			{productId: element.data('id'), _csrf: $('[name="_csrf"]').val()},
			function (response) {
				element.toggleClass("active");
			},
			'json'
		);
	});

	$('.remove-favorite').on('click', function () {
		var element = $(this);
		$.post(
			'/ajax/add-wish',
			{productId: element.data('id'), _csrf: $('[name="_csrf"]').val()},
			function () {
				location.reload();
			},
			'json'
		);
	});

    $('.attribute-checked').on(
        'change',
        function () {
            var amount = parseInt($(this).data('price')),
                productPrice = parseInt($('.product-price-field').data('value'));
            $('.product-price-field').text(productPrice + amount);
        }
    );

    $('.add-product').on(
        'click',
        function () {
            var element = $(this);
            $.post(
                '/ajax/add-product',
                $('#option-form').serialize(),
                function (response) {
                    if (response.success != null) {
                        showAddProductNotification(true);
                    }
                },
                'json'
            ).fail(function () {
                    showAddProductNotification(false);
            });
        }
    );

    $('.plus, .minus').on('click', function () {
		var count = parseInt($(this).closest('.counter-block.left').find('.basket-product-quantity').val()),
			value = $(this).data('value'),
			productId = $(this).closest('.counter-block.left').find('.basket-product-quantity').data('id');

		$.post(
			'/ajax/set-basket-product-count',
			{
				_csrf: $('[name="_csrf"]').val(),
				count: count,
				value: value,
				productId: productId
			},
			function (response) {
				if (response.success != null) {
					location.reload();
				}
				if (response.error != null) {
					showError(response.error);
				}
			},
			'json'
		).fail(function () {
			alert('Произошла ошибка!');
		});
    });

	$('.remove-button-item').on('click', function () {
		var count = parseInt($(this).closest('.info-description.right').find('.basket-product-quantity').val()),
			productId = $(this).closest('.info-description.right').find('.basket-product-quantity').data('id');

		$.post(
			'/ajax/set-basket-product-count',
			{
				_csrf: $('[name="_csrf"]').val(),
				count: count,
				value: 0 - count,
				productId: productId
			},
			function (response) {
				if (response.success != null) {
					location.reload();
				}
				if (response.error != null) {
					showError(response.error);
				}
			},
			'json'
		).fail(function () {
			alert('Произошла ошибка!');
		});
	});

    $('.done-order.left').on('click', function () {
    	var shippingValue = $('.delivery-block').find('[name="shippingValue"]');

    	if (shippingValue.attr('type') !== undefined && shippingValue.val().length == 0) {
			shippingValue.next('.text-danger').text('Необходимо заполнить «Номер отделения».');
			return;
		} else {
			shippingValue.next('.text-danger').text('');
		}

        $('[action="/cabinet/order-complete"]').submit();
    });

    $('.delivery-type').find('[name="OrderProcessForm[shipping]"]').on('change', function () {
        var price = $(this).data('price-message'),
            insurance = $(this).data('insurance-message'),
            priceValue = parseInt($(this).data('price-value')),
			requiredValue = $(this).data('required-value'),
            insuranceValue = parseInt($(this).data('insurance-value')),
            totalAmount = parseInt($('.totalAmount').text()),
            info = $('.delivery-info'),
			unsetCommission = function () {
				// Вычетаем стоимость если уже была.
				var deliveryAmount = parseInt($('.delivery-commission').text()),
					totalAmount = parseInt($('.totalAmount').text());

					$('.delivery-info > .delivery-price').text('');
				if (deliveryAmount > 0) {
					$('.delivery-commission').text('—');
					$('.totalAmount').text(totalAmount - deliveryAmount);
				}
			};

        info.hide();

        // Добавляем стоимость за доставку.
        if (price.length > 0) {
			unsetCommission();
            $('.delivery-info > .delivery-price').text(price);
            $('.delivery-commission').text('+' + priceValue + ' грн');
            $('.totalAmount').text(totalAmount + priceValue);
            info.show();
        } else if (insurance.length > 0) {
			unsetCommission();
            var insuranceAmount = parseInt(totalAmount / 100 * insuranceValue);
            $('.delivery-info > .delivery-price').text(insurance);
            $('.delivery-commission').text('+' + insuranceAmount + ' грн');
            $('.totalAmount').text(totalAmount + insuranceAmount);
            info.show();
        } else if (requiredValue.length > 0) {
			unsetCommission();
			$('.delivery-info > .delivery-price')
				.html(requiredValue + ' <input type="text" class="order-input" name="shippingValue" /><div class="error text-danger"></div>');
			info.show();
        } else {
			unsetCommission();
        }
    });

	$('.payment-type').find('[name="OrderProcessForm[payment]"]').on('change', function () {
		var price = parseInt($(this).data('price')),
			feePercent = parseInt($(this).data('fee')),
		    unsetCommission = function () {
				// Вычетаем стоимость если уже была.
				var paymentAmount = parseInt($('.payment-commission').text()),
					totalAmount = parseInt($('.totalAmount').text());

				if (paymentAmount > 0) {
					$('.payment-commission').text('—');
					$('.totalAmount').text(totalAmount - paymentAmount);
				}
			};

		if (price > 0) {
			unsetCommission();
			var totalAmount = parseInt($('.totalAmount').text());
			$('.payment-commission').text('+' + price + ' грн');
			$('.totalAmount').text(totalAmount + price);
		} else if (feePercent > 0) {
			unsetCommission();
			var totalAmount = parseInt($('.totalAmount').text()),
				feeAmount = parseInt(totalAmount / 100 * feePercent);
			$('.payment-commission').text('+' + feeAmount + ' грн');
			$('.totalAmount').text(totalAmount + feeAmount);
		} else {
			unsetCommission();
		}
	});

	$('.print.right').on(
		'click',
		function () {
			var iFrame=$('<iframe id="print_frame">'); // создаем iframe в переменную
			$('body').append(iFrame); //добавляем эту переменную с iframe в наш body (в самый конец)
			var doc = $('#print_frame')[0].contentDocument || $('#print_frame')[0].contentWindow.document,
			    win = $('#print_frame')[0].contentWindow || $('#print_frame')[0];
			doc.getElementsByTagName('body')[0].innerHTML = $('.ordering-block').html();
			win.print();
		}
	);

    $('.forgot-password').on(
        'click',
        function () {
            $(this).next('.enter-row').find('.cancel.open-build-in').trigger('click');
        }
    );

    $('.registration.go, .registration.return').on(
        'click',
        function () {
            $(this).closest('.build-in-popup').find('.close.right.open-build-in').trigger('click');
        }
    );

    function showAddProductNotification ($success) {
        if ($success) {
			location.reload();
        } else {
            alert('Произошла ошибка при добавлении товара!');
        }

    }

    function showError(message) {
		alert(message);
	}
});
