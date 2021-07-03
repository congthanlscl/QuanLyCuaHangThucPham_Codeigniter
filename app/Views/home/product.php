<style>
    .label img {
        height: initial !important;
    }

    .label {
        position: absolute;
    }

    .label-left {
        left: 0;
    }

    .label-right {
        right: 0;
    }

      .pricergb {
        font-size: 22px;
        color: #006a14;
        vertical-align: middle;
        font-weight: bold;
    }

    .pricetong {
        font-size: 18px;
        color: #f36523;
        font-weight: bold;
    }
    .price-old {
        display: inline-block;
        vertical-align: middle;
        font-size: 14px;
        color: #999;
        text-decoration: line-through;
        margin-left: 5px;
    }

    .percent-giam {
        display: inline-block;
        vertical-align: middle;
        font-size: 12px;
        color: #fff;
        font-weight: 600;
        border-radius: 3px;
        background: #de2000;
        width: 32px;
        height: 20px;
        line-height: 20px;
        text-align: center;
        margin-left: 5px;
    }

    .colorgb-hide {
        float: left;
        width: 100%;
    }

    .themvaogiobtn {
        background: #fff;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
        border: 2px solid #4CAF50;
        width: 100%;
        padding: 6px 10px;
        float: left;
        color: #329439;
    }
    .senddanhgia{
        color: #006a14;
        font-style: italic;
        font-size: medium;
    }

    .chonkhoiluong{
        border-radius: 6px;
        color: #222222;
        background-color: white;
        border-color: #cccccc;
    }

    .bangkhoiluong{
        border-spacing: 3px;
    }
</style>
<div class="wraper container">
    <main>
        <div class="container">
            <div class="row">
                <div class="width-20 col-lg-3 col-md-3"></div>
                <div
                    class="width-80 no-padding-right padding-left-5 col-lg-9 col-md-9 col-sm-12 col-xs-12 slider-wrapper">

                    <div class="width-70 no-padding col-lg-9 col-md-9 col-sm-12 col-xs-12">
                        <div class="p5 single-product clearfix">
                            <div class="box clearfix">
                                <div class="box-content clearfix" style="background: #fff;margin-bottom: 10px;">
                                    <div class="img" style="text-align: center;border: 1px solid #dddddd;margin: 10px;">
                                        <?php if(!empty($product->tag_id)): ?>
                                            <span class="label label-left"><img src="<?=$product->tag_image?>" width="50px"
                                                    alt=""></span>
                                        <?php endif ?>

                                        <img id="mainimg"
                                            src="<?=$product->image?>">


                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="width-30 padding-left-5 no-padding-right col-lg-3 col-md-3 col-sm-12 col-xs-12 banner-top">
                        <div style="margin: 0px 10px 10px 10px;">
                            <div class="box clearfix">
                                <h1 style="font-size: x-large;color: #039a1f;"><?=$product->product_name?></h1>


                                <div class="price">
                                    <div>Đơn giá:</div>
                                    <span id="pp-price-colorrgb" class="pricergb" data-price-new="<?=((int)$product->price*(100 - (int)$product->discount))/100?>"><?=number_format(((int)$product->price*(100 - (int)$product->discount))/100,0,",",".")?>
                                        đ/<?=$product->unit_name?></span>
                                    <?php if($product->discount > 0) : ?>
                                        <del class="price-old"><?=number_format((int)$product->price,0,",",".")?>đ
                                        </del>
                                        <span class="percent-giam">
                                            -<?=$product->discount?>%
                                        </span>
                                    <?php endif ?>

                                </div>
                                <div class="price">
                                    Thành tiền:
                                    <div class="pricetong" id="divproducttong" data-price-new="<?=((int)$product->price*(100 - (int)$product->discount))/100?>"><?=number_format(((int)$product->price*(100 - (int)$product->discount))/100,0,",",".")?> đ
                                    </div>
                                </div>
                                <div class="price"><span>Số Lượng: </span><span id="pp-sl"
                                        style="color: #FF5722;font-weight: bold;">1</span><span> <?=$product->unit_name?></span> </div>

                            </div>
                            <div class="box clearfix">
                                <div class="qty clearfix">
                                    <div class="pull-left">Số lượng:</div>
                                    <div class="pull-right">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-primary btn-number"
                                                    disabled="disabled" data-type="minus" data-field="quant[1]" style="
    background-color: #006a14;
    border-color: #003c0b;
">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </span>
                                            <input type="text" name="quant[1]" id="txtproductsl"
                                                class="form-control input-number" value="1" min="1" max="100">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-primary btn-number"
                                                    data-type="plus" data-field="quant[1]" style="
    background-color: #006a14;
    border-color: #003c0b;
">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="content-footer">
                                <div class="total">
                                    <div class="clearfix">
                                        <div class="p5 alert-success text-center hide" data-id="<?=$product->product_id?>">
                                            <span class="small"><strong><span class="fa fa-check"></span></strong> Thêm
                                                vào <span class="text-italic">giỏ hàng</span> thành công.</span>
                                            <br><a href="/site/checkout" target="_blank" class="text-bold"
                                                style="text-decoration: underline">Thanh toán đơn hàng</a>
                                        </div>
                                    </div>
                                    <div style="padding-top:10px; text-align: center">
                                        <input type="hidden" id="pid" value="<?=$product->product_id?>">
                                        <a href="javascript:void(0)" class="themvaogiobtn" id="btnAddToCart">
                                            <i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="clear"></div>
                    <div style="margin:10px;"></div>
                    <div class="width-70 no-padding col-lg-9 col-md-9 col-sm-12 col-xs-12">
                        <div class="colorgb-hide">
                            <div class="panel-group">
                                <div class="panel panel-default">

                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" href="#collapse1">Mô tả sản phẩm</a>
                                        </h4>
                                    </div>
                                    <div id="collapse1" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <h3 dir="ltr" style="text-align:center"><?=$product->product_name?></h3>

                                            <?=$product->description?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>


            </div>
        </div>
    </main>

</div>
<style>
    .panel-body * {
        max-width: 100%;
    }

    .content-footer .btn-order.disabled {
        background: #9E9E9E !important;
        cursor: not-allowed;
        pointer-events: none;
    }
</style>