<div class="row">
    <div class="col-12">
        <!-- /.card -->
        <form action="<?=cn('ajaxActionTags')?>" data-redirect="<?=base_url("tags")?>">
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
                                <th>Ảnh nhãn</th>
                                <th>Tên nhãn</th>
                                <th>Tuỳ chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($result as $key => $value){ ?>
                            <tr data-id="<?=$value->tag_id?>" data-action="<?=cn('ajaxDeleteTags')?>" data-confirm="Xoá nhãn <?=$value->tag_name?> ?">
                                <td>
                                    <?php if(!empty($value->tag_id)) : ?>
                                        <input type="checkbox" name="id[]" class="checkItem" value="<?=$value->tag_id?>">
                                    <?php endif ?>
                                </td>
                                <td><?=(int)$key + 1?></td>
                                <td><img src="<?=$value->tag_image?>" /></td>
                                <td><?=$value->tag_name?></td>
                                <td>
                                    <?php if(!empty($value->tag_id)) : ?>
                                        <a href="<?=base_url("tags/updateTags?id=".$value->tag_id)?>" class="btn btn-info">Chỉnh sửa</a>
                                        <button type="button" data-id="<?=$value->tag_id?>" class="btn btn-danger btn-delete-item">Xoá</button>
                                    <?php endif ?>
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