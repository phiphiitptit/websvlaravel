@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">


        <div class="btn-group mr-2">
            <a class="btn btn-info" href="{{route('challenge')}}">
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
    <form method="post" action="/subChallenge">
        {{ csrf_field() }}
        <div class="form-group col-md-6">

            <input type="hidden" class="form-control" name="id" value="<?php echo $data->id; ?>">
        </div>
        <div class="form-group col-md-6">
            <label for="inputName">Tên Challenge</label>
            <input type="text" class="form-control" name="ChallName" required="required" id="inputName" value="<?php echo $data->name; ?>" readonly>
        </div>
        <div class="form-group col-md-6">
            <label for="inputName">Hint</label>
            <input type="text" class="form-control" name="hint" required="required" id="inputName" value="<?php echo $data->hint; ?>" readonly>
        </div>
        <div class="form-group col-md-6">
            <label for="inputAnswer">Đáp án</label>
            <input type="text" class="form-control" name="answer" required="required" id="inputAnswer">
        </div>
        <button type="submit" class="btn btn-primary col-md-6" name="submit">Submit Challenge</button>
       
    </form>
</div>
@endsection