@extends('layouts.app')

@section('content')
<div class="container">
<h1>Chỉnh sửa loài hoa</h1>

<form method="post" action="{{ route('flowers.update', $flower->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT') <!-- Sử dụng HTTP method PUT cho việc cập nhật -->

    <label for="name">Tên loài hoa:</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ $flower->name }}" required>

    <label for="description">Mô tả:</label>
    <textarea name="description" class="form-control" id="description" required>{{ $flower->description }}</textarea>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Image:</strong>
            <input type="file" name="image" class="form-control" placeholder="image">
            @if(file_exists(public_path('img/' . $flower->image_url)))
            <img src="{{ asset('img/' . $flower->image_url) }}" width="100" height="100" class="rounded-circle mt-3" alt="hình">
            @else
            <img src="{{ asset($flower->image_url) }}" width="100" height="100" class="rounded-circle mt-3" alt="không có hình">
            @endif
        </div>
    </div>

    <label for="regions">Danh sách khu vực phân bố:</label>
    <div id="regions-container">
        @foreach ($flower->regions as $region)
        <input type="text" name="regions[]" class="form-control" value="{{ $region->region_name }}">
        <br>
        @endforeach
    </div>
    <button type="button" id="add-region" class="btn btn-primary">Thêm khu vực phân bố</button>

    <button type="submit" class="btn btn-success">Cập nhật</button>
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