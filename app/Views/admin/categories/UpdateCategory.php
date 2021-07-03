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
            <form action="<?=cn('ajaxUpdateCategories')?>" data-redirect="<?=base_url("categories")?>" >
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category_name">Tên danh mục</label>
                                <input type="text" name="category_name" class="form-control convert-to-slug" slug-to="category_slug" id="category_name" value="<?=$result->category_name?>" placeholder="Nhập tên danh mục">
                                <input type="hidden" name="category_id" class="form-control" value="<?=$result->category_id?>" id="category_id">
                                <input type="hidden" name="old_name" class="form-control" value="<?=$result->category_name?>" id="old_name">
                            </div>
                            <div class="form-group">
                                <label for="category_slug">Slug</label>
                                <input type="text" name="category_slug" readonly="true" class="form-control" id="category_slug" value="<?=$result->category_slug?>" placeholder="Nhập slug danh mục">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="button" class="btn btn-primary btnPost">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>