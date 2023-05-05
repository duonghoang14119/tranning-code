<head>
    <link rel="stylesheet" href="{{ asset('css/admin/addproduct.css') }}">
</head>

{{--<div class="add-product-form">--}}
{{--    <div class="card-header separator">--}}
{{--        <p class="card-title">THÊM SẢN PHẨM</p>--}}
{{--        <div class="img-vector" onclick="closeForm()">--}}
{{--            <img src="{{ asset('images/Vector.png') }}" alt="" class="img-vector"><br>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="input-form ">--}}
{{--        <div class="form-group">--}}
{{--            <label for="inputName">Tên sản phẩm <span class="required">*</span></label><br>--}}
{{--            <input type="text" id="inputName" class="form-control input-form-group" placeholder="Nhập tên sản phẩm" required>--}}
{{--        </div>--}}
{{--        <div class="form-group">--}}
{{--            <label for="inputCategory">Danh mục sản phẩm <span class="required">*</span></label><br>--}}
{{--            <select id="inputCategory" class="form-control custom-select input-form-group">--}}
{{--                <option selected="" disabled="">Chọn danh mục sản phẩm</option>--}}
{{--                <option>On Hold</option>--}}
{{--                <option>Canceled</option>--}}
{{--                <option>Success</option>--}}
{{--            </select>--}}
{{--        </div>--}}
{{--        <div class="form-group">--}}
{{--            <label for="inputManufacturer">Hãng sản xuất <span class="required">*</span></label><br>--}}
{{--            <select id="inputManufacturer" class="form-control custom-select input-form-group">--}}
{{--                <option selected="" disabled="">Chọn hãng sản xuất</option>--}}
{{--                <option>On Hold</option>--}}
{{--                <option>Canceled</option>--}}
{{--                <option>Success</option>--}}
{{--            </select>--}}
{{--        </div>--}}
{{--        <div class="form-group">--}}
{{--            <label for="inputPrice">Giá <span class="required">*</span></label><br>--}}
{{--            <input type="text" id="inputPrice" class="form-control input-form-group" required>--}}
{{--        </div>--}}
{{--        <div class="form-group">--}}
{{--            <label for="inputMessage">Mô tả</label><br>--}}
{{--            <textarea id="inputMessage" class="form-control input-form-group" rows="4"></textarea>--}}
{{--        </div>--}}

{{--        <div class="form-group">--}}
{{--            <div class="custom-file">--}}
{{--                <input type="file" class="custom-file-input" id="image" name="image">--}}
{{--                <label class="custom-file-label" for="image">Thêm ảnh minh họa</label>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="button">--}}
{{--            <div class="form-group" onclick="closeForm()">--}}
{{--                <input type="submit" class="btn-cancel" value="Hủy">--}}
{{--            </div>--}}
{{--            <div class="form-group">--}}
{{--                <input type="submit" class="btn-submit" value="Thêm">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<div class="add-product-form">
    <div class="card-header separator">
        <p class="card-title">THÊM SẢN PHẨM</p>
        <div class="img-vector" onclick="closeForm()">
            <img src="{{ asset('images/Vector.png') }}" alt="" class="img-vector"><br>
        </div>
    </div>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" id="add-product-form">
        @csrf
        <div class="row input-form">
            <div class="form-group">
                <label for="inputName">Tên sản phẩm <span class="required">*</span></label><br>
                <input type="text" name="name" id="inputName" class="form-control input-form-group"
                       placeholder="Nhập tên sản phẩm" required>
            </div>
            <div class="form-group">
                <label for="inputCategory">Danh mục sản phẩm <span class="required">*</span></label><br>
                <select id="inputCategory" name="category_id"
                        class="form-control custom-select input-form-group">
                    <option selected="" disabled="">Chọn danh mục sản phẩm</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="inputManufacturer">Hãng sản xuất <span class="required">*</span></label><br>
                <select id="inputManufacturer" name="manufacturer_id"
                        class="form-control custom-select input-form-group">
                    <option selected="" disabled="">Chọn hãng sản xuất</option>
                    @foreach($manufacturers as $manufacturer)
                        <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="inputPrice">Giá <span class="required">*</span></label><br>
                <input type="text" name="price" id="inputPrice" class="form-control input-form-group"
                       required>
            </div>
            <div class="form-group">
                <label for="inputMessage">Mô tả</label><br>
                <textarea id="inputMessage" name="description" class="form-control input-form-group"
                          rows="4" required></textarea>
            </div>

            <div>
                <div class="custom-file">
                    {{--                                    <input type="file" class="custom-file-input" id="image" name="image_path">--}}
                    <input type="file" class="custom-file-input" id="image" name="image_path"
                           onchange="displayFileName()">

                    <label class="custom-file-label" for="image">Thêm ảnh minh họa<span
                            class="required">*</span></label>
                </div>
            </div>
            <div class="button">
                <div class="form-group" onclick="closeForm()">
                    <input class="btn-cancel" value="Hủy">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn-submit">Thêm</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    $('.custom-file-input').on('change',function(){
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings('.custom-file-label').addClass('selected').html(fileName);
    });

</script>

