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
            <form action="<?=cn('ajaxUpdateUnits')?>" data-redirect="<?=base_url("units")?>" >
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="unit_name">Tên đơn vị</label>
                                <input type="hidden" name="unit_id" value="<?=(!empty($result->unit_id)) ? $result->unit_id : ""?>" class="form-control" id="unit_id">
                                <input type="hidden" name="old_name" value="<?=(!empty($result->unit_name)) ? $result->unit_name : ""?>" class="form-control" id="old_name">
                                <input type="text" name="unit_name" value="<?=(!empty($result->unit_name)) ? $result->unit_name : ""?>" class="form-control" id="unit_name" placeholder="Nhập tên đơn vị">
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