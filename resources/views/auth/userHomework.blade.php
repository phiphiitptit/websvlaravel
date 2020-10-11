@extends('layouts.dashboarduser')

@section('content')
<div class="container-fluid">
    <div class="table-responsive">
        <table class="table table-striped table-sm" style="text-align: center;">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Bài tập</th>
                    <th>Kích thước</th>
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                foreach ($allHomework as $d) {
                ?>
                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td><?php echo $d->subject_name; ?></td>
                        <td><?php echo $d->size . ' KB'; ?></td>
                        <td><?php echo $d->created_at; ?></td>
                        <td>

                            <!-- <a class="btn btn-info" href="/userViewHomework/{{$d->id}}">
                                Xem</a> -->
                            <a class="btn btn-info" href="/userDownloadHomework/{{$d->id}}">
                                Dowload</a>
                            <a class="btn btn-info" href="/uploadHomework/{{$d->id}}">
                                Upload</a>
                            <!-- <a class="btn btn-info btn-danger" href="/userDeleteHomework/{{$d->id}}" onclick="return confirm('Bạn có chắc chắn xóa?')">
                                Xóa</a> -->

                        </td>

                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
@endsection