<x-admin.layout title="Article">
    <x-slot name="styles">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
        <style>
            .btn-right {
                float: right;
            }
        </style>
    </x-slot>

    <x-slot name="buttons">
        <a href="{{ url("admin/article/form") }}" class="btn btn-primary btn-sm btn-right btn-tambah" >
            <i data-feather="plus"></i> Add Article
        </a>
    </x-slot>

    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body" style="overflow: scroll">
                        <table class='table table-striped' id="ArticleTable" urlAjax="{{ url("admin/article") }}">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Title</th>
                                    <th>Posted By</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        {{-- <script src="{{ asset('admin_assets/dist/assets/vendors/simple-datatables/simple-datatables.js') }}"></script> --}}
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

        <script>
            $(function() {
                initDatatable("#ArticleTable" , 
                    [{ // mengambil & menampilkan kolom sesuai tabel database
                            data: 'kode',
                            name: 'Kode'
                        },
                        {
                            data: 'title',
                            name: 'Title'
                        },
                        {
                            data: 'posted_by',
                            name: 'posted_by'
                        },
                        {
                            data: 'action',
                            name: 'Action',
                            orderable: false, 
                            searchable: false
                        }
                    ]

                )
            });;

            $("#ArticleTable tbody").on("click", ".btn-delete", function() {
                let data = $(this).data();
                Swal.fire({
                    title: 'Anda Yakin akan menghapus "' + data.name + '" ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        ajaxData("/delete/articles", {
                            "id": data.id
                        }, function(resp) {
                            toastrshow("success", "Data berhasil dihapus", "Success");
                            ReloadDataTable("#ArticleTable")
                        })
                    }
                })
            })

            $("#ArticleTable tbody").on("click", ".btn-update", function() {
                let data = $(this).data();
                location.href = "{{ url("admin/article/form?id=") }}" + data.id
            })
        </script>
    </x-slot>

</x-admin.layout>

@include('admin.master.default')
