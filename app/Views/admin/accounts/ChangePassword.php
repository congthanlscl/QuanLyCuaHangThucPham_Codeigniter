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
            <form action="<?=cn('ajaxChangePassword')?>" data-redirect="<?=base_url("admin")?>" >
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="oldPassword">Password</label>
                                <div class="input-group focused">
                                    <input type="password" name="oldPassword" class="form-control" id="oldPassword" placeholder="Nhập mật khẩu hiện tại">
                                    <span class="input-group-append">
                                        <i class="btn btn-primary toggle-password" data-id="oldPassword">Hiện</i>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="newPassword">Password mới</label>
                                <div class="input-group focused">
                                    <input type="password" class="form-control" name="newPassword" id="newPassword" placeholder="Nhập mật khẩu mới">
                                    <span class="input-group-append">
                                        <i class="btn btn-primary toggle-password" data-id="newPassword">Hiện</i>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="repeatPassword">Nhập lại mật khẩu mới</label>
                                <div class="input-group focused">
                                    <input type="password" class="form-control" name="repeatPassword" id="repeatPassword" placeholder="Nhập lại mật khẩu mới">
                                    <span class="input-group-append">
                                        <i class="btn btn-primary toggle-password" data-id="repeatPassword">Hiện</i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="button" class="btn btn-primary btnPost">Submit</button>
                    <!-- <button type="button" class="btn btn-primary">Tải file mẫu</button> -->
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $(document).on("click", ".toggle-password", function(){
            let input_id = $(this).attr("data-id");
            let type = $("#"+input_id).attr("type");
            if(type == "text"){
                $("#"+input_id).attr("type", "password");
                $(this).text("Hiện");
            }
            else if(type =="password"){
                $("#"+input_id).attr("type", "text");
                $(this).text("Ẩn");
            }
        })
    })
</script>