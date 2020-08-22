<form action="{{ route('books.destroy', $id) }}" method="POST">
    <a class="btn btn-sm btn-primary" href="{{ route('books.show', $id) }}">Show</a>
    <a class="btn btn-sm btn-success" href="{{ route('books.edit', $id) }}">Edit</a>
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
</form>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mt-1" data-toggle="modal" data-target="#exampleModal{{ $id }}">
    @if($borrow===0) Make unavailable
    @else Make available
    @endif
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong>{{ $name }}</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Current status: <strong><i>@if($borrow===0) available @else unavailable @endif</i></strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form action="{{ route('books.available', $id) }}" method="POST" class="mt-1">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-primary btn-sm">
                        @if($borrow===0) Make unavailable
                        @else Make available
                        @endif
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#exampleModal{{ $id }} button').on('click', function() {
        let target = this;
        console.log(typeof(target));
        for (k in target) {
            if (target.id === 'submit') {
                console.log('ES SUBMIT: ' + target[k]);
                break;
            } else {
                console.log('NO ES SUBMIT: ' + target[k]);
                break;
            }
        }
    })
</script>