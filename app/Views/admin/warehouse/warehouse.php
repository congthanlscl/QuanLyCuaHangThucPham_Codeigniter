<div class="row">
    <div class="col-12">
        <!-- /.card -->
        <form action="<?=cn('ajaxActionWarehouse')?>" data-redirect="<?=base_url("warehouse")?>">
            <div class="card">
                <div class="card-header">
                <button type="button" class="btn btn-danger btnActionModule" data-confirm="Xoá những dữ liệu đã chọn ?">Xóa dữ liệu đã chọn</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th><input type="checkbox" name="select_all" id="select_all" class="select_all"></th>
                                <th>STT</th>
                                <th>Tên nhà kho</th>
                                <th>Tuỳ chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($result as $key => $value){ ?>
                            <tr data-id="<?=$value->warehouse_id?>" data-action="<?=cn('ajaxDeleteWarehouse')?>" data-confirm="Xoá nhà kho <?=$value->warehouse_name?> ?">
                                <td><input type="checkbox" name="id[]" class="checkItem" value="<?=$value->warehouse_id?>"></td>
                                <td><?=(int)$key + 1?></td>
                                <td><?=$value->warehouse_name?></td>
                                <td>
                                    <a href="<?=base_url("warehouse/updateWarehouse?id=".$value->warehouse_id)?>" class="btn btn-info">Chỉnh sửa</a>
                                    <button type="button" data-id="<?=$value->warehouse_id?>" class="btn btn-danger btn-delete-item">Xoá</button>
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