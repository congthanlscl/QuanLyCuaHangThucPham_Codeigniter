
<div class="colorgb-sub-content">
    <style>
    .input-group .input-group-btn .btn[data-type="minus"] {
        border-top-left-radius: 10px !important;
        border-bottom-left-radius: 10px !important;
    }

    .input-group .form-control {
        box-shadow: none;
    }

    .input-group .input-group-btn .btn[data-type="plus"] {
        border-top-right-radius: 10px !important;
        border-bottom-right-radius: 10px !important;
    }

    .input-group .input-group-btn .btn {
        background: #fff;
        border-color: #ccc;
        color: #333;
        border-radius: 0 !important;
    }

    @media all and (min-width: 1000px) {
        .colorgb-sub-page .item .qty {
            width: 140px !important;
        }

        .colorgb-sub-page .colorgb-qty {
            width: 68px !important;
        }
    }
    </style>
    <div class="p5">
        <div class="content-header">Giỏ hàng</div>

    </div>
    <div class="content-main">
        <?php if(!empty($cart)) {?>
        <?php foreach($cart["data"] as $value) :?>
        <div class="item">
            <div class="media">
                <div class="media-left">
                    <img src="<?=$value->image?>" class="media-object">
                </div>
                <div class="media-body">
                    <a href="<?=base_url()?>/san-pham/<?=$value->product_slug?>"
                        class="media-heading"><?=$value->product_name?></a>
                    <p>Đơn giá: <span
                            class="price-new"><?=number_format($value->price, 0, ",", ".")?>đ/<?=$value->unit_name?></span>
                    </p>
                    <p>Thành tiền: <span class="price"><?=number_format($value->amount, 0, ",", ".")?>đ</span></p>

                </div>
                <div class="media-custom clearfix">
                    <div class="pull-left">
                        Số lượng <br> (<strong style="color: #006a14"><?=$value->unit_name?></strong>)
                    </div>
                    <div class="pull-right">
                        <div class="qty clearfix" style="width: 117px">

                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary btn-number" data-type="minus"
                                        data-field="quant<?=$value->product_id?>[1]">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </span>
                                <input data-pid="<?=$value->product_id?>" name="quant<?=$value->product_id?>[1]"
                                    type="number" class="form-control input-number input-xs colorgb-qty" min="1"
                                    step="1" max="100" style="width: 50px;display: inline-block;"
                                    value="<?=$value->quantity?>">

                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary btn-number" data-type="plus"
                                        data-field="quant<?=$value->product_id?>[1]">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="/remove_cart?pid=<?=$value->product_id?>" class="remove"><span class="fa fa-close"></span></a>
            </div>
        </div>
        <?php endforeach ?>
        <?php }else{ ?>
        <div class="alert alert-warning">Không có sản phẩm nào trong giỏ hàng của bạn</div>
        <?php } ?>
    </div>
    <div class="content-footer">
        <div class="total">
            <?php if(!empty($cart)) :?>
                <div class="clearfix">
                    <div class="pull-left text-bold">Tổng cộng</div>
                    <div class="pull-right total text-green" style="padding: 0">
                        <?=number_format($cart["total"],0,",", ".")?>đ</div>
                </div>
            <?php endif ?>
            <div class="clearfix">
                <?php if(!empty($cart)) {?>
                    <a href="site/checkout" class="btn btn-order">
                        <i class="fa fa-paper-plane-o"></i> Đặt hàng
                    </a>
                <?php }else{ ?>
                    <a href="/" class="btn btn-order">
                        <i class="fa fa-long-arrow-left"></i> Trở về trang chủ
                    </a>
                <?php } ?>
            </div>

        </div>
    </div>

    <script>
    $(function() {


        $('.colorgb-qty').on('focus change', function() {
            var t = $(this);
            $.ajax({
                url: baseUrl + "update-cart?qty=" + t.val() + "&pid=" + t.data(
                    'pid'),
                success: function(result) {
                    var json = JSON.parse(result);
                    t.parent().parent().parent().parent().parent().find(
                        '.media-body p .price').html(json.cart.amount);
                    // $('.content-footer .total .pull-right.subtotal').html(json
                    //     .subtotal);
                    $('.content-footer .total .pull-right.total').html(json.total);
                }
            });
        });

    })
    </script>
</div>