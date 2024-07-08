(function($) {
	"use strict"

	// Mobile Nav toggle
	$('.menu-toggle > a').on('click', function (e) {
		e.preventDefault();
		$('#responsive-nav').toggleClass('active');
	})

	// Fix cart dropdown from closing
	$('.cart-dropdown').on('click', function (e) {
		e.stopPropagation();
	});

	/////////////////////////////////////////

	// Products Slick
	$('.products-slick').each(function() {
		var $this = $(this),
				$nav = $this.attr('data-nav');

		$this.slick({
			slidesToShow: 4,
			slidesToScroll: 1,
			autoplay: true,
			infinite: true,
			speed: 300,
			dots: false,
			arrows: true,
			appendArrows: $nav ? $nav : false,
			responsive: [{
	        breakpoint: 991,
	        settings: {
	          slidesToShow: 2,
	          slidesToScroll: 1,
	        }
	      },
	      {
	        breakpoint: 480,
	        settings: {
	          slidesToShow: 1,
	          slidesToScroll: 1,
	        }
	      },
	    ]
		});
	});

	// Products Widget Slick
	$('.products-widget-slick').each(function() {
		var $this = $(this),
				$nav = $this.attr('data-nav');

		$this.slick({
			infinite: true,
			autoplay: true,
			speed: 300,
			dots: false,
			arrows: true,
			appendArrows: $nav ? $nav : false,
		});
	});

	/////////////////////////////////////////

	// Product Main img Slick
	$('#product-main-img').slick({
    infinite: true,
    speed: 300,
    dots: false,
    arrows: true,
    fade: true,
    asNavFor: '#product-imgs',
  });

	// Product imgs Slick
  $('#product-imgs').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    centerMode: true,
    focusOnSelect: true,
		centerPadding: 0,
		vertical: true,
    asNavFor: '#product-main-img',
		responsive: [{
        breakpoint: 991,
        settings: {
					vertical: false,
					arrows: false,
					dots: true,
        }
      },
    ]
  });

	// Product img zoom
	var zoomMainProduct = document.getElementById('product-main-img');
	if (zoomMainProduct) {
		$('#product-main-img .product-preview').zoom();
	}

	/////////////////////////////////////////

	// Input number
	$('.input-number').each(function() {
		var $this = $(this),
		$input = $this.find('input[type="number"]'),
		up = $this.find('.qty-up-store'),
		down = $this.find('.qty-down-store');

		down.on('click', function () {
			var value = parseInt($input.val()) - 1000000 ;
			value = value < 1 ? 1 : value;
			value = value.toFixed(0);
			// console.log(value);
			$input.val( value);
			$input.change();
			updatePriceSlider($this , value)
		})

		up.on('click', function () {
			var value = parseInt($input.val()) + 1000000 ;
			value = value.toFixed(0);

			$input.val(value);
			$input.change();
			updatePriceSlider($this , value)
		})
	});
	

	var priceInputMax = document.getElementById('price-max'),
			priceInputMin = document.getElementById('price-min');

	// priceInputMax.addEventListener('change', function(){
	// 	updatePriceSlider($(this).parent() , this.value)
	// });

	// priceInputMin.addEventListener('change', function(){
	// 	updatePriceSlider($(this).parent() , this.value)
	// });

	function updatePriceSlider(elem , value) {
		if ( elem.hasClass('price-min') ) {
			console.log('min')
			priceSlider.noUiSlider.set([value, null]);
		} else if ( elem.hasClass('price-max')) {
			console.log('max')
			priceSlider.noUiSlider.set([null, value]);
		}
	}

	// Price Slider
	var priceSlider = document.getElementById('price-slider');
	if (priceSlider) {
		noUiSlider.create(priceSlider, {
			start: [1000000, 50000000],
			connect: true,
			step: 1000000,
			range: {
				'min': 1000000,
				'max': 50000000
			}
		});

		priceSlider.noUiSlider.on('update', function( values, handle ) {
			var value = values[handle];
			handle ? priceInputMax.value = value : priceInputMin.value = value
		});
	}

})(jQuery);
$(document).ready(function(){
	// filterData();

	function filterData() {
		var action ='filterData';
		var sortPrice = $('#sortPrice').val();
		var priceMin = $('#price-min').val();
		var priceMax = $('#price-max').val();
		var brand = getClassName('brand');
		var category = getClassName('category');
		// console.log("đk cái đi");
		$.ajax({
			// url: "<?php URLROOT?>shop/filter",
			url: "filter.php",
			method: "POST",
			data: {
				sortPrice,
				action,
				priceMax,
				priceMin,
				brand,
				category
			},
			success: function(data) {
				$('#store').html(data);
			}

		})
	}
	function getClassName(className){
		var filter=[];
		$('.' + className + ':checked').each(function(){
			filter.push($(this).val())
		})
		return filter;
	}
	$('.selector').click(function() {
		filterData()
	});
	$('#price-filter').change( function(){
	filterData();
	});
	$('#sortPrice').change( function(){
		console.log("gia");
	filterData();
	});
	$('.price-filter').click(function() {
		filterData()
	});
});

    $(document).ready(function(){
        var action='search';
        $('#search').keyup(function(){
            // var search_name = $('#search_name').value;
            var search_name = document.getElementById('search').value;
            if(search_name !=""){
                $.ajax({
                url:'filter.php',
                method:'POST',
                data:{
                    action:action,
                    search_name: search_name
                },
                // success:
            }).done(function(data){
                    $('#resultSearch').html(data);
                });
            } else{
                $('#resultSearch').html('');
            }
			// $(this).blur(function(){
			// 	$('#resultSearch').html('');
			// })

            console.log(action);
            console.log(search_name);
        });
    });
// var ulElement = document.querySelectorAll('.result > ul>li ')
   
//         ulElement.each(li=>{
//             li.click(function(){
//                 alert(this);
//             })
       
//     })
     

