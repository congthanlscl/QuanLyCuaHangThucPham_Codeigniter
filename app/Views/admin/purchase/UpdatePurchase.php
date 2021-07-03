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
            <form action="<?=cn('ajaxUpdatePurchase')?>" data-redirect="<?=base_url("purchase")?>">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nhà cung cấp</label>
                                <input type="hidden" name="input_id" value="<?=$purchase->input_id?>">
                                <select class="custom-select select2" name="provider" id="provider">
                                <?php foreach($provider as $value) : ?>
                                    <option value="<?=$value->provider_id?>" <?=($purchase->provider_id == $value->provider_id) ? "selected" : ""?>><?=$value->provider_name?></option>
                                <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nhà kho</label>
                                <select class="custom-select select2" name="warehouse" id="warehouse">
                                <?php foreach($warehouse as $value) : ?>
                                    <option value="<?=$value->warehouse_id?>" <?=($purchase->warehouse_id == $value->warehouse_id) ? "selected" : ""?>><?=$value->warehouse_name?></option>
                                <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group date" id="create_time" data-target-input="nearest">
                                <label for="create_time">Ngày nhập</label>
                                <div class="input-group">
                                    <input type="text" name="create_time" class="form-control datetimepicker-input" data-target="#create_time">
                                    <div class="input-group-append" data-target="#create_time" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="button" class="btn btn-primary btnPost"><i class="fas fa-check"></i> Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){

        $('#create_time').datetimepicker({
            date:new Date('<?=$purchase->create_time?>'),
            format: 'DD/MM/YYYY'
        });
        
    })
</script>