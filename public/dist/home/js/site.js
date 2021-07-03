$(function () {
    $('nav#menu').mmenu();


    $('.carousel').owlCarousel({
        itemsMobile: [479, 3],
        itemsTablet: [768, 3],
        itemsDesktopSmall : [979, 3],
        itemsDesktop : [1199, 3],
        pagination: false,
        items: 3,
        autoPlay: true,
    });
    $('.carousel-single').owlCarousel({
        itemsMobile: [479, 1],
        itemsTablet: [768, 2],
        itemsDesktopSmall : [979, 2],
        itemsDesktop : [1199, 2],
        items: 2,
        pagination: true,
        autoPlay: true
    });

    if ($('.content .box .box-content .product').length > 0) {
        $('.content .box .box-content .product').matchHeight();
    }

    $('.btn-number').click(function (e) {
        e.preventDefault();

        fieldName = $(this).attr('data-field');
        type = $(this).attr('data-type');
        var input = $("input[name='" + fieldName + "']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if (type == 'minus') {

                if (currentVal > input.attr('min')) {
                    input.val(currentVal - 1).change();
                }
                if (parseInt(input.val()) == input.attr('min')) {
                    $(this).attr('disabled', true);
                }

            } else if (type == 'plus') {

                if (currentVal < input.attr('max')) {
                    input.val(currentVal + 1).change();
                }
                if (parseInt(input.val()) == input.attr('max')) {
                    $(this).attr('disabled', true);
                }

            }
        } else {
            input.val(0);
        }
    });
    $('.input-number').focusin(function () {
        $(this).data('oldValue', $(this).val());
    });
    $('.input-number').change(function () {

        minValue = parseInt($(this).attr('min'));
        maxValue = parseInt($(this).attr('max'));
        valueCurrent = parseInt($(this).val());

        name = $(this).attr('name');
        if (valueCurrent >= minValue) {
            $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the minimum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        if (valueCurrent <= maxValue) {
            $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the maximum value was reached');
            $(this).val($(this).data('oldValue'));
        }


    });
    $(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });


    $('#btnAddToCart').click(function (e) {
        e.preventDefault();
        var pid = $('#pid').val();

        var qty = $('#txtproductsl').val();
        var price = $('#divproducttong').data('price-new');

        let i_tag = $(this).find("i");
        i_tag.removeClass("fa fa-shopping-cart");
        i_tag.addClass("fa fa-spinner fa-spin");

        $.post(baseUrl +"/ajaxAddToCart", {
            product_id: pid,
            quantity: qty,
            token:token
        }, function(result){
            console.log(result);
            if(result.st == "success"){
                setTimeout(function(){
                    
                    i_tag.removeClass("fa fa-spinner fa-spin");
                    i_tag.addClass("fa fa-shopping-cart");
                    $(".p5.alert-success[data-id='"+pid+"']").removeClass("hide");
                    $("#cart-count2").text(result.count);

                    renderCart(result.cart);
                }, 700)
            }
        },'json');


    });

    $('.single-product .box .qty .pull-right a').click(function () {
        $('.single-product .box .qty .pull-right a.active').removeClass('active');
        $(this).addClass('active');
        var price = $(this).data('kg') * $('.single-product .box .price .price-colorgb').data('price-new') * $('.single-product .box .qty .pull-right .input-group .form-control').val();
        price = Math.round(price);
        $('.single-product .box .price .price-new').html(String(price).replace(/(.)(?=(\d{3})+$)/g, '$1,') + 'd').attr('data-price-new', price);
    });

    $('.btn-group .btn-primary').click(function () {
        $('.btn-group .btn-primary').removeClass('active');
        $(this).addClass('active');
        var price = $(this).data('kg') * $('#pp-price-colorrgb').data('price-new') * $('#txtproductsl').val();
        price = Math.round(price);
        $('#divproducttong').html(String(price).replace(/(.)(?=(\d{3})+$)/g, '$1,') + ' đ').attr('data-price-new', price);
        var numb = $(this).data('kg') *$('#txtproductsl').val();
        numb = numb.toFixed(2);
        $('#pp-sl').html(numb);
    });

    $('.single-product .box .qty .pull-right .input-group .form-control').change(function () {
        var kg = $('.single-product .box .qty .pull-right a.active').length > 0 ? $('.single-product .box .qty .pull-right a.active').data('kg') : 1;
        var price = kg * $('.single-product .box .price .price-colorgb').data('price-new') * $(this).val();
        price = Math.round(price);
        $('.single-product .box .price .price-new').html(String(price).replace(/(.)(?=(\d{3})+$)/g, '$1,') + 'd').attr('data-price-new', price);

    });

    $('#txtproductsl').change(function () {
        //$('#test').html('fuck');
        var kg = $('.pull-right .btn-group a.active').length > 0 ? $('.pull-right .btn-group a.active').data('kg') : 1;
        var price = kg * $('#pp-price-colorrgb').data('price-new') * $(this).val();
        price = Math.round(price);
        $('#divproducttong').html(String(price).replace(/(.)(?=(\d{3})+$)/g, '$1,') + 'đ').attr('data-price-new', price);
        var numb = kg *$(this).val();
        numb = numb.toFixed(2);
        $('#pp-sl').html(numb);
    });

});

function getCart() {
    $.ajax({
        url: baseUrl + "/site/get-cart", success: function (result) {
            $('.header .cart .qty').text(result);

            //$('.cart-count1').html('dep zai');
            $('#cart-count2').html(result);
            $('#cart-count1').html(result);

        }
    });
}