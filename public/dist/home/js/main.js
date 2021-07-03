var t = new Date();
var checkdate = false;
jQuery(document).ready(function($){

	var timelineBlocks = $('.cd-timeline-block'),
			offset = 0.8;

	//hide timeline blocks which are outside the viewport
	hideBlocks(timelineBlocks, offset);

	//on scolling, show/animate timeline blocks when enter the viewport
	$(window).on('scroll', function(){
		(!window.requestAnimationFrame) 
		? setTimeout(function(){ showBlocks(timelineBlocks, offset); }, 100)
		: window.requestAnimationFrame(function(){ showBlocks(timelineBlocks, offset); });
	});

	function hideBlocks(blocks, offset) {
		blocks.each(function(){
			( $(this).offset().top > $(window).scrollTop()+$(window).height()*offset ) && $(this).find('.cd-timeline-img, .cd-timeline-content').addClass('is-hidden');
		});
	}

	function showBlocks(blocks, offset) {
		blocks.each(function(){
			( $(this).offset().top <= $(window).scrollTop()+$(window).height()*offset && $(this).find('.cd-timeline-img').hasClass('is-hidden') ) && $(this).find('.cd-timeline-img, .cd-timeline-content').removeClass('is-hidden').addClass('bounce-in');
		});
	}
});
jQuery(document).ready(function(){
	$("#owl-demo").owlCarousel({
		items : 5,
		lazyLoad : true,
		pagination : false,
		navigation : true,
		itemsDesktop: [1199, 5],
		itemsDesktopSmall: [979, 4],
		itemsTablet: [768,2],
		itemsTabletSmall: [480, 2],
		itemsMobile: [360, 2],
		navigationText : ["<span class='fa fa-angle-left'></span>", "<span class='fa fa-angle-right'></span>"]
	});

	$("#owl-slider").owlCarousel({
		navigation : true, // Show next and prev buttons
		paginationSpeed : 400,
		pagination : true,
		singleItem:true,
		stopOnHover: true,
		transitionStyle : "fade",
		autoPlay: 5000,
		navigationText : ["<span class='fa fa-angle-left'></span>", "<span class='fa fa-angle-right'></span>"]
	});
});
function get_list_ajax(array, container, view, cb) {
	$.each(array,function(i,url){
		$.ajax({
			url:'/products/'+url+'?view='+view,
			async: false,
			success:function(data){       
				$(container).append(data);
				cb && (i+1) === array.length ? cb(i) : null ;
			}
		});
	});
}
function show_store (iframe){
	$('.list_address').html(iframe);
}
function show_address(address) {
	$('#map_canvas,#map_canvas_2').html(address);
}
show_address('{{settings.lng-map-1 | escape}}');
function compare(){
	jQuery('.modal-body.equal .row').html('');
	jQuery('.compare').each(function(){
		if(jQuery(this).prop('checked'))
		{
			node = jQuery('.product-item.'+jQuery(this).attr('data')).html();
			jQuery('.modal-body.equal .row').append("<div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>"+node+"</div>");
		}
	});
}
function deletecart(product_id){
	
	$.post(baseUrl +"/ajaxDeleteCart", {
		"product_id":product_id,
		token:token
	}, function(result){
		if(result.st == "success"){
			
			let cart = result.cart;
			renderCart(cart);
			$("#cart-count2").text(result.count);
		}
	},'json');
}

function renderCart(cart){

	let cart_elm = '<div class="cart_empty">Giỏ hàng của bạn vẫn chưa có sản phẩm nào.</div>';
	if(cart.data != undefined){

		let data = cart.data;
		let item = '';
		let total = cart.total;
		$.each(data,(index, value) => {
			item += `<div class="cart_item clearfix">
						<div class="cart_item_image">
							<img src="${value.image}" class="media-object">
						</div>
						<div class="cart_item_info">
							<p class="cart_item_title"><a href="${baseUrl+"/san-pham/"}${value.product_slug}" title="${value.product_name}">${value.product_name}</a></p>
							<span class="cart_item_price">${value.price.toLocaleString('it-IT', {style : 'currency', currency : 'VND'})}/${value.unit_name}</span>
							<span class="cart_item_qty">x${value.quantity}</span>
							<span class="remove"><a href="javascript:void(0);" onclick="deletecart(${value.product_id})"><i class="fa fa-trash" aria-hidden="true"></i></a></span>
						</div>
					</div>`
		});
		cart_elm = `<div class="cart_header_top_box">

			<div class="cart_box_wrap">
			${item}
			</div>
			<div class="cart_box_bottom">
				<div class="total_cart"><span>Tổng tiền: </span><span class="total_price">${total.toLocaleString('it-IT', {style : 'currency', currency : 'VND'})}</span></div>
				<a href="/cart" class="btn-minicart">Xem giỏ hàng</a>
			</div>

		</div>`;
	}

	$(".cart_header_top_box").html(cart_elm);
}
var slug = function(str) {
	str = str.toLowerCase();
	str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "");
	str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "");
	str = str.replace(/ì|í|ị|ỉ|ĩ/g, "");
	str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "");
	str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "");
	str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "");
	str = str.replace(/đ|₫/g, "");
	str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g, "");
	str = str.replace(/-+-/g, ""); //thay thế 2- thành 1- 
	str = str.replace(/^\-+|\-+$/g, "");
	return str;
}
/* Lấy danh sách thời gian đặt hàng */
function getDate(){
	"use strict";
	var fulldate = getcurrenttime(t);
	setcurrenttime(t);
	jQuery('#data_order').val(fulldate).datepicker({
		changeMonth: true,
		numberOfMonths: 1,
		dateFormat: "dd/mm/yy",
		minDate: t,
		onSelect: function(selectedDate) {
			var seldate = $(this).datepicker('getDate');
			seldate = seldate.toDateString();
			seldate = seldate.split(' ');
			var weekday = seldate[0];
			if(fulldate == selectedDate){
				setcurrenttime(t);
			}else{
				checkdate = false;
				$('#modal-checkout-button').removeAttr('disabled');
				$('.note_timeout').hide();
				var hours, minutes,html = '';
				html += '<option selected value="Càng sớm càng tốt">Càng sớm càng tốt</option>';
				if(weekday == 'Sun'){
					for (var i = 600; i<= 1020; i+= 30){
						hours = Math.floor(i / 60);
						minutes = i % 60;
						if(minutes < 10){
							minutes = "0" + minutes;
						}
						if(hours < 10){
							hours = "0" + hours;
						}
						html += '<option value=' + hours + ':' + minutes + '>'+ hours + ':' + minutes +'</option>';
					}
				}
				else{
					for (var i = 600; i<= 1260; i+= 30){
						hours = Math.floor(i / 60);
						minutes = i % 60;

						if(minutes < 10){
							minutes = "0" + minutes;
						}
						if(hours < 10){
							hours = "0" + hours;
						}
						html += '<option value=' + hours + ':' + minutes + '>'+ hours + ':' + minutes +'</option>';
					}
				}
				jQuery('#time_order').html(html);
			}
		}
	});
}
	/* Lấy thời gian hiện tại */
function getcurrenttime(today){

	"use strict";
	var string_date = '';
	var day = today.getDate();
	var fullyear = today.getFullYear();
	var month = today.getMonth() + 1;

	month < 10 ? month = "0" + month : month;
	day < 10 ? day = "0" + day : day;
	var string_date = day + "/" + month + "/" + fullyear;
	return string_date;
}
/* Thiết lập đặt hàng với thời gian hiện tại */
function setcurrenttime(today){
	"use strict";
	var hours_today = today.getHours();
	var minus_today = today.getMinutes();
	var weekday = today.getDay();
	console.log(weekday);
	var hours, minutes,html='',check_condition = '';
	if(weekday == 0){
		if((hours_today == 17) || hours_today > 17){
			checkdate = true;
			$('.note_timeout').html('Bạn vui lòng chọn thời gian nhận hàng vào ngày hôm sau');
			$('.note_timeout').show();
			$('#modal-checkout-button').attr('disabled','disabled');
			html += '<option selected value="Càng sớm càng tốt">Càng sớm càng tốt</option>';
			for (var i = 600; i<= 1260; i+= 30){
				hours = Math.floor(i / 60);
				minutes = i % 60;
				if(minutes < 10){
					minutes = "0" + minutes;
				}
				if(hours < 10){
					hours = "0" + hours;
				}
				html += '<option value=' + hours + ':' + minutes + '>'+ hours + ':' + minutes +'</option>';
			}
		}
		else{
			checkdate = false;
			var j = 0;
			if(hours_today < 8){
				j = 600;
			}else if(minus_today <= 30){
				j = (hours_today + 2) * 60 + 30;
			}else if(minus_today > 30 && minus_today < 59){
				j = ((hours_today + 2) * 60) + 60;
			}else if(hours_today == '21'){
				j = hours_today;
			}
			$('.note_timeout').html('');
			html += '<option selected value="Càng sớm càng tốt">Càng sớm càng tốt</option>';
			for (j; j<= 1260; j+= 30){
				hours = Math.floor(j / 60);
				minutes = j % 60;

				if(minutes < 10){
					minutes = "0" + minutes;
				}
				if(hours < 10){
					hours = "0" + hours;
				}
				html += '<option value=' + hours + ':' + minutes + '>'+ hours + ':' + minutes +'</option>';
			}
		}
		}
	else{
		if((hours_today == 19 && minus_today > 30) || hours_today > 19){
			checkdate = true;
			$('.note_timeout').html('Bạn vui lòng chọn thời gian nhận hàng vào ngày hôm sau');
			$('#modal-checkout-button').attr('disabled','disabled');
			html += '<option selected value="Càng sớm càng tốt">Càng sớm càng tốt</option>';
			for (var i = 600; i<= 1260; i+= 30){
				hours = Math.floor(i / 60);
				minutes = i % 60;
				if(minutes < 10){
					minutes = "0" + minutes;
				}
				if(hours < 10){
					hours = "0" + hours;
				}
				html += '<option value=' + hours + ':' + minutes + '>'+ hours + ':' + minutes +'</option>';
			}
		}
		else{
			checkdate = false;
			var j = 0;
			if(hours_today < 8){
				j = 600;
			}else if(minus_today <= 30){
				j = (hours_today + 2) * 60 + 30;
			}else if(minus_today > 30 && minus_today < 59){
				j = ((hours_today + 2) * 60) + 60;
			}else if(hours_today == '21'){
				j = hours_today;
			}
			$('.note_timeout').html('');
			html += '<option selected value="Càng sớm càng tốt">Càng sớm càng tốt</option>';
			for (j; j<= 1260; j+= 30){
				hours = Math.floor(j / 60);
				minutes = j % 60;

				if(minutes < 10){
					minutes = "0" + minutes;
				}
				if(hours < 10){
					hours = "0" + hours;
				}
				html += '<option value=' + hours + ':' + minutes + '>'+ hours + ':' + minutes +'</option>';
			}
		}
	}
	jQuery('#time_order').html(html);
}
jQuery(document).ready(function(){
	jQuery('button.equa').click(function(){
		jQuery('.modal-body.equal .row').html('');
		jQuery('.compare').each(function(){
			if(jQuery(this).prop('checked'))
			{
				node = jQuery('.product-item.'+jQuery(this).attr('data')).html();
				jQuery('.modal-body.equal .row').append("<div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>"+node+"</div>");
			}
		});
		if(jQuery('.modal-body.equal .row').html() == '')
			jQuery('.modal-body.equal .row').html('<div class="text-center">Bạn chưa chọn sản phẩm nào!</div>');
	})
	Number.prototype.formatMoney = function(c, d, t){
		var n = this, 
				c = isNaN(c = Math.abs(c)) ? 2 : c, 
				d = d == undefined ? "." : d, 
				t = t == undefined ? "," : t, 
				s = n < 0 ? "-" : "", 
				i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", 
				j = (j = i.length) > 3 ? j % 3 : 0;
		return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
	};
	Haravan.onItemAdded = function(line_item) {
		console.log(line_item);
		jQuery('#cart-modal').modal();
		var html="<div class='content'><div class='col-sm-5 col-xs-12'><div class='cart1'><a href='"+line_item.url+"'><img src='"+line_item.image+"'/> </a></div><div class='cartItem'> <div><a href='"+line_item.url+"'>"+line_item.title+"</a></div><div><span class='item-price'></span></div> <div>Số lượng: "+line_item.quantity+"</div></div></div><div class='col-sm-7 col-xs-12'><div class='cartsum'> <div class='subTotal'>Gía trị đơn hàng:<em class='productPrice'></em> </div> <div>Giỏ hàng của bạn hiện có <span class='cart-count'></span> sản phẩm</div> </div></div></div></div>";

		jQuery('#cart-modal').find('.CartThumb').empty();
		jQuery('#cart-modal').find('.CartThumb').html(html);
		jQuery.getJSON('/cart.js', function(cart, textStatus) {
			jQuery('.cart-count').html(cart.item_count);
			jQuery('.productPrice').html((parseInt(cart.total_price)/100).formatMoney(0, '.', ',') + 'đ');
		});
		jQuery('.item-price').html((parseInt(line_item.price)/100).formatMoney(0, '.', ',') + 'đ');
		jQuery('.count-item').html();
	};
	Haravan.addItemFromForm = function(form_id, callback) {
		var params = {
			async: true,
			type: 'POST',
			url: '/cart/add.js',
			data: jQuery('#' + form_id).serialize(),
			dataType: 'json',
			success: function(line_item) {
				if ((typeof callback) === 'function') {
					callback(line_item);

				} else {
					Haravan.onItemAdded(line_item);
				}
			},
			//error: function(XMLHttpRequest, textStatus) {
			//Haravan.onError(XMLHttpRequest, textStatus);
			//}
		};
		jQuery.ajax(params);
	};

	getDate();
	$('#cart-target a').click(function(event){
		event.preventDefault() ;
		getCartAjax();

		$('#myCart').modal('show');
		$('.modal-backdrop').css({'height':$(document).height()});
	});
	$('a[data-spy=scroll]').click(function(){
		event.preventDefault() ;
		$('body').animate({scrollTop: ($($(this).attr('href')).offset().top - 20) + 'px'}, 500);
	})
	$('#update-cart-modal').click(function(event){
		event.preventDefault();
		if (jQuery('#cartform').serialize().length <= 5) return;
		$(this).html('Đang cập nhật');
		var params = {
			type: 'POST',
			url: '/cart/update.js',
			data: jQuery('#cartform').serialize(),
			dataType: 'json',
			success: function(cart) {
				if ((typeof callback) === 'function') {
					callback(cart);
				} else {

					getCartAjax();
				}

				$('#update-cart-modal').html('Cập nhật');
			},
			error: function(XMLHttpRequest, textStatus) {
				Haravan.onError(XMLHttpRequest, textStatus);
			}
		};
		jQuery.ajax(params);
	});
	$('#note').val('');
	$('#modal-checkout-button').click(function(){
		$('#cartform').submit();
	})

	$(document).on('click','#modal-checkout-button',function(e){
		var order_day = $('#data_order').val();
		var order_time = $('#time_order').val();
		console.log(checkdate);
		if(checkdate == true){
			$('#modal-checkout-button').attr('disabled','disabled');
		}else{
			var min_price = slug(String($('.item-total').html()));
			if(min_price <= 200000){
				$('#warning_order').modal('show');
				$('.modal-backdrop').css({'height':$(document).height()});
				e.preventDefault();
			}else{
				var note_customer = $('#note').val();
				var string = note_customer + ". Đơn hàng sẽ giao hàng vào ngày " + order_day + " lúc " + order_time;
				$('#note').val(string);
			}
		}
	});
})