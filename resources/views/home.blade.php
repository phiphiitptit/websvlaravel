@extends('layouts.dashboarduser')

@section('content')
<div class="container-fluid">
    <div class="table-responsive">
        <table class="table table-striped table-sm" style="text-align: center;" id="tableUser">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Công việc</th>
                    <th>Điện thoại</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php $count = 0; ?>
                @foreach ($allUser as $user)
                <tr>
                    <td><?php echo ++$count; ?></td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        <?php if ($user->usertype == '1') {
                            echo "Giáo viên";
                        } else {
                            echo "Học sinh";
                        } ?>
                    </td>
                    <td>{{$user->telephone}}</td>


                    <td>
                        <a class="view-modal btn btn-info" href="/userprofile/{{$user->id}}">

                            <span class="glyphicon glyphicon-edit"></span> Xem
                        </a>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
@endsection
