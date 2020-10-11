@extends('layouts.dashboarduser')

@section('content')
<div class="container-fluid">

    <div class="col-lg-2">
        <div class="btn-group mr-2">
            <a class="btn btn-info" href="{{ route('userMessage') }}">
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
                            <h4><?php echo $data[0]->name; ?></h4>
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
                                <th>Gửi tin nhắn cho <?php echo $data[0]->name; ?></th>
                                <!-- <th class="text-center"><a class="btn btn-sm btn-outline-success" href="/addMessage/{{$data[0]->id}}">Nhắn tin</a></th> -->
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
                                        <form method="post">
                                        {{ csrf_field()}}
                                            <div class="form-group col-md-6">
                                                <label for="inputName">Tiêu đề</label>
                                                <p><?php echo $data[0]->title; ?></p>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="inputUser">Tin nhắn</label>
                                                <p><?php echo $data[0]->msg; ?></p>
                                            </div>

                            
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