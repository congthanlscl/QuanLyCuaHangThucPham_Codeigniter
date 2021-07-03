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
            <form action="<?=cn('ajaxUpdateCustomer')?>" data-redirect="<?=base_url("customer")?>" >
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="customer_name">Tên khách hàng</label>
                                <input type="text" name="customer_name" readonly class="form-control" id="customer_name" value="<?=$result->customer_name?>" placeholder="Nhập tên khách hàng">
                                <input type="hidden" name="customer_id" class="form-control" value="<?=$result->customer_id?>" id="customer_id">
                            </div>
                            <div class="form-group">
                                <label for="customer_address">Địa chỉ</label>
                                <input type="text" name="customer_address" class="form-control" id="customer_address" value="<?=$result->customer_address?>" placeholder="Nhập địa chỉ">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="customer_phone">Số điện thoại</label>
                                <input type="text" name="customer_phone" class="form-control" id="customer_phone" value="<?=$result->customer_phone?>" placeholder="Nhập số điện thoại">
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