@if ($errors->any())
<div class="alert bg-maroon alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif