@extends('layouts.dashboarduser')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">


        <div class="btn-group mr-2">
            <a class="btn btn-info" href="{{route('userChallenge')}}">
                Quay lại</a>
        </div>
    </div>
    <?php if ($check) { ?>
        <div class="form-group col-md-6">
            <label for="inputAnswer">Đáp án</label>
            <p><?php echo $content ?></p>
        </div>
    <?php } ?>

</div>
@endsection