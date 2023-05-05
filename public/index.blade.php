<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/test.css') }}">
    {{--    <link rel="stylesheet" href="{{ asset('css/test.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('css/admin/product.css') }}">


</head>
<body>
@include('header')
<div class="home">
    @include('filter')
    <div class="content">
        <div class="above-content">
            <div class="add-product" onclick="showForm()">
                <p>Thêm Sản Phẩm</p>
            </div>
            <div id="product-form" style="display: none;">
                @include('products/addproduct')
            </div>

            @include('search')
        </div>
        <div class="homepage-content">
            <div class="detail-product">
                <img src="{{ asset('images/image 2.png') }}" alt="" class="img-product"><br>

                <div class="name-price">
                    <a href="#">FERRARI F8 SPIDER</a><br>
{{--                    <span style="color: #565656">$ 100,000,000</span>--}}
                </div>
                <div class="button-edit-product">
                    <div class="btn-update">
                        <a href="#">Cập Nhật</a>
                    </div>
                    <div class="btn-delete">
                        <a href="#">Xóa</a>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>

<script>
    function showForm() {
        var form = document.getElementById("product-form");
        form.style.display = "block";
    }

    function closeForm() {
        var form = document.getElementById("product-form");
        form.style.display = "none";
    }
</script>
</body>
</html>
