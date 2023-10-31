@extends('layouts.app')

@section('content')
<div class="container">
<h1 class="mb-0">Detail flower</h1>
<hr />
<div class="row">
    <div class="col mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" placeholder="flower" value="{{ $flower->name }}" readonly>
        <label class="form-label">Description</label>
        <input type="text" name="description" class="form-control" placeholder="flower" value="{{ $flower->description }}" readonly>
        <div class="col-xs-12 col-sm-12 col-md-12 mb-10">
            <div class="form-group mb-10">
                <strong>Image:</strong>
                @if(file_exists(public_path('img/' . $flower->image_url)))
                <img src="{{ asset('img/' . $flower->image_url) }}" width="100" height="100" class="img img-responsive mt-3" alt="hình">
                @else
                <img src="{{ asset($flower->image_url) }}" width="100" height="100" class="img img-responsive mt-3" alt="không có hình">
                @endif
            </div>
        </div>
        <h2 style="margin-top:10px">List of regions</h2>
        <table class="table table-hover">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Region Name</th>
                </tr>
            </thead>
            <tbody>
                @if($regions->count() > 0)
                @foreach($regions as $rs)
                <tr>
                    <td class="align-middle">{{ $rs->id }}</td>
                    <td class="align-middle">{{ $rs->region_name }}</td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="4" class="text-center">No data</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col">
        <a href="{{ route('flowers.index')}}" class="btn btn-warning">Back</a>
    </div>
</div>
</div>
@endsection