@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Thêm mới loài hoa</h1>

    <form method="post" action="{{ route('flowers.store') }}" enctype="multipart/form-data">
        @csrf
        <label for="name">Tên loài hoa:</label>
        <input type="text" name="name" id="name" required class="form-control">
        <br>
        <label for="description">Mô tả:</label>
        <textarea name="description" id="description" required class="form-control"></textarea>
        <br>
        <label for="image_url">Đường dẫn ảnh:</label>
        <input type="file" name="image_url" id="image_url" required class="form-control">
        <br>
        <label for="regions">Danh sách khu vực phân bố:</label>
        <div id="regions-container">
            <input type="text" name="regions[]" required class="form-control">
        </div>
        <br>
        <button type="button" id="add-region" class="btn btn-primary">Thêm khu vực phân bố</button>
        <br>
        <br>
        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="{{ route('flowers.index')}}" class="btn btn-warning">Back</a>
    </form>

</div>
<script>
    document.getElementById('add-region').addEventListener('click', function() {
        var regionsContainer = document.getElementById('regions-container');
        var input = document.createElement('input');
        input.type = 'text';
        input.name = 'regions[]';
        input.required = true;
        regionsContainer.appendChild(input);
    });
</script>
@endsection