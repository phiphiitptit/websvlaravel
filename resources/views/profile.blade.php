@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <!-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div> -->

    <div class="col-lg-2">
        <div class="btn-group mr-2">
            <a class="btn btn-info" href="{{ route('admin.dashboard') }}">
                Quay lại</a>
        </div>
    </div>
    <div class="container padding-bottom-3x mb-2">
        <div class="row">

            <div class="col-lg-4">
                <aside class="user-info-wrapper">

                    <div class="user-info">
                        <div class="user-avatar">
                            <a class="edit-avatar" href="#"></a><img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="User"></div>
                        <div class="user-data">
                            <h4>{{$user->name}}</h4>
                        </div>
                    </div>
                </aside>
            </div>
            <div class="col-lg-8 row align-items-center">
                <div class="padding-top-2x mt-2 hidden-lg-up"></div>
                <!-- Wishlist Table-->
                <div class="table-responsive wishlist-table margin-bottom-none">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Thông tin chi tiết</th>
                                <th class="text-center"><a class="btn btn-sm btn-outline-success" href="/addMessage/{{$user->id}}">Nhắn tin</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <div class="table-responsive">
                                <table class="table table-striped table-sm" style="text-align: center;">
                                    <thead>
                                        <tr style="   line-height: 40px;">
                                            <th>Họ tên</th>
                                            <th>{{$user->name}}</th>
                                        </tr>
                                        <tr style="   line-height: 40px;">
                                            <th>Email</th>
                                            <th>{{$user->email}}</th>
                                        </tr>
                                        <tr style="   line-height: 40px;">
                                            <th>Số điện thoại</th>
                                            <th>{{$user->telephone}}</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection