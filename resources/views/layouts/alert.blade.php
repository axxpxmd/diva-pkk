@if (session()->has('success'))
<div class="alert alert-success fs-14" id="successAlert" role="alert">
    {{ session('success') }}
</div>

@endif

<!-- Alert Errors -->
@if (count($errors) > 0)
<div class="alert alert-danger fs-14" id="errorAlert">
    <strong>Whoops Error!</strong>&nbsp;
    <span>Terdapat {{ $errors->count() }} error</span>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif 

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $("#successAlert").fadeTo(10000, 1000).slideUp(1000, function() {
            $("#successAlert").slideUp(1000);
        });
    });

    $(document).ready(function() {
        $("#errorAlert").fadeTo(10000, 1000).slideUp(1000, function() {
            $("#errorAlert").slideUp(1000);
        });
    });
</script>