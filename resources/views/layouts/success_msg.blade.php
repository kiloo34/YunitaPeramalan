@if(session('success_msg'))
<div class="alert alert-success alert-dismissible show fade">
    <button class="close" data-dismiss="alert">
        <span>&times;</span>
    </button>
    {{ session('success_msg') }}
</div>
@endif
