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
            <form action="<?=cn('ajaxAddWarehouse')?>" data-redirect="<?=base_url("warehouse")?>" >
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="warehouse_name">Tên nhà kho</label>
                                <input type="text" name="warehouse_name" class="form-control" id="warehouse_name" placeholder="Nhập tên nhà kho">
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