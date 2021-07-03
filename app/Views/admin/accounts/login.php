<div class="fadeIn first">
    <img src="../../dist/home/img/logo1.png" id="icon" alt="Logo" style="margin-top:10%; margin-bottom:10%" />
</div>

<!-- Login Form -->
<form action="<?=cn('ajaxLogin')?>" data-redirect="<?=base_url("order")?>" >
    <input type="text" id="email" class="fadeIn second btnPostEnter" name="email" placeholder="Nhập email">
    <input type="password" id="password" class="fadeIn third btnPostEnter" name="password" placeholder="Nhập password">
    <button type="button" class="btn btn-info fadeIn fourth btnPostRedirect">Login</button>
</form>

<!-- Remind Passowrd -->
<div id="formFooter">
    <!-- <a class="underlineHover" href="<?=base_url("admin/forgotPassword")?>">Quên mật khẩu ?</a> -->
</div>
