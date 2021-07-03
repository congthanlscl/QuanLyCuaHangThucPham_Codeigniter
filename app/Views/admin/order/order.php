<div class="row">
    <div class="col-12">
        <!-- /.card -->
        <form action="<?=cn('ajaxActionOrder')?>" data-redirect="<?=base_url("order")?>">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-inline">
                                <div class="form-group">
                                    <label for="status">Trạng thái đơn hàng :</label>
                                    <select style="margin-left:10px" class="custom-select" name="status" id="status">
                                    <?php foreach($status as $index => $value) : ?>
                                        <option value="<?=$index?>" <?=($index == $selected_status) ? "selected" : ""?>><?=$value?></option>
                                    <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th><input type="checkbox" name="select_all" id="select_all" class="select_all"></th>
                                <th>STT</th>
                                <th>Mã đơn hàng</th>
                                <th>Khách hàng</th>
                                <th>Địa chỉ khách hàng</th>
                                <th>Số điện thoại khách hàng</th>
                                <th>Ngày tạo đơn</th>
                                <th>Trạng thái</th>
                                <th>Tuỳ chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($result as $key => $value){ ?>
                            <tr data-id="<?=$value->bill_id?>" data-action="<?=cn('ajaxDeleteOrder')?>" data-confirm="Xoá đơn hàng <?=$value->bill_id?> ?">
                                <td>
                                    <input type="checkbox" name="id[]" class="checkItem" value="<?=$value->bill_id?>">
                                </td>
                                <td><?=(int)$key + 1?></td>
                                <td><?=$value->bill_id?></td>
                                <td><?=$value->customer_name?></td>
                                <td><?=$value->customer_address?></td>
                                <td><?=$value->customer_phone?></td>
                                <td><?=date("d-m-y", strtotime($value->create_time))?></td>
                                <td><?=$status[$value->status]?></td>
                                <td>
                                    <?php if($value->status == 2) : ?>
                                        <button type="button" data-id="<?=$value->bill_id?>" data-status="1" class="btn btn-info" id="update-status" data-toggle="modal" data-target="#update-order-status" title="Duyệt đơn hàng"><i class="fas fa-check"></i></i></button>
                                    <?php endif ?>
                                    <button type="button" data-id="<?=$value->bill_id?>" data-toggle="modal" data-target="#order-detail" class="btn btn-warning btn-get-detail" title="Xem chi tiết"><i class="fas fa-info-circle"></i></button>
                                    <button type="button" data-action="<?=base_url("order/printBill?id=".$value->bill_id)?>" class="btn btn-secondary btn-print" title="In hoá đơn"><i class="fas fa-print"></i></button>
                                    <button type="button" data-id="<?=$value->bill_id?>" class="btn btn-danger btn-delete-item" title="Xoá đơn hàng"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            </form>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="order-detail" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Mã nhập hàng :</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn vị</th>
                            <th>Giá</th>
                            <th>Số tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="update-order-status" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?=cn('ajaxUpdateStatus')?>" data-redirect="<?=base_url("order")?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Duyệt đơn hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="warehouse">Chọn kho xuất</label>
                        <input type="hidden" name="bill_id" id="bill_id" value="">
                        <input type="hidden" name="status" id="status" value="">
                        <select class="custom-select select2" name="warehouse" id="warehouse">
                        <?php foreach($warehouse as $value) : ?>
                            <option value="<?=$value->warehouse_id?>"><?=$value->warehouse_name?></option>
                        <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btnPost"><i class="fas fa-check"></i> Lưu</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function(){

        $(document).on('click', '.btn-get-detail', function(){
            let id = $(this).attr("data-id");
            $.get(BASE + "/order/getOrderDetail", {id:id}, function(res){
                if(res.st == "success"){
                    
                    let tbody = '';
                    let data = res.data;
                    let total = 0;
                    data.forEach((value, index) => {
                        
                        tbody += `<tr>
                            <td>${index + 1}</td>
                            <td>${value.product_name}</td>
                            <td>${value.quantity}</td>
                            <td>${value.unit_name}</td>
                            <td>${parseInt(value.price).toLocaleString('it-IT', {style : 'currency', currency : 'VND'})}</td>
                            <td>${parseInt(value.total).toLocaleString('it-IT', {style : 'currency', currency : 'VND'})}</td>
                        </tr>`;
                        total += parseInt(value.total);
                    });

                    tbody += `<tr style="font-weight: 600;">
                            <td colspan="5" style="text-align:center">Tổng cộng</td>
                            <td>${total.toLocaleString('it-IT', {style : 'currency', currency : 'VND'})}</td>
                        </tr>`;

                    $("#order-detail tbody").html(tbody);
                    $("#order-detail .modal-title").text("Mã nhập hàng : " + id);
                }
            },'json');
        });

        $("#status").change(function(e){

            let status = $("#status").val();

            let url = BASE + "/order?&status="+status;
            window.location.assign(url);
        })

        $(document).on("click", "#update-status", function(e){

            let bill_id = $(this).attr("data-id");
            let status = $(this).attr("data-status");
            
            $("#update-order-status #bill_id").val(bill_id);

            $("#update-order-status #status").val(status);
        })

    })
</script>