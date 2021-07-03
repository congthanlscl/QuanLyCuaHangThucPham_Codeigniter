<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Nhập biểu mẫu</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="<?=cn('ajaxAddPurchase')?>" data-redirect="<?=base_url("purchase")?>">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="order-search" style="margin: 10px 0px; position: relative;">
                                <input type="text" class="form-control ui-autocomplete-input"
                                    placeholder="Nhập mã sản phẩm hoặc tên sản phẩm" id="search-pro-box"
                                    autocomplete="off">
                                <script>
                                $(function() {
                                    $("#search-pro-box").autocomplete({
                                            minLength: 1,
                                            source: BASE + '/admin/getProducts',
                                            focus: function(event, ui) {
                                                // console.log(ui);
                                                $("#search-pro-box").val(ui.item.product_id);
                                                return false;
                                            },
                                            select: function(event, ui) {
                                                select_product(ui.item);
                                                // console.log(ui);
                                                $("#search-pro-box").val('');
                                                return false;
                                            },
                                            response: function(event, ui) {
                                                if (!ui.content.length) {
                                                    var noResult = { value:"",label:"Không tìm thấy sản phẩm" };
                                                    ui.content.push(noResult);
                                                }
                                            }
                                        })
                                        .autocomplete("instance")._renderItem = function(ul, item) {
                                            // console.log(item);
                                            if(item.product_id != undefined){
                                                return $("<li>")
                                                    .append("<div>" + item.product_id + " - " + item.product_name +
                                                        "</div>")
                                                    .appendTo(ul);
                                            }
                                            else{
                                                return $("<li>")
                                                    .append("<div>" + item.label +
                                                        "</div>")
                                                    .appendTo(ul);
                                            }
                                        };
                                });
                                </script>
                            </div>
                            <div class="product-results">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Mã sản phẩm</th>
                                            <th>Tên sản phẩm</th>
                                            <th class="text-center">Hình ảnh</th>
                                            <th class="text-center">Số lượng</th>
                                            <th class="text-center">ĐVT</th>
                                            <th class="text-center">Giá nhập (VNĐ)</th>
                                            <th class="text-center">Thành tiền (VNĐ)</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="pro_search_append">

                                    </tbody>
                                    <tbody>
                                        <tr>
                                            <td class="text-center" colspan="6">Tổng tiền</td>
                                            <td class="text-center" colspan="2" id="total">0 VND</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="alert alert-success" style="margin-top: 30px;" role="alert">Gõ mã hoặc tên
                                    sản phẩm vào hộp
                                    tìm kiếm để thêm hàng vào đơn hàng
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding-left: 20px;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Nhà cung cấp</label>
                                        <select class="custom-select select2" name="provider" id="provider">
                                        <?php foreach($provider as $value) : ?>
                                            <option value="<?=$value->provider_id?>"><?=$value->provider_name?></option>
                                        <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Nhà kho</label>
                                        <select class="custom-select select2" name="warehouse" id="warehouse">
                                        <?php foreach($warehouse as $value) : ?>
                                            <option value="<?=$value->warehouse_id?>"><?=$value->warehouse_name?></option>
                                        <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group date" id="create_time" data-target-input="nearest">
                                        <label for="create_time">Ngày nhập</label>
                                        <div class="input-group">
                                            <input type="text" name="create_time" class="form-control datetimepicker-input" data-target="#create_time">
                                            <div class="input-group-append" data-target="#create_time" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="button" class="btn btn-primary btnPost"><i class="fas fa-check"></i> Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){

        let date = new Date();
        $('#create_time').datetimepicker({
            defaultDate:date,
            format: 'DD/MM/YYYY'
        });
        
    })
</script>