@extends('admin.layout')

@section('content')
<div class="container-fluid">
  
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <div class="btn-group mr-2">
            <a class="btn btn-info" href="/addStudent">
                Thêm SV</a>
        </div>

    </div>
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
                        <a class="view-modal btn btn-info" href="/profile/{{$user->id}}">

                            <span class="glyphicon glyphicon-edit"></span> Xem
                        </a>
                        <a class="edit-modal btn btn-info" href="/editprofile/{{$user->id}}">
                            <span class="glyphicon glyphicon-edit"></span> Sửa
                        </a>
                        <a class="delete-modal btn btn-danger" href="/delete/{{$user->id}}" onclick="return confirm('Bạn có chắc chắn xóa?')">
                            <span class="glyphicon glyphicon-trash"></span> Xóa
                        </a></td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
@endsection