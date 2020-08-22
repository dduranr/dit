@extends('layouts.app')

@section('content')
<div class="container w-90">
    <div class="row">
        <div class="col-md-12 text-center mb-5">
            <h1 class="mb-5">Have fun!</h1>
            <a href="{{ route('books.create') }}" class="btn btn-success">CREATE BOOK</a>
        </div>
        <div class="col-md-12 text-center mb-5">
            @if(session('msg_success'))
            <div class="alert alert-success">
                {{ session('msg_success') }}
            </div>
            @endif

            @if(session('msg_error'))
            <div class="alert alert-danger">
                {{ session('msg_error') }}
            </div>
            @endif
        </div>

        <div class="col-md-12">
            <table id="tablaBooks" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>AUTHOR</th>
                        <th>CATEGORY</th>
                        <th>BORROW</th>
                        <th>PUBLISH DATE</th>
                        <th>USER</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@endsection