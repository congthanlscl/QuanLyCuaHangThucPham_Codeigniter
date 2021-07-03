<div class="fadeIn first">
    <img src="../../dist/img/logo/logofull.png" id="icon" alt="Logo" style="margin-top:10%; margin-bottom:10%" />
</div>

<!-- Forgot Form -->
<form action="<?=cn('ajaxForgotPassword')?>" data-redirect="<?=base_url("admin")?>" >
    <input type="text" id="email" class="fadeIn second btnPostEnter" name="email" placeholder="Nhập email">
    <button type="button" class="btn btn-info fadeIn fourth btnPost">Gửi lên</button>
</form>

<!-- Remind Passowrd -->
<div id="formFooter">
    <a class="underlineHover" href="<?=base_url("admin")?>">Quay lại trang đăng nhập</a>
</div>
