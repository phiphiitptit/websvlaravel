@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">


        <div class="btn-group mr-2">
            <a class="btn btn-info" href="{{route('homework')}}">
                Quay lại</a>
        </div>
    </div>
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session('status') }}
    </div>
    @elseif(session('failed'))
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session('failed') }}
    </div>
    @endif
    <form action="/addHomework" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group col-md-6">
            <label for="inputName">Tên bài tập</label>
            <input type="text" class="form-control" name="subjectName" required="required" id="inputName">
        </div>
        <div class="form-group col-md-6">
            <label for="inputDownload">File Upload</label>
            <input type="file" class="form-control" name="download" required="required" id="inputDownload">
        </div>

        <button type="submit" class="btn btn-primary col-md-6" name="save">Tạo bài tập</button>


    </form>

</div>
@endsection