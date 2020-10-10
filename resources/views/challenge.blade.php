@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <div class="btn-group mr-2">
            <a class="btn btn-info" href="add_challenge.php">
                Thêm Challenge</a>
        </div>

    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm" style="text-align: center;">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Challenge</th>
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count=1;
                foreach ($allChallenge as $d) {
                ?>
                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td><?php echo $d->name; ?></td>
                        <td><?php echo $d->created_at; ?></td>
                        <td>
                            <a class="btn btn-info" href="view_challenge.php?id=<?php echo $d->id; ?>">
                                Xem</a>

                            <a class="btn btn-info" href="add_challenge.php?id=<?php echo $d->id; ?>">
                                Sửa</a>
                            <a class="btn btn-info" href="add_challenge_post.php?iddelete=<?php echo $d->id; ?>" onclick="return confirm('Bạn có chắc chắn xóa?')">
                                Xóa</a>

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