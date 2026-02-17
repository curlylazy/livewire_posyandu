@if (session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check"></i> {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
