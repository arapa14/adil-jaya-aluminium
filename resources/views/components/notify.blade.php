@if (session('status'))
    <div class="alert alert-info bg-light">
        {{ session('status') }}
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success bg-light">
        {{ session('success') }} <x-icon-check-circle />
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger bg-light">
        {{ session('error') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger bg-light">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
