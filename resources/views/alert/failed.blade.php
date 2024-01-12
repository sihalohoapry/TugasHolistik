@if (session('fail'))
    <div class="alert alert-danger alert-dismiss=">
        <button type="button" class="btn btn-close" data-dismiss="alert" aria-hidden="true"></button>
        {{ session('fail') }}
    </div>
@endif
