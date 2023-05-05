<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Chọn ảnh và hiển thị</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="{{ asset('css/test-v2.css') }}">
</head>
<body>

<form action="{{ route('products.update',16) }}" method="POST" enctype="multipart/form-data"
      id="update-product-form">
    @csrf
    @method('PUT')
    <div class="image-container">
        <div class="image-preview" id="image-preview-0" style="display: none;">
            <img id="img-preview-0" src="">
            <p class="btn-delete" data-id="0">Xóa ảnh</p>
            <p class="btn-update" data-id="0">Cập nhật ảnh</p>
        </div>
        <div class="image-upload">
            <input type="file" class="input-file" accept="image/*" name="images[]" multiple="" hidden>
            <p class="btn-upload">Thêm ảnh</p>
        </div>
    </div>
    <button type="submit">Gửi form</button>
</form>
<script>
    const imageContainer = document.querySelector('.image-container');
    const btnUpload = imageContainer.querySelector('.btn-upload');
    const inputFile = imageContainer.querySelector('.input-file');
    let nextId = 1;

    btnUpload.addEventListener('click', function() {
        inputFile.click();
    });

    inputFile.addEventListener('change', function() {
        const imagePreview = document.createElement('div');
        imagePreview.classList.add('image-preview');
        imagePreview.id = `image-preview-${nextId}`;
        imagePreview.innerHTML = `
    <img id="img-preview-${nextId}" src="">
    <p class="btn-delete" data-id="${nextId}">Xóa ảnh</p>
    <p class="btn-update" data-id="${nextId}">Cập nhật ảnh</p>
  `;
        imageContainer.insertBefore(imagePreview, this.parentNode);

        const input = document.createElement('input');
        input.classList.add('input-file');
        input.type = 'file';
        input.accept = 'image/*';
        input.style.display = 'none';
        input.name = 'images[]'; // add this line
        input.multiple = false; // add this line
        imagePreview.appendChild(input);

        const imgPreview = imagePreview.querySelector(`#img-preview-${nextId}`);

        const reader = new FileReader();
        reader.addEventListener('load', function() {
            imgPreview.src = reader.result;
            imagePreview.style.display = 'block';
        });

        reader.readAsDataURL(inputFile.files[0]);

        const btnDelete = imagePreview.querySelector('.btn-delete');
        btnDelete.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const preview = document.querySelector(`#image-preview-${id}`);
            preview.parentNode.removeChild(preview);
        });

        const btnUpdate = imagePreview.querySelector('.btn-update');
        btnUpdate.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const input = document.querySelector(`#image-preview-${id} .input-file`);
            input.click();

            input.addEventListener('change', function() {
                const imgPreview = document.querySelector(`#img-preview-${id}`);
                const file = this.files[0];
                const reader = new FileReader();
                reader.addEventListener('load', function() {
                    imgPreview.src = reader.result;
                    imagePreview.style.display = 'block';
                });
                reader.readAsDataURL(file);
            });
        });

        nextId++;
    });


</script>

{{--<script>--}}
{{--const imageContainer = document.querySelector('.image-container');--}}
{{--const btnUpload = imageContainer.querySelector('.btn-upload');--}}
{{--const inputFile = imageContainer.querySelector('.input-file');--}}
{{--let nextId = 1;--}}

{{--btnUpload.addEventListener('click', function() {--}}
{{--inputFile.click();--}}
{{--});--}}

{{--inputFile.addEventListener('change', function() {--}}
{{--const imagePreview = document.createElement('div');--}}
{{--imagePreview.classList.add('image-preview');--}}
{{--imagePreview.id = `image-preview-${nextId}`;--}}
{{--imagePreview.innerHTML = `--}}
{{--<img id="img-preview-${nextId}" src="">--}}
{{--<p class="btn-delete" data-id="${nextId}">Xóa ảnh</p>--}}
{{--<p class="btn-update" data-id="${nextId}">Cập nhật ảnh</p>--}}
{{--`;--}}
{{--imageContainer.insertBefore(imagePreview, this.parentNode);--}}

{{--const input = document.createElement('input');--}}
{{--input.classList.add('input-file');--}}
{{--input.type = 'file';--}}
{{--input.accept = 'image/*';--}}
{{--input.style.display = 'none';--}}
{{--imagePreview.appendChild(input);--}}

{{--const imgPreview = imagePreview.querySelector(`#img-preview-${nextId}`);--}}

{{--const reader = new FileReader();--}}
{{--reader.addEventListener('load', function() {--}}
{{--imgPreview.src = reader.result;--}}
{{--imagePreview.style.display = 'block';--}}
{{--});--}}

{{--reader.readAsDataURL(inputFile.files[0]);--}}

{{--const btnDelete = imagePreview.querySelector('.btn-delete');--}}
{{--btnDelete.addEventListener('click', function() {--}}
{{--const id = this.getAttribute('data-id');--}}
{{--const preview = document.querySelector(`#image-preview-${id}`);--}}
{{--preview.parentNode.removeChild(preview);--}}
{{--});--}}

{{--const btnUpdate = imagePreview.querySelector('.btn-update');--}}
{{--btnUpdate.addEventListener('click', function() {--}}
{{--const id = this.getAttribute('data-id');--}}
{{--const input = document.querySelector(`#image-preview-${id} .input-file`);--}}
{{--input.click();--}}

{{--input.addEventListener('change', function() {--}}
{{--const imgPreview = document.querySelector(`#img-preview-${id}`);--}}
{{--const file = this.files[0];--}}
{{--const reader = new FileReader();--}}
{{--reader.addEventListener('load', function() {--}}
{{--imgPreview.src = reader.result;--}}
{{--imagePreview.style.display = 'block';--}}
{{--});--}}
{{--reader.readAsDataURL(file);--}}
{{--});--}}
{{--});--}}

{{--nextId++;--}}
{{--});--}}
{{--</script>--}}

</body>
</html>

{{--                <div class="img-update-under">--}}
{{--                    <p>Ảnh slide</p>--}}
{{--                    <div class="btn-update-img-under">--}}

{{--                        <div class="img-extra" style="width: 192px; height: 118px; background: #2f2f2f">--}}
{{--                            <img style="width: 100%; height: 100%" src="{{ asset('images/image 2.png') }}" alt=""><br>--}}

{{--                            <div class="btn-hide">--}}
{{--                                <button class="btn-update-img">Cập nhật</button>--}}
{{--                                <button class="btn-remove-img">Xóa</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="img-extra" style="width: 192px; height: 118px; background: #2f2f2f">--}}
{{--                            <img style="width: 100%; height: 100%" src="{{ asset('images/image 2.png') }}" alt=""><br>--}}

{{--                            <div class="btn-hide">--}}
{{--                                <button class="btn-update-img">Cập nhật</button>--}}
{{--                                <button class="btn-remove-img">Xóa</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
