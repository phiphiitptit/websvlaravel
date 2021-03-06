@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">


        <div class="btn-group mr-2">
            <a class="btn btn-info" href="{{route('homework')}}">
                Quay lại</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm" style="text-align: center;">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Họ tên</th>
                    <th>Ngày nộp</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count=0;
                foreach ($allSub as $d) {
                ?>
                    <tr>
                        <td><?php echo ++$count; ?></td>
                        <td><?php echo $d->name; ?></td>
                        <td><?php echo $d->created_at; ?></td>
                        <td>

                            <a class="btn btn-info" href="/downloadSubHomework/{{$d->id}}">
                                Dowload</a>
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