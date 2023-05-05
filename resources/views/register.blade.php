<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
{{--<form method="POST" action="/admin/register">--}}
{{--    @csrf--}}

{{--    <label for="name">Name</label>--}}
{{--    <input type="text" name="name" id="name" required>--}}

{{--    <label for="email">Email</label>--}}
{{--    <input type="email" name="email" id="email" required>--}}

{{--    <label for="password">Password</label>--}}
{{--    <input type="password" name="password" id="password" required>--}}

{{--    <button type="submit">Register</button>--}}
{{--</form>--}}
{{--<a class="btn btn-success" style="color: #00CCFF;" href="{{ route('login') }}">login</a>--}}
<body>
<style>
    body {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        /*background-image: url('path/to/image.jpg');*/
        background-size: cover;
        background-position: center;
    }

    .container {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
    }

    .form-register {
        text-align: center;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
        width: 300px;
    }
    #name {
        width: 84%;
        padding: 15px 10px 15px;
        font-size: 14px;
        background: transparent;
        border: 2px solid #537b35;
        outline: none;
        margin-bottom: 26px;
    }
    #email {
        width: 84%;
        padding: 15px 10px 15px;
        font-size: 14px;
        background: transparent;
        border: 2px solid #537b35;
        outline: none;
        margin-bottom: 26px;
    }
    #password {
        width: 84%;
        padding: 15px 10px 15px;
        font-size: 14px;
        background: transparent;
        border: 2px solid #537b35;
        outline: none;
        margin-bottom: 26px;
    }
    .register {
        font-size: 16px;
        padding: 10px 65px;
        background-color: #537b35;
        color: #FFF;
        border: none;
        border-radius: 0px;
        outline: none;
        float: none;
        cursor: pointer;
    }

</style>
<div class="container">
    <div class="form-register center">
        <h2>Register here</h2>
        <form method="POST" action="/admin/login">
            @csrf
            <input type="text" name="name" id="name" placeholder="NAME" required>

            <input type="email" name="email" placeholder="EMAIL" id="email" required><br>

            <input type="password" name="password" placeholder="PASSWORD" id="password" required><br>

            <button type="submit" class="register">Register</button>
        </form>
        <p> Back to login page <span>→</span> <a class="w3_play_icon1" href="{{ route('login') }}">Click Here</a></p>
    </div>
</div>


</body>

</body>
</html>
