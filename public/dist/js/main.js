$(document).ready(function(){

    $('.select_all').click(function(event) { //on click;

        var _checkbox = $('table').has($(this)).children("tbody").children("tr").children("td").children("input[type='checkbox']");
        state = this.checked;

        $.each(_checkbox, function(index, value) {
            value.checked = state;
        })

    });
    $(document).on('click', '.btnActionModule', function(){

        _form     = $(this).closest("form");
        _action   = _form.attr("action");
        _redirect = _form.attr("data-redirect");
        _data     = _form.serialize();
        let type = $(this).attr("data-type");
        _data     = _data + '&' + $.param({type:type, token:token});
        _confirm = $(this).attr("data-confirm");
        _valid   = $('.checkItem:checkbox:checked').length;
        if(_valid > 0 ){
            showConfirmMessage(_confirm, function(){
                $.post(_action, _data, function(result){
                    showSuccessAutoClose(result.txt, result.st);
                    if(result.st == "success"){
                        setTimeout(function(){
                            window.location.reload();
                        },2000);
                    }
                },'json');
            });
        }else{
            showSuccessAutoClose('Bạn chưa chọn gì để thao tác', "info");
        }
        
        return false;
    });

    $(document).on('click', '.btnPost', function(){

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
    });
    $(document).on('click', '.btnPostRedirect', function(){

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
    });

    $(document).on('click', '.btnPostFile', function() {
        _form = $(this).closest("form");
        _action = _form.attr("action");
        _redirect = _form.data("redirect");
        let formData = new FormData(_form[0]);
        formData.append('token',token);
        $.ajax({
            url: _action,
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(result){
                result = JSON.parse(result);
                showSuccessAutoClose(result.txt, result.st);
                if (result.st == "success"){
                    setTimeout(function(){
                        window.location.assign(_redirect);
                    },2000);
                }
            },
        });
    });

    $(document).on('click', '.btnPostEditor', function() {
        _form = $(this).closest("form");
        _action = _form.attr("action");
        _redirect = _form.data("redirect");
        let formData = new FormData(_form[0]);
        formData.append('token',token);
        $.each(CKEDITOR.instances, function(index, value){
            // console.log(index);
            formData.append(index, value.getData());
        })
        // let content = CKEDITOR.instances.content.getData();
        $.ajax({
            url: _action,
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(result){
                result = JSON.parse(result);
                showSuccessAutoClose(result.txt, result.st);
                if (result.st == "success"){
                    setTimeout(function(){
                        window.location.assign(_redirect);
                    },2000);
                }
            },
        });
    });

    $(document).on('click', '.btn-delete-item', function(){
        let current_id = $(this).attr("data-id");
        let tr =  $("tr[data-id="+current_id+"]");
        let id = tr.attr("data-id");
        let action = tr.attr("data-action");
        let confirm = tr.attr("data-confirm");
        let _data     = $.param({id:id, token:token});
        showConfirmMessage(confirm, function(){
            $.post(action, _data, function(result){
                showSuccessAutoClose(result.txt, result.st);
                if(result.st == "success"){
                    setTimeout(function(){
                        window.location.reload();
                    },2000);
                }
            },'json');
        });
    });


    $(document).on("keyup", ".convert-to-slug", function(){

        let title = $(this).val();
        let slug_id = $(this).attr("slug-to");

        //Đổi chữ hoa thành chữ thường
        slug = title.toLowerCase();
     
        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');

        $("#"+slug_id).val(slug);
    })

    $(document).on("click", "#delete-product", function(e){

        let prd_id = $(this).attr("data-id");

        $("#pro_search_append tr[data-id='"+prd_id+"']").remove();
        getTotal();
    })

    $(document).on("change", "#quantity", function(e){

        let prd_id = $(this).attr("data-id");

        let quantity = $(this).val();
        let price = parseInt($('[data-id="'+prd_id+'"] #price').val());

        if(quantity > 0){

            $('[data-id="'+prd_id+'"] #amount').val(quantity*price);
        }
        else{
            $(this).val(1);
            $('[data-id="'+prd_id+'"] #amount').val(price);
        }

        getTotal();
    })

    $(document).on("click", ".btn-print", function(e){

        let action = $(this).attr("data-action");
        $.get(action, function(result){

            var w = window.open();
            w.document.write(result); //only part of the page to print, using jquery
            w.document.close(); //this seems to be the thing doing the trick
            w.focus();
            w.print();
            w.onafterprint = function(){
                w.close();
            }
        });
    })

})

showConfirmMessage = function($message, $function) {
    swal({
        title: "Bạn có chắc?",
        text: $message,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $function();
        }
    });
}

showSuccessAutoClose = function($message, $label) {
    swal({
        title: $label,
        text: $message,
        icon: $label,
    });
}

function randomPassword(){
		
    var root_string = "ABCDE@FGHIJKLMNOPQRS@TUVWXYZab@cdefghijklmn@opqrstuvwxyz@01234567#89";
    var randPass = "";
    var rand = Math.floor((Math.random() * root_string.length) + 0);
    randPass += root_string[rand];
    rand = Math.floor((Math.random() * root_string.length) + 0);
    randPass += root_string[rand];
    rand = Math.floor((Math.random() * root_string.length) + 0);
    randPass += root_string[rand];
    rand = Math.floor((Math.random() * root_string.length) + 0);
    randPass += root_string[rand];
    rand = Math.floor((Math.random() * root_string.length) + 0);
    randPass += root_string[rand];
    rand = Math.floor((Math.random() * root_string.length) + 0);
    randPass += root_string[rand];
    rand = Math.floor((Math.random() * root_string.length) + 0);
    randPass += root_string[rand];
    rand = Math.floor((Math.random() * root_string.length) + 0);
    randPass += root_string[rand];
    rand = Math.floor((Math.random() * root_string.length) + 0);
    randPass += root_string[rand];
    rand = Math.floor((Math.random() * root_string.length) + 0);
    randPass += root_string[rand];
    rand = Math.floor((Math.random() * root_string.length) + 0);
    randPass += root_string[rand];
    rand = Math.floor((Math.random() * root_string.length) + 0);
    randPass += root_string[rand];
    rand = Math.floor((Math.random() * root_string.length) + 0);
    randPass += root_string[rand];
    rand = Math.floor((Math.random() * root_string.length) + 0);
    randPass += root_string[rand];
    rand = Math.floor((Math.random() * root_string.length) + 0);
    randPass += root_string[rand];
    rand = Math.floor((Math.random() * root_string.length) + 0);
    randPass += root_string[rand];
    rand = Math.floor((Math.random() * root_string.length) + 0);
    randPass += root_string[rand];
    rand = Math.floor((Math.random() * root_string.length) + 0);
    randPass += root_string[rand];
    
    document.getElementById("pass").value = randPass;
}

function select_product(item, price_type = 'purchase_price'){

    let prd_id = item.product_id;
    if(prd_id != undefined){

        let price_value = item.price;
        if(price_type == 'purchase_price'){

            price_value = item.purchase_price;
        }
        let old_prd = $("#pro_search_append").find('[data-id="'+prd_id+'"]');
        if(old_prd.length == 0){

            let tr = `<tr data-id="${prd_id}">
                    <td>
                        <input type="hidden" name="prd[${prd_id}][prd_id]" value="${prd_id}">
                        ${prd_id}
                    </td>
                    <td>${item.product_name}</td>
                    <td class="text-center zoomin"><img src="${item.image}" height="50" alt=""></td>
                    <td class="text-center"><input type="number" data-id="${prd_id}" id="quantity" class="form-control" name="prd[${prd_id}][prd_quantity]" value="1"></th>
                    <td class="text-center">${item.unit_name}</td>
                    <td class="text-center"><input type="text" id="price" readonly class="form-control" name="prd[${prd_id}][prd_${price_type}]" value="${price_value}"></td>
                    <td class="text-center"><input type="text" id="amount" readonly class="form-control amount" name="prd[${prd_id}][prd_amount]" value="${price_value * 1}"></td>
                    <td id="delete-product" data-id="${prd_id}"><i class="fas fa-trash-alt"></i></td>
                </tr>`
            $("#pro_search_append").append(tr);
        }
        else{

            $('#pro_search_append [data-id="'+prd_id+'"] #quantity').val(parseFloat($('[data-id="'+prd_id+'"] #quantity').val()) + 1);

            let quantity = parseFloat($('[data-id="'+prd_id+'"] #quantity').val());
            let price = parseInt($('[data-id="'+prd_id+'"] #price').val());

            $('[data-id="'+prd_id+'"] #amount').val(quantity*price);

        }

        getTotal();
    }
}

function getTotal(){

    let amount_elm = $(".amount");
    let total = 0;
    $.each(amount_elm, function(index, value){

        total += parseInt($(value).val());
    })

    total = total.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});

    $("#total").text(total);
}

getUrlParameter = function (sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};