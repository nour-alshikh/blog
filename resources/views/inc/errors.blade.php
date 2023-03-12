@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="py-0 m-0">
            @foreach ($errors->all() as $error)
            <li class="p-0 m-0">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
