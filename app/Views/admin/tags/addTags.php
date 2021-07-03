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
            <form action="<?=cn('ajaxAddTags')?>" data-redirect="<?=base_url("tags")?>" >
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tag_name">Tên nhãn</label>
                                <input type="text" name="tag_name" class="form-control" id="tag_name" placeholder="Nhập tên nhãn">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tag_image">Hình ảnh nhãn</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" accept="image/*" id="tag_image" name="tag_image">
                                        <label class="custom-file-label" for="tag_image">Chọn nhãn</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Tải lên</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="button" class="btn btn-primary btnPostFile">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>