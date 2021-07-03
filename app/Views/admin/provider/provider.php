<div class="row">
    <div class="col-12">
        <!-- /.card -->
        <form action="<?=cn('ajaxActionProvider')?>" data-redirect="<?=base_url("provider")?>">
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
                                <th>Tên nhà cung cấp</th>
                                <th>Địa chỉ</th>
                                <th>Số điện thoại</th>
                                <th>Tuỳ chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($result as $key => $value){ ?>
                            <tr data-id="<?=$value->provider_id?>" data-action="<?=cn('ajaxDeleteProvider')?>" data-confirm="Xoá nhà cung cấp <?=$value->provider_name?> ?">
                                <td><input type="checkbox" name="id[]" class="checkItem" value="<?=$value->provider_id?>"></td>
                                <td><?=(int)$key + 1?></td>
                                <td><?=$value->provider_name?></td>
                                <td><?=$value->provider_address?></td>
                                <td><?=$value->provider_phone?></td>
                                <td>
                                    <a href="<?=base_url("provider/updateProvider?id=".$value->provider_id)?>" class="btn btn-info">Chỉnh sửa</a>
                                    <button type="button" data-id="<?=$value->provider_id?>" class="btn btn-danger btn-delete-item">Xoá</button>
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