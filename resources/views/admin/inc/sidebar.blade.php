<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                    <span class="iconify" data-icon="bi:file-person" data-inline="false"></span>
                    Quản lý học sinh <span class="sr-only">(current)</span>
                </a>
            </li>
           
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('homework') }}" >
                    <span class="iconify" data-icon="bi-file-earmark-binary" data-inline="false"></span>
                    Quản lý bài tập <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('challenge') }}">
                    <span class="iconify" data-icon="bi-patch-question" data-inline="false"></span>
                    Quản lý Challenge <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('message') }}">
                    <span class="iconify" data-icon="bi-patch-question" data-inline="false"></span>
                    Quản lý tin nhắn <span class="sr-only">(current)</span>
                </a>
            </li>
        </ul>
    </div>
</nav>