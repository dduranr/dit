@extends('layouts.app')

@section('content')
<!-- Esta vsita se encarga de mostrar la info del book seleccionado -->
<div class="row">
    <div class="col-md-12 text-center">
        <h1>Viewing the book #{{ $data['book']->id }}</h1>
    </div>
</div>

<ul>
</ul>

<div class="row">
    <div class="col-md-12 my-5">
        <div class="card m-auto" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"> {{ $data['book']->name }} </h5>
                <table class="table table-sm">
                    <tr>
                        <td><strong>Author:</strong></td>
                        <td>{{ $data['book']->author }}</td>
                    </tr>
                    <tr>
                        <td><strong>Category:</strong></td>
                        @foreach($data['cats'] as $cat)
                            @if($cat->id===$data['book']->category) <td>{{ $cat->name }}</td> @endif
                        @endforeach
                    </tr>
                    <tr>
                        <td><strong>Published:</strong></td>
                        <td>{{ $data['book']->published_date }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection