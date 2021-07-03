<div class="row">
    <div class="col-12">
        <!-- /.card -->
        <form action="<?=cn('ajaxActionPurchase')?>" data-redirect="<?=base_url("purchase")?>">
            <div class="card">
                <div class="card-header">
                    <!-- <button type="button" class="btn btn-danger btnActionModule" data-confirm="Xoá những dữ liệu đã chọn ?">Xóa dữ liệu đã chọn</button> -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th><input type="checkbox" name="select_all" id="select_all" class="select_all"></th>
                                <th>STT</th>
                                <th>Mã nhập hàng</th>
                                <th>Nhà cung cấp</th>
                                <th>Kho hàng</th>
                                <th>Ngày nhập</th>
                                <th>Tuỳ chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($result as $key => $value){ ?>
                            <tr data-id="<?=$value->input_id?>" data-action="<?=cn('ajaxDeletePurchase')?>" data-confirm="Xoá đơn nhập hàng <?=$value->input_id?> ? (Lưu ý: Số lượng tồn kho sẽ bị trừ theo nhập hàng bị xoá)">
                                <td>
                                    <input type="checkbox" name="id[]" class="checkItem" value="<?=$value->input_id?>">
                                </td>
                                <td><?=(int)$key + 1?></td>
                                <td><?=$value->input_id?></td>
                                <td><?=$value->provider_name?></td>
                                <td><?=$value->warehouse_name?></td>
                                <td><?=date("d-m-y", strtotime($value->create_time))?></td>
                                <td>
                                    <a href="<?=base_url("purchase/updatePurchase?id=".$value->input_id)?>" class="btn btn-info" title="Chỉnh sửa"><i class="fas fa-edit"></i></a>
                                    <button type="button" data-id="<?=$value->input_id?>" data-toggle="modal" data-target="#purchase-detail" class="btn btn-warning btn-get-detail" title="Xem chi tiết"><i class="fas fa-info-circle"></i></button>
                                    <button type="button" data-action="<?=base_url("purchase/printBill?id=".$value->input_id)?>" class="btn btn-secondary btn-print" title="In hoá đơn nhập kho"><i class="fas fa-print"></i></button>
                                    <button type="button" data-id="<?=$value->input_id?>" class="btn btn-danger btn-delete-item" title="Xoá đơn nhập hàng"><i class="fas fa-trash-alt"></i></button>
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

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="purchase-detail" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                            <th>Giá nhập</th>
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

<script src="<?=base_url()?>/dist/js/purchase/purchase.js"></script>