@if (session('status'))
    <div class="alert alert-info bg-light">
        {{ session('status') }}
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success bg-success">
        {{ session('success') }} <x-icon-check-circle />
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger bg-danger">
        {{ session('error') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger bg-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
