<div class="row">
    <div class="col-12">
        <!-- /.card -->
        <form action="<?=cn('ajaxActionInventory')?>" data-redirect="<?=base_url("inventory")?>">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-5">
                            .<div class="form-group">
                                <select class="custom-select select2" name="warehouse" id="warehouse">
                                    <option selected value="0">Tất cả nhà kho</option>
                                    <?php foreach($warehouse as $value) : ?>
                                        <option value="<?=$value->warehouse_id?>"><?=$value->warehouse_name?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="report-box" style="border: 1px dotted #ddd; border-radius: 0">
                                <div class="infobox-icon">
                                    <i class="fa fa-tag blue" style="font-size: 45px;" aria-hidden="true"></i>
                                </div>
                                <div class="infobox-data">
                                    <h3 class="infobox-title blue" style="font-size: 25px;"><?=$quantity?></h3>
                                    <span class="infobox-data-number text-center" style="font-size: 14px; color: #555;">SL tồn kho</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="report-box " style="border: 1px dotted #ddd; border-radius: 0">
                                <div class="infobox-icon">
                                    <i class="fas fa-retweet orange" style="font-size: 45px;"></i>
                                </div>
                                <div class="infobox-data">
                                    <h3 class="infobox-title orange" style="font-size: 25px;"><?=number_format($purchase_amount)?></h3>
                                    <span class="infobox-data-number text-center" style="font-size: 14px; color: #555;">Tổng vốn tồn kho</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="report-box" style="border: 1px dotted #ddd; border-radius: 0">
                                <div class="infobox-icon">
                                    <i class="fa fa-shopping-cart cred" style="font-size: 45px;"></i>
                                </div>
                                <div class="infobox-data">
                                    <h3 class="infobox-title cred" style="font-size: 25px;"><?=number_format($amount)?></h3>
                                    <span class="infobox-data-number text-center" style="font-size: 14px; color: #555;">Tổng giá trị tồn kho</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Kho</th>
                                <th>Số lượng</th>
                                <th>Vốn tồn kho (VND)</th>
                                <th>Giá trị tồn kho (VND)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($result as $key => $value){ ?>
                            <tr>
                                <td><?=(int)$key + 1?></td>
                                <td><?=$value->product_name?></td>
                                <td><?=$value->warehouse_name?></td>
                                <td><?=$value->stock?></td>
                                <td><?=number_format(((int)$value->stock * (int)$value->purchase_price))?></td>
                                <td><?=number_format(((int)$value->stock * (int)$value->price))?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function(){

        let warehouse = getUrlParameter("warehouse");

        if(warehouse != null){
            $("#warehouse").val(warehouse);
        }

        $("#warehouse").change(function(e){

            let warehouse = $("#warehouse").val();

            let url = BASE + "/inventory?&warehouse="+warehouse;
            window.location.assign(url);
        })
    })
</script>