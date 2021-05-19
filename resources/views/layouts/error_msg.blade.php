@if(session('error_msg'))
<div class="alert alert-danger alert-dismissible show fade">
    <button class="close" data-dismiss="alert">
        <span>&times;</span>
    </button>
    {{ session('error_msg') }}
</div>
@endif
