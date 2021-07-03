<style>
    @media only screen and (min-width:1024px) {
        .p5sub {
            margin-left: 150px;
            margin-right: 150px;
        }
    }
    .menu-linklist-item-wrap{
        width: 100%;
    }
</style>
<div class="wraper ">
    <!--    <img src="https://file.hstatic.net/1000030244/collection/ngang_sashimi_deli_663d54526b5842cea7e95975d7a761a5.jpg" class="object-fit_cover img-responsive">-->

    <div class="menu-linklist-item-wrap" id="sashimi">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h3>
                        <span><?=$category->category_name?></span>
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="p5 p5sub">
        <div class="box clearfix">
        <?php foreach($products as $value) : ?>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-col">
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
    </div>
</div>