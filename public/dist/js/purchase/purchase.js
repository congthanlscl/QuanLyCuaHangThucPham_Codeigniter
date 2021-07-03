$(document).ready(function(){

    $(document).on('click', '.btn-get-detail', function(){
        let id = $(this).attr("data-id");
        $.get(BASE + "/purchase/getPurchaseDetail", {id:id}, function(res){
            if(res.st == "success"){
                
                let tbody = '';
                let data = res.data;
                let total = 0;
                data.forEach((value, index) => {
                    
                    tbody += `<tr>
                        <td>${index + 1}</td>
                        <td>${value.product_name}</td>
                        <td>${value.quantity}</td>
                        <td>${value.unit_name}</td>
                        <td>${parseInt(value.purchase_price).toLocaleString('it-IT', {style : 'currency', currency : 'VND'})}</td>
                        <td>${parseInt(value.total).toLocaleString('it-IT', {style : 'currency', currency : 'VND'})}</td>
                    </tr>`;
                    total += parseInt(value.total);
                });

                tbody += `<tr style="font-weight: 600;">
                        <td colspan="5" style="text-align:center">Tổng cộng</td>
                        <td>${total.toLocaleString('it-IT', {style : 'currency', currency : 'VND'})}</td>
                    </tr>`;

                $("#purchase-detail tbody").html(tbody);
                $("#purchase-detail .modal-title").text("Mã nhập hàng : " + id);
            }
        },'json');
    });

})