@extends('admin.layout')

@section('content')
<div class="container-fluid">




    <ul class="nav nav-tabs">
        <li class="active"><a class="btn btn-info" href="#send">Tin nhắn gửi đi</a></li>
        <li><a class="btn btn-info" href="#noseen">Tin nhắn chưa xem</a></li>
        <li><a class="btn btn-info" href="#seen">Tin nhắn đã xem</a></li>
    </ul>

    <div class="tab-content">
        <div id="send" class="tab-pane fade in active">
            <div class="table-responsive">
                <table class="table table-striped table-sm" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Người nhận</th>
                            <th>Ngày gửi</th>
                            <th>Tiêu đề</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 0;
                        foreach ($data_send as $d) {
                        ?>
                            <tr>
                                <td><?php echo ++$count; ?></td>
                                <td><?php echo $d->name; ?></td>
                                <td><?php echo $d->created_at; ?></td>
                                <td><?php echo $d->title; ?></td>

                                <td><a class="btn btn-info" name="seenmes" href="viewMessage/{{$d->id}}">
                                        Xem</a>
                                    <a class="btn btn-info" name="edit" href="editMessage/{{$d->id}}">
                                        Sửa</a>
                                    <a class="btn btn-info btn-danger" name="delete" href="deleteMessage/{{$d->id}}">
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
        <div id="noseen" class="tab-pane fade">
            <div class="table-responsive">
                <table class="table table-striped table-sm" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Người gửi</th>
                            <th>Ngày gửi</th>
                            <th>Tiêu đề</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 0;
                        foreach ($data_noseen as $d) {
                        ?>
                            <tr>
                                <td><?php echo ++$count; ?></td>
                                <td><?php echo $d->name; ?></td>
                                <td><?php echo $d->created_at; ?></td>
                                <td><?php echo $d->title; ?></td>
                                <td><a class="btn btn-info" name="seenmes" href="viewMessage/{{$d->id}}">
                                        Xem</a>

                                    <a class="btn btn-info" name="checkseen" href="seenMessage/{{$d->id}}">
                                        Đã xem</a>
                                </td>

                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="seen" class="tab-pane fade">
            <div class="table-responsive">
                <table class="table table-striped table-sm" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Người gửi</th>
                            <th>Ngày gửi</th>
                            <th>Tiêu đề</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 0;
                        foreach ($data_seen as $d) {
                        ?>
                            <tr>
                                <td><?php echo ++$count; ?></td>
                                <td><?php echo $d->name; ?></td>
                                <td><?php echo $d->created_at; ?></td>
                                <td><?php echo $d->title; ?></td>
                                <td><a class="btn btn-info" name="seenmes" href="viewMessage/{{$d->id}}">
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

    </div>
    <hr>



</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js">
</script>
<script>
    $(document).ready(function() {
        $(".nav-tabs a").click(function() {
            $(this).tab('show');
        });
        $('.nav-tabs a').on('shown.bs.tab', function(event) {
            var x = $(event.target).text(); // active tab
            var y = $(event.relatedTarget).text(); // previous tab
            $(".act span").text(x);
            $(".prev span").text(y);
        });
    });
</script>
@endsection