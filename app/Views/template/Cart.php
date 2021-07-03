<!--***********************************************************-->
<!-- Designed & Developed by COLORGB™  -  http://colorgb.com   -->
<!-- giaphv@colorgb.com, rocket@colorgb.com, datnt@colorgb.com -->
<!--***********************************************************-->
<!DOCTYPE html>
<html lang="vi" class="colorgb-sub">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="<?=base_url()?>/dist/home/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?=base_url()?>/dist/home/css/jquery.mmenu.css" />
    <link rel="stylesheet" href="<?=base_url()?>/dist/home/css/owl.carousel.css" />
    <script src="<?=base_url()?>/dist/home/js/jquery-3.2.1.min.js"></script>
    <script src="<?=base_url()?>/dist/home/js/jquery-ui.min.js"></script>
    <script src="<?=base_url()?>/dist/home/js/bootstrap.js"></script>
    <script src="<?=base_url()?>/dist/home/js/jquery.mmenu.js"></script>
    <script src="<?=base_url()?>/dist/home/js/owl.carousel.js"></script>
    <script src="<?=base_url()?>/dist/home/js/jquery.matchHeight-min.js"></script>

    <link href="<?=base_url()?>/dist/home/css/bootstrap.css" rel="stylesheet">
    <link href="<?=base_url()?>/dist/home/css/site.css" rel="stylesheet">

    <!-- Google Tag Manager -->
    <script>
    (function(w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
            'gtm.start': new Date().getTime(),
            event: 'gtm.js'
        });
        var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s),
            dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src =
            'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-KBCTKZH');
    </script>
    <!-- End Google Tag Manager -->

    <script>
    $(function() {
        if ($('.content .box .box-content .product').length > 0) {
            $('.content .box .box-content .product').matchHeight();
        }

        $('input,textarea').each(function() {
            var t = $(this);
            t.on('focus', function() {
                var t = $(this);
                $('body, html').stop().animate({
                    scrollTop: t.offset().top - 50
                }, 500, 'easeInOutExpo');
            });
        });


    });
    var baseUrl = "<?=base_url()?>/";
    </script>

    <style>
    .content-main {
        padding-bottom: 150px;
    }

    ::-webkit-input-placeholder {
        /* Chrome/Opera/Safari */
        color: #999 !important;
    }

    ::-moz-placeholder {
        /* Firefox 19+ */
        color: #999 !important;
    }

    .panel-body table {
        width: 100% !important;
        margin-bottom: 15px;
    }

    :-ms-input-placeholder {
        /* IE 10+ */
        color: #999 !important;
    }

    :-moz-placeholder {
        /* Firefox 18- */
        color: #999 !important;
    }

    html .content .box .box-content .owl-item .label img {
        height: 20px !important;
    }

    .content .box .box-content .title {
        line-height: 1.2;
        font-weight: 500;
        max-height: 35px;
        overflow: hidden;
        display: block;
        margin: 5px 0;
    }

    .colorgb-sub,
    .colorgb-sub body {
        background: #fff !important;
    }

    .colorgb-sub-page {
        min-height: 100vh;
        background: #ececec !important;
    }

    .content-footer>.total {
        border: 5px solid #ececec;
    }

    @media all and (min-width: 1000px) {

        .content-footer,
        body,
        .header {
            max-width: 800px;
            margin: auto;
        }
    }
    </style>
    <script src="<?=base_url()?>/dist/home/js/site.js"></script>

</head>

<body>

    <div id="page" class="colorgb-sub-page clearfix">
        <div class="header">
            <div class="row-1">
                <a href="<?=base_url()?>" class="menu"><i class="fa fa-home"></i></a>

                <span class="text-center"><?=$title?></span>

                <a class="cart" href="/cart"><span class="fa fa-shopping-cart fa-2x"></span><span
                        class="qty"><?=(!empty($cart)) ? count($cart["data"]) : 0?></span></a>
            </div>
        </div>
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
    <script src="<?=base_url()?>/dist/home/js/yii.js"></script>

    <style>

    .products .btn-buy-now.disabled {
        background: #9E9E9E;
        cursor: not-allowed;
        pointer-events: none;
    }

    .content-footer {
        z-index: 999;
    }
    </style>

    <script>
    $(function() {
        $('.btn-buy-now').click(function(e) {
            e.preventDefault();
            $('#myModal').modal('show');
            $('#myModal iframe').attr('src', $(this).attr('href'));
        });


        $('#myModal').on('shown.bs.modal', function(e) {
            setInterval(function() {
                getCart();
            }, 1000);
        });

    })
    </script>

    <style>
    @media all and (min-width: 1000px) and (max-width: 1260px) {
        .banner-1 a {
            margin-top: -150px !important;
        }

        .banner-1 img {
            height: 300px !important;
        }
    }

    @media all and (min-width: 1400px) and (max-width: 1500px) {
        .banner-1 a:first-child {
            left: 40px !important;
        }

        .banner-1 a:last-child {
            right: 40px !important;
        }

        body .banner-1 a {
            margin-top: -250px !important;
        }

        body .banner-1 img {
            height: 500px !important;
        }
    }

    @media all and (min-width: 1260px) and (max-width: 1500px) {
        .banner-1 a {
            margin-top: -200px !important;
        }

        .banner-1 img {
            height: 400px !important;
        }
    }
    </style>
</body>

</html>