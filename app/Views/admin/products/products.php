<div class="row">
    <div class="col-12">
        <!-- /.card -->
        <form action="<?=cn('ajaxActionProducts')?>" data-redirect="<?=base_url("products")?>">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-danger btnActionModule" data-type="0" data-confirm="Ngừng kinh doanh những sản phẩm đã chọn ?">Ngừng kinh doanh</button>
                    <button type="button" class="btn btn-success btnActionModule" data-type="1" data-confirm="Kinh doanh những sản phẩm đã chọn ?">Kinh doanh</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th><input type="checkbox" name="select_all" id="select_all" class="select_all"></th>
                                <th>STT</th>
                                <th>Ảnh sản phẩm</th>
                                <th>Tên sản phầm</th>
                                <th>Giá bán (VND)</th>
                                <th>Giá nhập (VND)</th>
                                <th>Giảm giá (%)</th>
                                <th>Danh mục</th>
                                <th>Đơn vị</th>
                                <th>Nhãn</th>
                                <th>Trạng thái</th>
                                <th>Tuỳ chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($result as $key => $value){ ?>
                            <tr data-id="<?=$value->product_id?>" data-action="<?=cn('ajaxChangeStatusProducts')?>" data-confirm="Xoá nhãn <?=$value->product_name?> ?">
                                <td>
                                    <input type="checkbox" name="id[]" class="checkItem" value="<?=$value->product_id?>">
                                </td>
                                <td><?=(int)$key + 1?></td>
                                <td data-toggle="modal" data-target="#exampleModalCenter" style="text-align: center;vertical-align: middle;cursor:pointer" class="products-image"><img src="<?=$value->image?>" style="height:50px" src="Hình ảnh sản phẩm"/></td>
                                <td><?=$value->product_name?></td>
                                <td><?=number_format($value->price)?></td>
                                <td><?=number_format($value->purchase_price)?></td>
                                <td><?=$value->discount?></td>
                                <td><?=$value->category_name?></td>
                                <td><?=$value->unit_name?></td>
                                <td><?=$value->tag_name?></td>
                                <td><?=($value->status == 1) ? "Đang kinh doanh" : "Ngừng kinh doanh"?></td>
                                <td>
                                    <a href="<?=base_url("products/updateProducts?id=".$value->product_id)?>" class="btn btn-info" title="Chỉnh sửa"><i class="fas fa-edit"></i></a>
                                        <!-- <button type="button" data-id="<?=$value->product_id?>" class="btn btn-danger btn-delete-item">Xoá</button> -->
                                    <?php if(!empty($value->status)) { ?>
                                        <button type="button" data-id="<?=$value->product_id?>" data-type="0" data-confirm="Ngừng kinh doanh sản phẩm <?=$value->product_name?> ?" class="btn btn-danger btn-change-status" title="Ngừng kinh doanh"><i class="fas fa-stop"></i></button>
                                    <?php } else{ ?>
                                        <button type="button" data-id="<?=$value->product_id?>" data-confirm="Kinh doanh sản phẩm <?=$value->product_name?> ?" data-type="1" class="btn btn-success btn-change-status" title="Kinh doanh"><i class="fas fa-play-circle"></i></button>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            </form>
    </div>
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Hình ảnh sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img style="width:100%" src="" alt="Hình ảnh sản phẩm">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>

    $(document).ready(function(){

        $(document).on("click",".products-image", function(e){

            let src = $(this).children("img").attr("src");
            $("#exampleModalCenter img").attr("src", src);
        })

        $(document).on('click', '.btn-change-status', function(){
            let current_id = $(this).attr("data-id");
            let tr =  $("tr[data-id="+current_id+"]");
            let id = tr.attr("data-id");
            let action = tr.attr("data-action");
            let confirm = $(this).attr("data-confirm");
            let type = $(this).attr("data-type");
            let _data     = $.param({id:id, type:type, token:token});
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

    })
</script>