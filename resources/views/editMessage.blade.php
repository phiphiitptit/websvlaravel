@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <div class="col-lg-2">
        <div class="btn-group mr-2">
            <a class="btn btn-info" href="{{ route('message') }}">
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
                            <h4><?php echo $user[0]->name; ?></h4>
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
                                <th>Gửi tin nhắn cho <?php echo $user[0]->name; ?></th>
                                <th class="text-center"><a class="btn btn-sm btn-outline-success" href="/addMessage/{{$user[0]->id}}">Nhắn tin</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <div class="table-responsive">
                                <table class="table table-striped table-sm" style="text-align: center;">
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
                                    <thead>
                                        <form action="/editMessage/{{$user[0]->id}}" method="post">
                                            {{ csrf_field() }}

                                            <div class="form-group col-md-6">

                                                <input type="hidden" class="form-control" name="id" value="<?php echo $user[0]->id; ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputName">Tiêu đề</label>
                                                <input type="text" class="form-control" name="title" required="required" id="inputName" value="{{$user[0]->title}}">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="inputUser">Tin nhắn</label>
                                                <textarea type="text" rows="5" class="form-control" id="inputUser" name="msg" required="required" >
                                                {{$user[0]->msg}}  </textarea>
                                            </div>

                                            <button class="btn btn-primary col-md-6" type="submit" name="sendmessage" style="background: #556B2F;">Cập nhập</button>




                                        </form>
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