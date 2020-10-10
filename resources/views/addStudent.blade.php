@extends('admin.layout')

@section('content')
<div class="container-fluid">
  
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">


            <div class="btn-group mr-2">
                <a class="btn btn-info" href="{{route('admin.dashboard')}}">
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
        <form action="{{route('addStudent')}}" method="post">
            {{ csrf_field() }}
            <div class="form-group col-md-6">
                <label for="inputName">Họ tên</label>
                <input type="text" class="form-control" name="name" required="required" id="inputName" required="required">
            </div>

            <div class="form-group col-md-6">
                <label for="inputUser">Tài khoản</label>
                <input type="text" class="form-control" id="inputUser" name="username" required="required" >
            </div>
            <div class=" form-group col-md-6">
                <label for="inputPassword">Mật khẩu</label>
                <input type="password" class="form-control" id="inputPassword" name="password" required="required" >
            </div>

            <div class=" form-group col-md-6">
                <label for="inputEmail">Email</label>
                <input type="email" class="form-control" id="inputEmail" name="email" required="required" >
            </div>
            <div class=" form-group col-md-6">
                <label for="inputTel">Điện thoại</label>
                <input type="text" class="form-control" id="inputTel" name="telephone" required="required" >
            </div>

            <button class=" btn btn-primary col-md-6" type="submit" name="submit" style="background: #556B2F;">Thêm học sinh</button>
        </form>
  
</div>
@endsection