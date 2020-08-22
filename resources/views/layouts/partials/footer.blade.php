<div class="row">
    <div class="col-md-12 text-center">
        <div>
            <h6><span class="text-secondary">Desarrollado por</span> David Durán</h6>
            <p class="mb-0">con Laravel + Bootstrap</p>
            <p class="my-0"><i class="far fa-smile"></i></p>
        </div>
    </div>
</div>
<div class="main-loading">
    <img src="{{ asset('img/spinner.gif') }}" alt="Loading..." />
</div>
<div class="alert alert-danger alert-gral-error text-center"></div>
<div class="alert alert-success alert-gral-success text-center"></div>


<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" defer></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js" defer></script>
<script type="text/javascript" defer>
    jQuery(document).ready(function() {
        jQuery('#tablaBooks').DataTable({
            serverSide: true,
            "ajax": {
                "url": "{{ route('books.datatables') }}",
                "type": "GET",
                "datatype": 'json',
            },
            "columns": [{
                    data: 'id'
                },
                {
                    data: 'name',
                    "width": "80px"
                },
                {
                    data: 'author',
                    "width": "80px"
                },
                {
                    data: 'categoryName', // Field name
                    name: 'category', // Column name
                    // orderable: true,
                },
                {
                    data: 'borrow'
                },
                {
                    data: 'published_date',
                    "width": "80px"
                },
                {
                    data: 'userName',
                    name: 'user',
                    "width": "70px"
                },
                {
                    data: 'actions'
                }
            ],
            "columnDefs": [{
                "targets": 4,
                "data": "borrow",
                "render": function(data, type, row, meta) {
                    for (key in row) {
                        if (row.borrow == 1) {
                            return 'Borrowed';
                        } else {
                            return 'Free';
                        }
                    }
                }
            }],
            // "lengthMenu": [2, 3, 4, 5, 10, 25, 50, 75, 100],
            "lengthMenu": [10, 25, 50, 75, 100],
        });
    });
</script>