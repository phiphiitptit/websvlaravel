@extends('admin.layout')

@section('content')
<div class="container-fluid">
   
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">


            <div class="btn-group mr-2">
                <a class="btn btn-info" href="{{route('admin.dashboard')}}">
                    Quay lại</a>
            </div>



        </div>
        <form action="/editprofile/<?php echo $user[0]->id; ?>" method="post">
        {{ csrf_field() }}

            <div class="row">
                <?php if (isset($_REQUEST['error'])) { ?>
                    <div class="col-lg-12">
                        <span class="alert alert-danger" style="display: block;"><?php echo $_REQUEST['error']; ?></span>
                    </div>
                <?php } ?>
            </div>
            <div class="row">
                <?php if (isset($_REQUEST['success'])) { ?>
                    <div class="col-lg-12">
                        <span class="alert alert-success" style="display: block;"><?php echo $_REQUEST['success']; ?></span>
                    </div>
                <?php } ?>
            </div>
            <div class="form-group col-md-6">

                <input type="hidden" class="form-control" name="id" value="{{$user[0]->id}}">
            </div>
            <div class="form-group col-md-6">
                <label for="inputName">Họ tên</label>
                <input type="text" class="form-control" name="name" required="required" id="inputName" value="{{$user[0]->name}}" readonly>
            </div>

            <div class="form-group col-md-6">
                <label for="inputUser">Tài khoản</label>
                <input type="text" class="form-control" id="inputUser" name="username" required="required" value="{{$user[0]->username}}" readonly>
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword">Mật khẩu</label>
                <input type="password" class="form-control" id="inputPassword" name="password" required="required" value="{{$user[0]->password}}" >
            </div>

            <div class="form-group col-md-6">
                <label for="inputEmail">Email</label>
                <input type="email" class="form-control" id="inputEmail" name="email" required="required" value="{{$user[0]->email}}">
            </div>
            <div class="form-group col-md-6">
                <label for="inputTel">Điện thoại</label>
                <input type="text" class="form-control" id="inputTel" name="telephone" required="required" value="{{$user[0]->telephone}}">
            </div>

            <button class="btn btn-primary col-md-6" type="submit" name="update" style="background: #556B2F;">Cập nhật</button> 
        </form>

</div>
@endsection