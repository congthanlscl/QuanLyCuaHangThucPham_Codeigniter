<div class="wraper container">
            <!--Header-->

            <!--/Slider-->

            <!--Slider-->
            <main>
                <div class="container">
                    <div class="row">
                        <div class="width-20 col-lg-3 col-md-3" style="padding-left:0px;">


                        </div>
                        <div
                            class="width-80 no-padding-right padding-left-5 col-lg-9 col-md-9 col-sm-12 col-xs-12 slider-wrapper">
                            <div class="width-70 no-padding col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                <div id="owl-slider" class="owl-carousel owl-theme" style="opacity: 1; display: block;">
                                    <div>
                                        <a href="<?=base_url()?>" target="_blank" title="carou" class="nivo-imageLink">
                                            <img src="<?=base_url()?>/dist/home/img/banner/b6.jpg">
                                        </a>
                                    </div>


                                    <div>
                                        <a href="<?=base_url()?>" target="_blank" title="carou" class="nivo-imageLink">
                                            <img src="<?=base_url()?>/dist/home/img/banner/b2.jpg">
                                        </a>
                                    </div>
                                    <div>
                                        <a href="<?=base_url()?>" target="_blank" title="carou" class="nivo-imageLink">
                                            <img src="<?=base_url()?>/dist/home/img/banner/b3.jpg">
                                        </a>
                                    </div>

                                    <div>
                                        <a href="<?=base_url()?>" target="_blank" title="carou" class="nivo-imageLink">
                                            <img src="<?=base_url()?>/dist/home/img/banner/b4.jpg">
                                        </a>
                                    </div>

                                    <div>
                                        <a href="<?=base_url()?>" target="_blank" title="carou" class="nivo-imageLink">
                                            <img src="<?=base_url()?>/dist/home/img/banner/b5.jpg">
                                        </a>
                                    </div>


                                    <div class="owl-controls clickable">
                                        <div class="owl-pagination">
                                            <div class="owl-page"><span class=""></span></div>
                                            <div class="owl-page"><span class=""></span></div>
                                            <div class="owl-page"><span class=""></span></div>
                                            <div class="owl-page"><span class=""></span></div>
                                            <div class="owl-page"><span class=""></span></div>


                                        </div>
                                        <div class="owl-buttons">
                                            <div class="owl-prev"><span class="fa fa-angle-left"></span></div>
                                            <div class="owl-next"><span class="fa fa-angle-right"></span></div>
                                        </div>
                                    </div>
                                </div>
                                <!--                        <img src="https://m.soibien.vn/media/img/product/365/03/giowf%20vang%202019_0db1562310684.jpg?v=263">-->
                            </div>
                            <div
                                class="width-30 padding-left-5 no-padding-right col-lg-3 col-md-3 col-sm-12 col-xs-12 banner-top">

                                <a href=""><img src="<?=base_url()?>/dist/home/img/banner/banner1.jpg"></a>


                                <a href=""><img src="<?=base_url()?>/dist/home/img/banner/banner2.jpg"
                                        style="margin-top: 5px;"></a>

                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </main>

            <!--main-content-->
            <main class="content">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-5ths col-md-5ths hidden-sm hidden-xs left_menu">

                            <div class="right-product" style="display:none;">

                  
                            </div>


                            <div class="right-product" style="display:none;">
                 
                            </div>


                            <div class="news-left">
                                <!-- <span class="menu-content">Tin tức</span> -->





                            </div>

                        </div>
                        <script>
                        $('ul.left-nav li.level0.active ul.dropdown').slideUp();
                        $('ul.left-nav li.level0.active').hover(
                            function() {

                                $(this).find('ul.dropdown').slideDown();
                            },
                            function() {
                                $(this).find('ul.dropdown').slideUp();
                            })
                        </script>


                        <div class="col-lg-20ths col-md-20ths col-sm-20ths">


                            <div class="rows product-1">
                                <div class="titles"><span>Sản phẩm khuyến mại</span></div>
                                <div class=" product-wrapper">

                                <?php foreach($sale_products as $value) : ?>
                                    <div class="col-lg-25ths col-md-25ths col-sm-4 col-xs-6">
                                        <div class="product-item">
                                            <div class="image" style="height:213px;">
                                                <a href="<?=base_url()?>/san-pham/<?=$value->product_slug?>"
                                                    data-toggle="tooltip" data-html="true">
                                                    <img class="main_img"
                                                        src="<?=$value->image?>"
                                                        width="213" height="" alt="<?=$value->product_name?>">
                                                    <div class="bg_sale"
                                                        style="border-style: solid; border-width: 1px; border-color: #ebedf0; border-radius: 6px;">
                                                    </div>
                                                </a>
                                                <div class="tag_icon">
                                                    <?php if(!empty($value->tag_id)) : ?>
                                                        <img src="<?=$value->tag_image?>" height="26px" alt="">
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                            <div class="name" style="height: 55px;"><a
                                                    href="<?=base_url()?>/san-pham/<?=$value->product_slug?>"><?=$value->product_name?></a></div>

                                            <div class="price" style="float:left">
                                                <em><?=number_format(((int)$value->price*(100 - (int)$value->discount))/100,0,",",".")?>đ
                                                    <span class="variant_title">/<?=$value->unit_name?></span>
                                                </em>
                                            </div>
                                            <?php if($value->discount > 0) : ?>
                                                <div class="price-old1"><?=number_format((int)$value->price,0,",",".")?>đ</div>
                                                <div style="position: absolute; left: 3px; top: 4px; color: #fff; background: #ed1c24; padding: 4px 5px; font-size: 11px; line-height: 1; z-index: 999;
        border-radius: 6px;">-<?=$value->discount?>%</div>
                                            <?php endif ?>

                                            <div class="clear"></div>
                                            <div class="clearfix">
                                                <div class="p5 alert-success text-center hide" data-id="<?=$value->product_id?>">
                                                    <span class="small"><strong><span class="fa fa-check"></span></strong> Thêm
                                                        vào <span class="text-italic">giỏ hàng</span> thành công.</span>
                                                    <br><a href="/site/checkout" target="_blank" class="text-bold"
                                                        style="text-decoration: underline">Thanh toán đơn hàng</a>
                                                </div>
                                            </div>
                                            <div class="addcart addcart-collection">
                                                <button class="addtocart addcartcollection"
                                                    data-id="<?=$value->product_id?>"
                                                    data-handle="">
                                                    THÊM VÀO GIỎ <i class="fa fa-shopping-cart"
                                                        style="font-size:18px;color:#1bb522"></i>

                                                </button>

                                            </div>

                                        </div>
                                    </div>
                                <?php endforeach ?>


                                </div>
                                <div class="clear"></div>
                            </div>

                            <div class="rows product-1">
                                <div class="titles"><span>Sản phẩm bán chạy nhất</span></span></div>
                                <div class=" product-wrapper">

                                    <?php foreach($tag_products as $value) : ?>
                                        <div class="col-lg-25ths col-md-25ths col-sm-4 col-xs-6">
                                            <div class="product-item">
                                                <div class="image" style="height:213px;">
                                                    <a href="<?=base_url()?>/san-pham/<?=$value->product_slug?>"
                                                        data-toggle="tooltip" data-html="true">
                                                        <img class="main_img"
                                                            src="<?=$value->image?>"
                                                            width="213" height="" alt="<?=$value->product_name?>">
                                                        <div class="bg_sale"
                                                            style="border-style: solid; border-width: 1px; border-color: #ebedf0; border-radius: 6px;">
                                                        </div>
                                                    </a>
                                                    <div class="tag_icon">
                                                        <?php if(!empty($value->tag_id)) : ?>
                                                            <img src="<?=$value->tag_image?>" height="26px" alt="">
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                                <div class="name" style="height: 55px;"><a
                                                        href="<?=base_url()?>/san-pham/<?=$value->product_slug?>"><?=$value->product_name?></a></div>

                                                <div class="price" style="float:left">
                                                    <em><?=number_format(((int)$value->price*(100 - (int)$value->discount))/100,0,",",".")?>đ
                                                        <span class="variant_title">/<?=$value->unit_name?></span>
                                                    </em>
                                                </div>
                                                <?php if($value->discount > 0) : ?>
                                                    <div class="price-old1"><?=number_format((int)$value->price,0,",",".")?>đ</div>
                                                    <div style="position: absolute; left: 3px; top: 4px; color: #fff; background: #ed1c24; padding: 4px 5px; font-size: 11px; line-height: 1; z-index: 999;
            border-radius: 6px;">-<?=$value->discount?>%</div>
                                                <?php endif ?>

                                                <div class="clear"></div>
                                                <div class="clearfix">
                                                    <div class="p5 alert-success text-center hide" data-id="<?=$value->product_id?>">
                                                        <span class="small"><strong><span class="fa fa-check"></span></strong> Thêm
                                                            vào <span class="text-italic">giỏ hàng</span> thành công.</span>
                                                        <br><a href="/site/checkout" target="_blank" class="text-bold"
                                                            style="text-decoration: underline">Thanh toán đơn hàng</a>
                                                    </div>
                                                </div>
                                                <div class="addcart addcart-collection">
                                                    <button class="addtocart addcartcollection"
                                                        data-id="<?=$value->product_id?>"
                                                        data-handle="">
                                                        THÊM VÀO GIỎ <i class="fa fa-shopping-cart"
                                                            style="font-size:18px;color:#1bb522"></i>

                                                    </button>

                                                </div>

                                            </div>
                                        </div>
                                    <?php endforeach ?>


                                </div>
                                <div class="clear"></div>
                            </div>


                            <div class="rows product-2">
                                <div class="titles"><span>Sản phẩm mới</span></div>
                                <div class="product-wrapper">


                                    <?php foreach($new_products as $value) : ?>
                                        <div class="col-lg-25ths col-md-25ths col-sm-4 col-xs-6">
                                            <div class="product-item">
                                                <div class="image" style="height:213px;">
                                                    <a href="<?=base_url()?>/san-pham/<?=$value->product_slug?>"
                                                        data-toggle="tooltip" data-html="true">
                                                        <img class="main_img"
                                                            src="<?=$value->image?>"
                                                            width="213" height="" alt="<?=$value->product_name?>">
                                                        <div class="bg_sale"
                                                            style="border-style: solid; border-width: 1px; border-color: #ebedf0; border-radius: 6px;">
                                                        </div>
                                                    </a>
                                                    <div class="tag_icon">
                                                        <?php if(!empty($value->tag_id)) : ?>
                                                            <img src="<?=$value->tag_image?>" height="26px" alt="">
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                                <div class="name" style="height: 55px;"><a
                                                        href="<?=base_url()?>/san-pham/<?=$value->product_slug?>"><?=$value->product_name?></a></div>

                                                <div class="price" style="float:left">
                                                    <em><?=number_format(((int)$value->price*(100 - (int)$value->discount))/100,0,",",".")?>đ
                                                        <span class="variant_title">/<?=$value->unit_name?></span>
                                                    </em>
                                                </div>
                                                <?php if($value->discount > 0) : ?>
                                                    <div class="price-old1"><?=number_format((int)$value->price,0,",",".")?>đ</div>
                                                    <div style="position: absolute; left: 3px; top: 4px; color: #fff; background: #ed1c24; padding: 4px 5px; font-size: 11px; line-height: 1; z-index: 999;
            border-radius: 6px;">-<?=$value->discount?>%</div>
                                                <?php endif ?>

                                                <div class="clear"></div>
                                                <div class="clearfix">
                                                    <div class="p5 alert-success text-center hide" data-id="<?=$value->product_id?>">
                                                        <span class="small"><strong><span class="fa fa-check"></span></strong> Thêm
                                                            vào <span class="text-italic">giỏ hàng</span> thành công.</span>
                                                        <br><a href="/site/checkout" target="_blank" class="text-bold"
                                                            style="text-decoration: underline">Thanh toán đơn hàng</a>
                                                    </div>
                                                </div>
                                                <div class="addcart addcart-collection">
                                                    <button class="addtocart addcartcollection"
                                                        data-id="<?=$value->product_id?>"
                                                        data-handle="">
                                                        THÊM VÀO GIỎ <i class="fa fa-shopping-cart"
                                                            style="font-size:18px;color:#1bb522"></i>

                                                    </button>

                                                </div>

                                            </div>
                                        </div>
                                    <?php endforeach ?>

                                </div>
                                <div class="clear"></div>
                            </div>

                        </div>
                    </div>
                </div>
            </main>
            <script>
            $(document).ready(function() {
                if ($(window).width() < 768) {
                    var h = 0,
                        h2 = 0,
                        h3 = 0,
                        h4 = 0;
                    $(window).resize(function() {
                        $('.product-wrapper').hImageLoaded(function() {
                            $('.product-item').each(function() {
                                if ($(this).find('.image img').height() > h) {
                                    h = $(this).find('.image img').height();
                                }
                                if ($(this).height() > h2) {
                                    h2 = $(this).height();
                                }
                            })
                            $('.product-item').height(h2);
                        });
                    });
                }
            });
            </script>

        </div>