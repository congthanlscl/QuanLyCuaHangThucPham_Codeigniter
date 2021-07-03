<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập quản lý website</title>
    <link rel = "icon" href ="../../dist/home/img/icons/icon_website.png" type = "image/x-icon"> 
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="<?=base_url()?>/dist/css/login.css" rel="stylesheet" >
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
    <div class="wrapper fadeInDown">
    <div id="formContent">

    <?php
        try
        {
            echo view($view);
        }
        catch (Exception $e)
        {
            echo "<pre><code>$e</code></pre>";
        }
    ?>

    </div>
    </div>
</body>
<script>
    var BASE = '<?=base_url()?>';
    var token = '<?=csrf_hash()?>';
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="<?=base_url()?>/dist/js/main.js"></script>
<script>
    $(document).on('keypress', '.btnPostEnter', function(e){

        let keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            _this = $(this);
            _form     = $(this).closest("form");
            _action   = _form.attr("action");
            _redirect = _form.attr("data-redirect");
            _data     = _form.serialize();
            _data     = _data + '&' + $.param({token:token});
            $.post(_action, _data, function(result){
                showSuccessAutoClose(result.txt, result.st);
                if(result.st == "success"){
                    setTimeout(function(){
                        window.location.assign(_redirect);
                    },2000);
                }
            },'json');
        }
    });
</script>
</html>