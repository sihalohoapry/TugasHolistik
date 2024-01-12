@if (session('status'))
    <div class="alert alert-success alert-dismiss=">
        <button type="button" class="btn btn-close" data-dismiss="alert" aria-hidden="true"></button>
        {{ session('status') }}
    </div>
@endif
