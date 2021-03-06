@extends('layouts.app')

@section('content')
<!-- Esta vista corresponde con el formulario para editar al book seleccionado -->
<div class="row">
    <div class="col-md-12 text-center">
        <h1>UPDATE</h1>
        <h3>Editando: <i>{{ $book->name }}</i></h3>
    </div>

    <div class="col-md-12">
        <!-- Esto se encarga de mostrar errores de validación -->
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Esto se encarga de mostrar el mensaje de éxito en caso que se haya generado correctamente el book -->
        @if(session('msg_success'))
        <div class="alert alert-success">
            {{ session('msg_success') }}
        </div>
        @endif

        <!-- Esto se encarga de mostrar el mensaje de error en caso que se haya generado correctamente el book -->
        @if(session('msg_error'))
        <div class="alert alert-danger">
            {{ session('msg_error') }}
        </div>
        @endif
    </div>

    <div class="col-md-6 mx-auto">
        <!-- Aquí va el formulario propiamente, el cual apunta a la ruta encargada de actualizar al book en cuestión. Cada campo tiene como value el dato proveniente de la base de datos -->
        <form action="{{ route('books.update', $book->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $book->name }}" />
                @error('name')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="form-group">
                <label for="author">Author</label>
                <input type="author" name="author" id="author" class="form-control" value="{{ $book->author }}" />
                @error('author')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="form-group">
                (Categories: Terror, Classic, Comedy)
                <input type="text" id='category_search' placeholder="Category" class="form-control @error('category') is-invalid @enderror" />
                <input type="hidden" name="category" id="categoryid" value="{{ old('category') }}">
                @error('category')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="form-group">
                <select type="text" name="borrow" class="form-control @error('borrow') is-invalid @enderror" value="{{ old('borrow') }}">
                    <option value="">:: Do you want to borrow it? ::</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                @error('borrow')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <input type="submit" value="Actualizar" class="form-control btn btn-success" />
        </form>
    </div>

    <script>
        // CSRF Token
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {
            console.log('Se lee el jQuery de CREATE');
            $("#category_search").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "{{ route('categories.getForAutocomplete') }}",
                        type: 'GET',
                        dataType: "json",
                        data: {
                            _token: CSRF_TOKEN,
                            search: request.term
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                select: function(event, ui) {
                    $('#category_search').val(ui.item.label); // display the selected text
                    $('#categoryid').val(ui.item.value); // save selected id to input
                    return false;
                }
            });
        });
    </script>

</div>
@endsection