
<div class="colorgb-sub-content">
    <div class="p5">
        <div class="content-header">Vui lòng nhập thông tin</div>

        <div class="content-main site-checkout">

            <div class="tab-content">
                <div id="menu1" class="tab-pane fade in active">

                    <form class="cform colorgb-form">
                        <div class="contact-form">
                            <div class="cf-field">
                                <input id="name" type="text" placeholder="Tên của bạn" value="">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="cf-field">
                                <input id="tel" type="number" placeholder="Số điện thoại" value="">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="cf-field">
                                <textarea style="height: 50px" id="address" type="text"
                                    placeholder="Địa chỉ nhận giao hàng"></textarea>
                            </div>
                            <div class="cf-field">
                                <textarea id="note" type="text" placeholder="Ghi chú giao hàng"></textarea>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <div class="content-footer">
        <div class="total">
            <div class="clearfix">
                <div class="pull-left text-bold">Tổng cộng</div>
                <div class="pull-right text-green"> <?=number_format($cart["total"],0,",", ".")?>đ</div>
            </div>

            <div class="clearfix">
                <a href="" class="btn btn-checkout">
                    <i class="fa fa-money"></i> <span>Đặt hàng</span>
                </a>
            </div>

        </div>
    </div>

    <script>

    $('.btn-checkout').click(function(e) {

        var name = $('.colorgb-form #name');
        var tel = $('.colorgb-form #tel');
        var address = $('.colorgb-form #address');
        var note = $('.colorgb-form #note');
        var t = $(this);
        e.preventDefault();
        if (name.val() == '') {
            $('.site-checkout .nav-pills li:nth-child(1) a').trigger('click');
            alert('Vui lòng nhập họ tên hợp lệ!');
            name.focus();
        } else if (tel.val() == '') {
            $('.site-checkout .nav-pills li:nth-child(1) a').trigger('click');
            alert('Vui lòng nhập số điện thoại hợp lệ!');
            tel.focus();
        } else if (address.val() == '') {
            $('.site-checkout .nav-pills li:nth-child(1) a').trigger('click');
            alert('Vui lòng nhập địa chỉ giao hàng hợp lệ!');
            address.focus();
        } else {
            t.find('.fa').removeClass('fa-paper-plane-o').addClass('fa-spinner fa-spin')
            t.find('span').html('Đang xử lý đơn hàng...');
            $.ajax({
                url: baseUrl + "ajaxOrder?name=" + name.val() + "&tel=" + tel.val() + "&address=" +
                    address.val() + "&note=" + note.val(),
                success: function(result) {
                    result = JSON.parse(result);
                    alert(result.message);
                    if(result.st == "success"){
                        window.location = baseUrl;
                    }

                }
            });
        }

    });
    </script>
</div>