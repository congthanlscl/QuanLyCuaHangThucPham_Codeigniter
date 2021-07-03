<div class="row">
    <div class="col-12">
        <!-- /.card -->
        <form action="<?=cn('ajaxActionCustomer')?>" data-redirect="<?=base_url("customer")?>">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-danger btnActionModule" data-confirm="Xoá những dữ liệu đã chọn ?">Xóa dữ liệu đã chọn</button>
                    <button type="button" data-toggle="modal" data-target="#add-customer" class="btn btn-primary">Thêm khách hàng</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th><input type="checkbox" name="select_all" id="select_all" class="select_all"></th>
                                <th>STT</th>
                                <th>Tên khách hàng</th>
                                <th>Địa chỉ</th>
                                <th>Số điện thoại</th>
                                <th>Tuỳ chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($result as $key => $value){ ?>
                            <tr data-id="<?=$value->customer_id?>" data-action="<?=cn('ajaxDeleteCustomer')?>" data-confirm="Xoá khách hàng <?=$value->customer_name?> ?">
                                <td><input type="checkbox" name="id[]" class="checkItem" value="<?=$value->customer_id?>"></td>
                                <td><?=(int)$key + 1?></td>
                                <td><?=$value->customer_name?></td>
                                <td><?=$value->customer_address?></td>
                                <td><?=$value->customer_phone?></td>
                                <td>
                                    <a href="<?=base_url("customer/updateCustomer?id=".$value->customer_id)?>" class="btn btn-info">Chỉnh sửa</a>
                                    <button type="button" data-id="<?=$value->customer_id?>" class="btn btn-danger btn-delete-item">Xoá</button>
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

<div class="modal fade" id="add-customer" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Thêm khách hàng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?=cn('ajaxAddCustomer')?>" data-redirect="<?=base_url("customer")?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="customer_name">Tên khách hàng</label>
                        <input type="text"class="form-control" name="customer_name" id="customer_name" placeholder="Nhập tên khách hàng">
                    </div>
                    <div class="form-group">
                        <label for="customer_address">Địa chỉ</label>
                        <input type="text"class="form-control" name="customer_address" id="customer_address" placeholder="Nhập địa chỉ">
                    </div>
                    <div class="form-group">
                        <label for="customer_phone">Số điện thoại</label>
                        <input type="text"class="form-control" name="customer_phone" id="customer_phone" placeholder="Nhập số điện thoại">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close-modal-pack" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btnPost">Thêm mới</button>
                </div>
            </form>
        </div>
    </div>
</div>