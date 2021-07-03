
<style>

.cke_contents{
    min-height: 21cm !important;
    background: #eee !important;
}
.cke_contents iframe{
    width: 93% !important;
    height: 90% !important;
    margin-top: 1.5cm !important;
    margin-left: 1.2cm !important;
    border: 1px #d3d3d3 solid;
    box-shadow: 0 0 5px rgb(0 0 0 / 10%);
}
</style>
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
        <form action="<?=cn('ajaxAddProducts')?>" data-redirect="<?=base_url("products")?>" >
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="product_name">Tên sản phẩm</label>
                            <input type="text" name="product_name" class="form-control convert-to-slug" slug-to="product_slug" id="product_name" placeholder="Nhập tên sản phẩm">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="product_slug">Slug</label>
                            <input type="text" name="product_slug" readonly="true" class="form-control" id="product_slug" placeholder="Slug">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image">Hình ảnh sản phẩm</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" accept="image/*" id="image" name="image">
                                    <label class="custom-file-label" for="image">Chọn hình ảnh sản phẩm</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Tải lên</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price">Giá bán (VND)</label>
                            <input type="number" class="form-control" name="price" id="price" placeholder="Nhập giá bán">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="purchase_price">Giá nhập (VND)</label>
                            <input type="number" class="form-control" name="purchase_price" id="purchase_price" placeholder="Nhập giá nhập">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="discount">Giảm giá (%)</label>
                            <input type="number" class="form-control" value="0" name="discount" id="discount" placeholder="Giảm giá">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">Mô tả sản phẩm</label>
                            <textarea name="description" id="description" class="form-control" cols="10" rows="4" placeholder=""></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category_id">Danh mục</label>
                            <select class="form-control select2" name="category_id" id="category_id">
                                <?php foreach($categories as $value){  ?>
                                    <option value="<?=$value->category_id?>"><?=$value->category_name?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="unit_id">Đơn vị</label>
                            <select class="form-control select2" name="unit_id" id="unit_id">
                                <?php foreach($units as $value){  ?>
                                    <option value="<?=$value->unit_id?>"><?=$value->unit_name?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="keyword">Từ khoá liên quan</label>
                            <input type="text" class="form-control tags-input" name="keyword" id="keyword" placeholder="Từ khoá liên quan">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tag_id">Nhãn</label>
                            <select class="form-control select2" name="tag_id" id="tag_id">
                                <?php foreach($tags as $value){  ?>
                                    <option value="<?=$value->tag_id?>"><?=$value->tag_name?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="button" class="btn btn-primary btnPostEditor">Submit</button>
            </div>
        </form>
    </div>
</div>
</div>

<script>
$(document).ready(function(){ // đoạn này

    CKEDITOR.plugins.addExternal('image2', '/plugins/image2/', 'plugin.js' );
    CKEDITOR.replace( 'description',{

        extraPlugins: 'image2',

        filebrowserBrowseUrl: BASE + '/plugins/ckfinder/ckfinder.html',

        filebrowserImageBrowseUrl: BASE + '/plugins/ckfinder/ckfinder.html?type=Images',

        filebrowserFlashBrowseUrl: BASE + '/plugins/ckfinder/ckfinder.html?type=Flash',

        filebrowserUploadUrl: BASE + '/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',

        filebrowserImageUploadUrl: BASE + '/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

        filebrowserFlashUploadUrl: BASE + '/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
    });
    CKEDITOR.addCss( '.cke_editable { padding: 1.2cm 1cm }' );
})
</script>