<!DOCTYPE html>
<html lang="vi">

<head>

    <title>Công ty thực phẩm </title>
    <link rel = "icon" href ="../../dist/home/img/icons/icon_website.png" type = "image/x-icon"> 
    <link href="<?=base_url()?>/dist/home/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" href="<?=base_url()?>/dist/home/css/main.css" />
    <link rel="stylesheet" href="<?=base_url()?>/dist/home/css/style1.css" />
    <link href="<?=base_url()?>/dist/home/css/owl.carousel.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?=base_url()?>/dist/home/css/jquery-ui.min.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?=base_url()?>/dist/home/css/owl.theme.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?=base_url()?>/dist/home/css/owl.transitions.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?=base_url()?>/dist/home/css/settings.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?=base_url()?>/dist/home/css/responsive.css" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" href="<?=base_url()?>/dist/home/css/jquery.mmenu.css" />

    <link href="<?=base_url()?>/dist/home/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">


    <script src="<?=base_url()?>/dist/home/js/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>/dist/home/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>/dist/home/js/owl.carousel.js" type="text/javascript"></script>
    <script src="<?=base_url()?>/dist/home/js/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>/dist/home/js/option_selection.js" type="text/javascript"></script>

    <script src="<?=base_url()?>/dist/home/js/main.js" type="text/javascript"></script>
    <script>
    var money_format = "{{amount}} đ";
    </script>
    <script src="<?=base_url()?>/dist/home/js/jquery.mmenu.js"></script>
    <script src="<?=base_url()?>/dist/home/js/site.js?colorgb=1.39"></script>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/8.5.3/mmenu.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/8.5.3/mmenu.js"></script>


    <script>
    document.addEventListener(
        "DOMContentLoaded", () => {
            new Mmenu("#menu-mobile");
        }
    );
    </script>



    <script>

    var token = '<?=csrf_hash()?>';
    var baseUrl = '<?=base_url()?>';


    $(document).ready(function() {

            if (window.location.href.indexOf("search") > -1 ||
                window.location.href.indexOf("ct") > -1 ||
                window.location.href.indexOf("sale") > -1 ||
                window.location.href.indexOf("new") > -1 ||
                window.location.href.indexOf("userhome") > -1 ||
                window.location.href.indexOf("userhistory") > -1
            ) {
                $('.navbar_menuvertical').hide();
            }
            var mrg = $('.fixme').height();
            $("#supermain").css('margin-top', mrg + 'px');
            $("#menu-mobile").css('margin-top', mrg + 'px');
        }


    );
    </script>

    <style>
    .cart-count1 {
        position: absolute;
        background: red;
        color: #fff;
        padding: 2px 8px;
        font-size: 11px;
        right: 0;
        border-radius: 4px;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        top: 0;
    }

    .fone {
        font-size: 22px;
        color: #1dad4b;
        line-height: 40px;
        font-weight: bold;
        padding-left: 45px;
    }

    .fix_tel {
        position: fixed;
        bottom: 15px;
        right: 0;
        z-index: 999;
    }

    .fix_tel a {
        text-decoration: none;
    }

    .tel {
        background: #eee;
        width: 205px;
        height: 40px;
        position: relative;
        overflow: hidden;
        background-size: 40px;
        border-radius: 28px;
        border: solid 1px #ccc;
    }

    .ring-alo-phone {
        background-color: transparent;
        cursor: pointer;
        height: 80px;
        position: absolute;
        transition: visibility 0.5s ease 0s;
        visibility: hidden;
        width: 80px;
        z-index: 200000 !important;
    }

    .ring-alo-phone.ring-alo-show {
        visibility: visible;
    }

    .ring-alo-phone.ring-alo-hover,
    .ring-alo-phone:hover {
        opacity: 1;
    }

    .ring-alo-ph-circle {
        animation: 1.2s ease-in-out 0s normal none infinite running ring-alo-circle-anim;
        background-color: transparent;
        border: 2px solid rgba(30, 30, 30, 0.4);
        border-radius: 100%;
        height: 70px;
        left: 10px;
        opacity: 0.1;
        position: absolute;
        top: 12px;
        transform-origin: 50% 50% 0;
        transition: all 0.5s ease 0s;
        width: 70px;
    }

    .ring-alo-phone.ring-alo-active .ring-alo-ph-circle {
        animation: 1.1s ease-in-out 0s normal none infinite running ring-alo-circle-anim !important;
    }

    .ring-alo-phone.ring-alo-static .ring-alo-ph-circle {
        animation: 2.2s ease-in-out 0s normal none infinite running ring-alo-circle-anim !important;
    }

    .ring-alo-phone.ring-alo-hover .ring-alo-ph-circle,
    .ring-alo-phone:hover .ring-alo-ph-circle {
        border-color: #1dad4b;
        opacity: 0.5;
    }

    .ring-alo-phone.ring-alo-green.ring-alo-hover .ring-alo-ph-circle,
    .ring-alo-phone.ring-alo-green:hover .ring-alo-ph-circle {
        border-color: #baf5a7;
        opacity: 0.5;
    }

    .ring-alo-phone.ring-alo-green .ring-alo-ph-circle {
        border-color: #1dad4b;
        opacity: 0.5;
    }

    .ring-alo-ph-circle-fill {
        animation: 2.3s ease-in-out 0s normal none infinite running ring-alo-circle-fill-anim;
        background-color: #000;
        border: 2px solid transparent;
        border-radius: 100%;
        height: 30px;
        left: 30px;
        opacity: 0.1;
        position: absolute;
        top: 30px;
        transform-origin: 50% 50% 0;
        transition: all 0.5s ease 0s;
        width: 30px;
    }

    .ring-alo-phone.ring-alo-hover .ring-alo-ph-circle-fill,
    .ring-alo-phone:hover .ring-alo-ph-circle-fill {
        background-color: rgba(0, 175, 242, 0.5);
        opacity: 0.75 !important;
    }

    .ring-alo-phone.ring-alo-green.ring-alo-hover .ring-alo-ph-circle-fill,
    .ring-alo-phone.ring-alo-green:hover .ring-alo-ph-circle-fill {
        background-color: rgba(117, 235, 80, 0.5);
        opacity: 0.75 !important;
    }

    .ring-alo-phone.ring-alo-green .ring-alo-ph-circle-fill {
        background-color: rgba(0, 175, 242, 0.5);
        opacity: 0.75 !important;
    }

    .ring-alo-ph-img-circle {
        animation: 1s ease-in-out 0s normal none infinite running ring-alo-circle-img-anim;
        border: 2px solid transparent;
        border-radius: 100%;
        height: 30px;
        left: 30px;
        opacity: 1;
        position: absolute;
        top: 30px;
        transform-origin: 50% 50% 0;
        width: 30px;
    }

    .ring-alo-phone.ring-alo-hover .ring-alo-ph-img-circle,
    .ring-alo-phone:hover .ring-alo-ph-img-circle {
        background-color: #1dad4b;
    }

    .ring-alo-phone.ring-alo-green.ring-alo-hover .ring-alo-ph-img-circle,
    .ring-alo-phone.ring-alo-green:hover .ring-alo-ph-img-circle {
        background-color: #75eb50;
    }

    .ring-alo-phone.ring-alo-green .ring-alo-ph-img-circle {
        background-color: #1dad4b;
    }

    @keyframes ring-alo-circle-anim {
        0% {
            opacity: 0.1;
            transform: rotate(0deg) scale(0.5) skew(1deg);
        }

        30% {
            opacity: 0.5;
            transform: rotate(0deg) scale(0.7) skew(1deg);
        }

        100% {
            opacity: 0.6;
            transform: rotate(0deg) scale(1) skew(1deg);
        }
    }

    @keyframes ring-alo-circle-img-anim {
        0% {
            transform: rotate(0deg) scale(1) skew(1deg);
        }

        10% {
            transform: rotate(-25deg) scale(1) skew(1deg);
        }

        20% {
            transform: rotate(25deg) scale(1) skew(1deg);
        }

        30% {
            transform: rotate(-25deg) scale(1) skew(1deg);
        }

        40% {
            transform: rotate(25deg) scale(1) skew(1deg);
        }

        50% {
            transform: rotate(0deg) scale(1) skew(1deg);
        }

        100% {
            transform: rotate(0deg) scale(1) skew(1deg);
        }
    }

    @keyframes ring-alo-circle-fill-anim {
        0% {
            opacity: 0.2;
            transform: rotate(0deg) scale(0.7) skew(1deg);
        }

        50% {
            opacity: 0.2;
            transform: rotate(0deg) scale(1) skew(1deg);
        }

        100% {
            opacity: 0.2;
            transform: rotate(0deg) scale(0.7) skew(1deg);
        }
    }

    .ring-alo-ph-img-circle a img {
        padding: 1px 0 0 1px;
        width: 25px;
        position: relative;
        top: 0px;
    }
    }

    .ring-alo-phone.ring-alo-green .ring-alo-ph-img-circle {
        background-color: #1dad4b;
    }

    .ring-alo-phone.ring-alo-green .ring-alo-ph-circle {
        background-color: #1dad4b;
    }

    .ring-alo-phone.ring-alo-green .ring-alo-ph-circle {
        border-color: #1dad4b;
    }

    .ring-alo-phone.ring-alo-green.ring-alo-hover .ring-alo-ph-img-circle,
    .ring-alo-phone.ring-alo-green:hover .ring-alo-ph-img-circle {
        background-color: #baf5a7;
    }

    .fone {
        color: #1dad4b;
    }

    .tel {
        background-color: #eee;
    }

    .fix_tel {
        top: auto;
        bottom: auto;
        right: auto;
        left: auto;
        bottom: 15px;
        left: 5px;
    }
    </style>



</head>

<body>


    <header>

        <div class="fixme" style="position: fixed;top: 0;z-index: 9999; width: 100%;">
            <div class="header-bottom">
                <div class="container">
                    <div class="row">
                        <div id="menu_mobi" class="visible-xs visible-sm col-md-1 col-sm-2 col-xs-2" style="float:left">
                            <link href="<?=base_url()?>/dist/home/css/menu-mobile.css" rel="stylesheet" type="text/css"
                                media="all">
                            <div class="slicknav_menu icon_slicknav_menumb">
                                <a href="#menu-mobile" id="showmenu-mobile" class="slicknav_btn slicknav_collapsed"
                                    style="outline: none;">
                                    <span class="slicknav_menutxt"></span>
                                    <span class="slicknav_icon slicknav_no-text fa fa-th-list menu-toggle"></span>
                                </a>
                            </div>
                            <section id="wrap-header-mobile">
                                <nav id="menu-mobile">
                                    <ul style="margin-top:5px;">
                                        <li class="ta"><a href="/"><span class="ti">Trang chủ</span></a></li>

                                        <?php foreach($categories as $value) : ?>
                                        <li class="ta"><a
                                                href="<?=base_url()?>/danh-muc/<?=$value->category_slug?>"><span
                                                    class="ti"><?=$value->category_name?></span></a>
                                        </li>
                                        <?php endforeach ?>

                                    </ul>
                                </nav>
                            </section>
                        </div>
                        <div class="logo no-padding-left no-padding-xs col-lg-3 col-md-3 col-sm-8 col-xs-7">
                            <a href="/"><img alt="" src="<?=base_url()?>/dist/home/img/icons/logo.png" height="70"
                                    style="padding: 5px;margin-top: 5px;"></a>
                        </div>
                        <div class="visible-xs visible-sm block_cart col-lg-2 col-md-3 col-sm-2 col-xs-3">
                            <a href="cart" class="cart_link"><img
                                    src="<?=base_url()?>/dist/home/img/icons/cart.png" alt="gio hang">
                                <span id="cart-count1" class="cart-count1">0</span></a>
                        </div>

                        <div
                            class="visible-md visible-lg visible-sm block_search col-lg-3 col-md-4 col-sm-12 col-xs-12">
                            <form id="searchbox" action="<?=base_url()?>/search" method="GET">
                                <input type="hidden" name="type" value="product">

                                <input type="text" name="k" value="" class="index_input_search form-control"
                                    placeholder="Bạn cần tìm gì?">
                                <button class="btn_search_submit btn btn-default " type="submit"><i class="fa fa-search"
                                        aria-hidden="true"></i>
                                </button>
                            </form>
                        </div>
                        <div class="hidden-xs hidden-sm col-xs-12 col-md-3 col-lg-4 col-sm-12 hotline_bottom">
                            <div class="hotline_number">
                                <a class="hotline-link" href="tel:0329588215">0329588215</a>
                                <p>
                                    (Trực máy 24/24)
                                </p>
                            </div>
                            <!-- <p class="hotline_shipping"><img src="media/img/common/giaohang.png" alt=""></p> -->
                        </div>
                        <div class="visible-md visible-lg block_cart col-lg-2 col-md-2 col-sm-2 col-xs-3">
                            <div class="header-user">

                                <!-- <a class="user login" href="site/login">Đăng nhập</a> -->
                            </div>
                            <div class="header-cart">
                                <a href="/cart"><img
                                        src="//theme.hstatic.net/1000030244/1000532904/14/cart.png?v=261"
                                        alt="gio hang"><span id="cart-count2" class="cart-count1"><?=(!empty($cart)) ? count($cart["data"]) : 0?></span></a>
                                <div class="cart_clone_box">
                                    <div class="cart_box_wrap hidden">
                                        <div class="cart_item original clearfix">
                                            <div class="cart_item_image"></div>
                                            <div class="cart_item_info">
                                                <p class="cart_item_title"><a href="" title=""></a>
                                                </p><span class="cart_item_price"></span><span
                                                    class="cart_item_qty"></span><span class="remove"><a
                                                        href="javascript:void(0);"><i class="fa fa-trash"
                                                            aria-hidden="true"></i></a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cart_header_top_box">
                                    
                                    <?php if(!empty($cart)) { ?>
                                        <div class="cart_header_top_box">
                                    
                                            <div class="cart_box_wrap">
                                            <?php foreach($cart["data"] as $value) : ?>
                                                <div class="cart_item clearfix">
                                                    <div class="cart_item_image">
                                                        <img src="<?=$value->image?>" class="media-object">
                                                    </div>
                                                    <div class="cart_item_info">
                                                        <p class="cart_item_title"><a href="<?=base_url()?>/san-pham/<?=$value->product_slug?>" title="<?=$value->product_name?>"><?=$value->product_name?></a></p>
                                                        <span class="cart_item_price"><?=number_format((int)$value->price,0,",",".")?>đ/<?=$value->unit_name?></span>
                                                        <span class="cart_item_qty">x<?=$value->quantity?></span>
                                                        <span class="remove"><a href="javascript:void(0);" onclick="deletecart(<?=$value->product_id?>)"><i class="fa fa-trash" aria-hidden="true"></i></a></span>
                                                    </div>
                                                </div>
                                            <?php endforeach ?>
                                            </div>
                                            <div class="cart_box_bottom">
                                                <div class="total_cart"><span>Tổng tiền: </span><span class="total_price"><?=number_format((int)$cart["total"],0,",",".")?>đ</span></div>
                                                <a href="/cart" class="btn-minicart">Xem giỏ hàng</a>
                                            </div>

                                        </div>
                                    <?php }else { ?>

                                        <div class="cart_empty">Giỏ hàng của bạn vẫn chưa có sản phẩm nào.</div>

                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row visible-xs">
                        <div class="block_search col-lg-5 col-md-5 col-sm-12 col-xs-12">
                            <form id="searchboxMobile" action="search" method="GET">
                                <div class="control-group input-group wrap-input">
                                    <input type="hidden" name="type" value="product">
                                    <label for="index_input_search" class="search-input-label"><i class="fa fa-search"
                                            aria-hidden="true"></i></label>
                                    <input type="text" name="k" value="" class="index_input_search form-control"
                                        placeholder="Bạn cần tìm gì?">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main_menu hidden-sm hidden-xs" id="main_nav">
                <div class="container">
                    <div class="row">
                        <div class="width-20 no-padding-left col-md-3 col-sm-4 col-xs-12">
                            <div id="DHS_megamenu">
                                <div class="title_block">
                                    <span>danh mục</span>
                                </div>
                                <div class="block_conten navbar_menuvertical" style="width:100%">
                                    <ul class="nav navbar-nav nav_verticalmenu" style="width:100%" role="navigation">
                                        <?php foreach($categories as $value) : ?>
                                        <li class="item-vertical">
                                            <a href="<?=base_url()?>/danh-muc/<?=$value->category_slug?>">
                                                <span class="title_menu"><?=$value->category_name?></span>
                                            </a>

                                        </li>
                                        <?php endforeach ?>

                                    </ul>
                                </div>
                            </div>

                        </div>
                        <nav class="no-padding col-md-9 col-sm-8 hidden-xs">

                            <!-- <ul class="nav navbar-nav menu_hori">

                                <li>
                                    <a href="site/sale">
                                        <img src="<?=base_url()?>/dist/home/img/icons/hot.png" alt="icon hot"
                                            style="width: 20px;display: inline-block;margin-right: 5px;">

                                        <span style="display: inline-block;vertical-align: middle;"> KHUYẾN MÃI
                                            HOT</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="ct/55555555/nen-mua">

                                        <span style="display: inline-block;vertical-align: middle;">SẢN PHẨM BÁN
                                            CHẠY</span>
                                    </a>
                                </li>
                            </ul> -->

                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>



    <div id="supermain" class="content">

        <style>
        #demo .timecount {
            background: url('https://soibien.vn/mobile/web/media/img/common/icon-time.png') no-repeat;
            width: 50px;
            height: 50px;
            text-align: center;
            color: #fff;
            margin: 0;
            padding: 0;
            font-weight: 500;
            line-height: 50px;
            display: inline-block;
            margin: 0 5px;
        }

        .flash1 {
            float: left;
        }

        .flashdemo {
            float: left;
            background: #037541 url('media/img/common/bg.jpg') no-repeat right center;
            width: 245px;
            height: 59px;
        }

        #super-title1 {
            position: relative;
        }

        .ketthuc {
            padding-left: 20px;
            text-transform: none;
            font-size: 16px;
            float: left;
            line-height: 59px;
            background: #037541;
            display: block;
            padding-right: 10px;
        }

        .clearboth {
            clear: both;
            display: block;
            height: 1px;
            line-height: 1px;
        }

        @media screen and (max-width: 450px) {

            .ketthuc,
            .readmore-index1 {
                display: none;
            }

            .flashdemo {
                width: 60%;
                height: 44px;
                background: #037541;
                padding-left: 10px;
            }

            .flash1 {
                width: 40%;
                height: 44px;
            }

            #demo .timecount {
                background-size: cover;
                width: 40px;
                height: 40px;
                line-height: 40px;
            }

            .super-title1 {
                line-height: 44px !important;
            }

        }

        @media screen and (max-width: 550px) and (min-width: 450px) {

            .ketthuc,
            .readmore-index1 {
                display: none;
            }

            .flashdemo {
                padding-left: 10px;
                width: 50%;
                background: #037541;
            }

            .flash1 {
                width: 50%;
                height: 59px;
            }
        }

        @media screen and (max-width: 640px) and (min-width: 550px) {

            .ketthuc,
            .readmore-index1 {
                display: none;
            }

            .flashdemo {
                padding-left: 10px;
                width: 255px;
            }
        }

        @media screen and (max-width: 747px) and (min-width: 640px) {
            .ketthuc {
                display: none;
            }

            .readmore-index1 {
                position: absolute;
                right: 20px;
            }
        }
        </style>


        <script>
        $(document).ready(function() {
            $("#btnLocation").click(function() {
                $("#dialog-form").dialog("close");
            });

            $("#owl-slider").owlCarousel();


        });
        </script>



        <?php
            try
            {
                echo view($view);
            }
            catch (Exception $e)
            {
                echo "<pre><code>$e</code></pre>";
            }
        ?>


    </div>

    <section class="copyright" style="padding-top: 115px;padding-bottom: 115px;">
        <div class="container">
            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 text-center">
                <a href="/"><img class="logo-foot" alt="" src="<?=base_url()?>/dist/home/img/logo1.png" width="280px"></a>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <p><b>
                        Công ty thực phẩm
                    </b></p>
                <p>Mã số doanh nghiệp: 55555555555 do Sở Kế hoạch và Đầu Tư Thành phố Hà Nội cấp ngày 10/06/2021</p>
                <p>
                    Hotline: 0329588215 - Email: congthanls@gmail.vn
                </p>
                <p>Địa chỉ: Vinhomes Ocean Park Đa Tốn Gia Lâm Hà Nội</p>

            </div>
            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 text-center">

            </div>
        </div>
    </section>
    <!-- Modal -->
    <!--/Footer-->
    <script src="<?=base_url()?>/dist/home/js/yii.js"></script>
    <div id="myModal" class="modal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="margin: 0;color:green">Mua hàng</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <iframe src="" frameborder="0" width="100%" height="285px"></iframe>
                </div>
            </div>

        </div>
    </div>
    <style>
    .modal-header {
        padding: 5px;
    }

    .modal.in .modal-dialog {
        display: block;
        top: 50%;
        left: 30%;
        position: absolute;
        margin-top: -136px;
    }

    .products .btn-buy-now.disabled {
        background: #9E9E9E;
        cursor: not-allowed;
        pointer-events: none;
    }
    </style>

    <script>
    $(function() {
        $('.addtocart').click(function(e) {
            // e.preventDefault();
            // $('#myModal').modal('show');
            // $('#myModal iframe').attr('src', $(this).attr('data-id'));
            let product_id = $(this).attr("data-id");
            let data = {
                product_id: product_id,
                quantity: 1,
                token:token
            }
            // <i class="fas fa-spinner"></i>
            // <i class="fas fa-circle-notch"></i>
            let i_tag = $(this).find("i");
            i_tag.removeClass("fa fa-shopping-cart");
            i_tag.addClass("fa fa-spinner fa-spin");
            let _this = $(this).parent()
            let _that = _this.parent();
            $.post(baseUrl +"/ajaxAddToCart", data, function(result){
                console.log(result);
                if(result.st == "success"){
                    setTimeout(function(){
                        i_tag.removeClass("fa fa-spinner fa-spin");
                        i_tag.addClass("fa fa-shopping-cart");
                        _that.find(".p5.alert-success[data-id='"+product_id+"']").removeClass("hide");
                        $("#cart-count2").text(result.count);

                        renderCart(result.cart);
                    }, 700)
                }
            },'json');
        });

        $('.title_block').click(function(e) {
            $('.navbar_menuvertical').show();
        });



        $('#myModal').on('shown.bs.modal', function(e) {
            setInterval(function() {
                getCart();
            }, 1000);
        });

    })

    $(function() {

        var fixmeTop = 100;
        $(window).scroll(function() {
            var currentScroll = $(window).scrollTop();
            if (currentScroll >= fixmeTop) {

                $('.navbar_menuvertical').hide();

            } else {
                if (window.location.href.indexOf("search") == -1 &&
                    window.location.href.indexOf("ct") == -1 &&
                    window.location.href.indexOf("sale") == -1 &&
                    window.location.href.indexOf("new") == -1 &&
                    window.location.href.indexOf("userhome") == -1 &&
                    window.location.href.indexOf("userhistory") == -1
                ) {
                    $('.navbar_menuvertical').show();
                }
            }
        });

        $(document).on("click", ".title_block", function(){

            if($(".block_conten").hasClass("hidden")){
                $(".block_conten").removeClass("hidden");
            }
            else{
                $(".block_conten").addClass("hidden");
            }
        })
    })
    $(window).scroll();
    </script>


    <div class="fix_tel">
        <div class="ring-alo-phone ring-alo-green ring-alo-show" id="ring-alo-phoneIcon"
            style="right: 150px;bottom: -15px;">
            <div class="ring-alo-ph-circle"></div>
            <div class="ring-alo-ph-circle-fill"></div>
            <div class="ring-alo-ph-img-circle">
                <a href="tel:0943360361">
                    <img class="lazy"
                        src="https://file.hstatic.net/1000301274/file/untitled-call-now-hf_40fecbb119734273bce93e478f0d9220_grande.png?v=284"
                        alt="<php _e('Click to Call','call-now'); ?>">
                    <noscript>"&amp;lt;img
                        src="https://file.hstatic.net/1000301274/file/untitled-call-now-hf_40fecbb119734273bce93e478f0d9220_grande.png?v=284"
                        alt=""&amp;gt;"</noscript>
                </a>
            </div>
        </div>
        <div class="tel">
            <a class="fone" href="tel:0329588215">0329588215</a>
        </div>
    </div>

</body>

</html>