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
            <form action="<?=cn('ajaxUpdateProvider')?>" data-redirect="<?=base_url("provider")?>" >
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="provider_name">Tên nhà cung cấp</label>
                                <input type="hidden" name="provider_id" value="<?=$result->provider_id?>" readonly="true" class="form-control" id="provider_id" >
                                <input type="text" name="provider_name" value="<?=$result->provider_name?>" readonly="true" class="form-control" id="provider_name" placeholder="Nhập tên cung cấp">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="provider_address">Địa chỉ</label>
                                <input type="text" name="provider_address" value="<?=$result->provider_address?>" class="form-control" id="provider_address" placeholder="Địa chỉ">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="provider_phone">Số điện thoại</label>
                                <input type="text" name="provider_phone" value="<?=$result->provider_phone?>" class="form-control" id="provider_phone" placeholder="Số điện thoại">
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