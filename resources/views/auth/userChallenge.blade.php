@extends('layouts.dashboarduser')

@section('content')
<div class="container-fluid">
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
                            <a class="btn btn-info" href="/userViewChallenge/{{$d->id}}">
                                Xem</a>
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