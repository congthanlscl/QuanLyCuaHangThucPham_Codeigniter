<div class="row">
    <div class="col-12">
        <!-- /.card -->
        <form action="<?=cn('ajaxActionCategories')?>" data-redirect="<?=base_url("categories")?>">
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
                                <th>Tên danh mục</th>
                                <th>Slug</th>
                                <th>Ngày thêm</th>
                                <th>Ngày cập nhật</th>
                                <th>Tuỳ chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($result as $key => $value){ ?>
                            <tr data-id="<?=$value->category_id?>" data-action="<?=cn('ajaxDeleteCategories')?>" data-confirm="Xoá danh mục <?=$value->category_name?> ?">
                                <td><input type="checkbox" name="id[]" class="checkItem" value="<?=$value->category_id?>"></td>
                                <td><?=(int)$key + 1?></td>
                                <td><?=$value->category_name?></td>
                                <td><?=$value->category_slug?></td>
                                <td><?=$value->create_time?></td>
                                <td><?=$value->update_time?></td>
                                <td>
                                    <a href="<?=base_url("categories/updateCategories?id=".$value->category_id)?>" class="btn btn-info">Chỉnh sửa</a>
                                    <button type="button" data-id="<?=$value->category_id?>" class="btn btn-danger btn-delete-item">Xoá</button>
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