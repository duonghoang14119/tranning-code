<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/test.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/product.css') }}">
</head>
<body>
@include('header')

<div class="home">
    @include('filter')
    <div class="content">
        <div class="above-content">
            @include('search')
        </div>
        <div class="homepage-content">
            <div class="homepage-content-item">

            @foreach($pagination as $item)
                <div class="detail-product">
                    <img src="{{ asset('images/'. $item->image_path) }}" alt="" class="img-product"><br>

                    <div class="name-price">
                        <a href="{{ route('products.show',$item->id) }}">{{ $item->name }}</a><br>
                        <span style="color: #565656">$ {{ $item->price }}</span>
                    </div>

                </div>
            @endforeach
            </div>

            <div class="pagination_manager">

                {{ $pagination->links('custom-pagination', ['pagination' => $pagination]) }}
            </div>

        </div>

    </div>

</div>
</body>
</html>
