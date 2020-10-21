@if(session()->has('success'))
    <div class="alert alert-green">
        {{ session('success') }}
    </div>
@endif