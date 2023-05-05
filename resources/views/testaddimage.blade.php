{{--<div class="slide-item box1Img" hidden>--}}
{{--    <div class="slide-item-title">Ảnh 1</div>--}}
{{--    <div class="slide-item-img">--}}
{{--        <input type="text" hidden name="idImgSlider[]" value="" id="idImage">--}}
{{--        <img src="assets/image/car2.png" alt="" class="imgElement">--}}
{{--        <div class="update_delete">--}}
{{--            <div class="btn_update_delete" onclick="image_upload(this)">Cập nhật</div>--}}
{{--            <div class="btn_update_delete" onclick="image_delete(this)">Xóa</div>--}}
{{--            </div>--}}
{{--        <input type="file" class="inputElement" hidden name="imageSlide[]">--}}
{{--       </div>--}}
{{--</div>--}}
<div class="slide-image">

<div class="slide-item box2Add">
    <div class="slide-item-title">Ảnh 1</div>
    <div class="slide-item-vector addElement addImage">
        <div class="vector_sub">
            <div class="vector_padding" onclick="addElement(this)">
                <img  src="{{ asset('images/anhnutthemmoi.png') }}" >

            </div>
        </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function loadImage(input, output) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(output).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    var appendHtml = '<div class="slide-item box1Img" hidden>';
    appendHtml += '<div class="slide-item-title">Ảnh 1</div>';
    appendHtml += '<div class="slide-item-img">';
    appendHtml += '<input type="text" hidden name="idImgSlider[]" value="" id="idImage">';
    appendHtml += '<img src="assets/images/Rectangle 195.jpg" alt="" class="imgElement">';
    appendHtml += '<div class="update_delete">';
    appendHtml += '<div class="btn_update_delete" onclick="image_upload(this)">Cập nhật</div>';
    appendHtml += '<div class="btn_update_delete" onclick="image_delete(this)">Xóa</div>';
    appendHtml += '</div>';
    appendHtml += '<input type="file" class="inputElement" hidden name="imageSlide[]">';
    appendHtml += '</div>';
    appendHtml += '</div>';


    // ============================== Phần ảnh SLIDE
    // Click thêm ảnh slide
    function addElement(addImage){
        var slideItem = $(addImage).closest('.slide-item');
        slideItem.before(appendHtml);
        var inputElement = $(addImage).parents('.slide-image').find('.inputElement').last();
        var imgElement = $(addImage).parents('.slide-image').find('.imgElement').last();
        inputElement.click();

        inputElement.on('change', function(){
            if($(".box1Img").length === 4 && $(".box1Img").css('display', 'block')){
                $(".box2Add").hide();
            }

            if (this.files.length > 0) {
                $(".box1Img").show();
            }
            loadImage(this, imgElement);
        })
    }


    // Cập nhật ảnh slide
    function image_upload(update_image) {
        var slideItemImage = update_image.closest('.slide-item-img');
        var inputElement = slideItemImage.querySelector('.inputElement');

        $(inputElement).off('change').on('change', function(){
            var imgElement = slideItemImage.querySelector('.imgElement');
            loadImage(inputElement, imgElement);
        });
        inputElement.click();
    }

    // Xóa ảnh slide
    function image_delete(delete_image){

        var idImage = $(delete_image).parents('.slide-item-img').find("#idImage").val();
        if (idImage  !== "") {
            $(delete_image).parents('.slide-item-img').find("#getIdImage").attr('value', idImage);
        }

        $(delete_image).parents(".box1Img").hide();

        if($(".box1Img").length !== 4){
            $(".box2Add").show();
        }else{
            $(".box2Add").hide();
        }
    }
</script>
