<x-admin.layout title="Faq">
    <x-slot name="styles">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
        <style>
            .btn-right {
                float: right;
            }
        </style>
    </x-slot>

    <x-slot name="buttons">
        {{-- <a href="{{ url("admin/content/form") }}" class="btn btn-primary btn-sm btn-right btn-tambah" >
            <i data-feather="plus"></i> Add Content
        </a> --}}
    </x-slot>

    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body" style="overflow: scroll">
                        <table class='table table-striped' id="ContentTable" urlAjax="{{ url("admin/faq") }}">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Message</th>
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
                initDatatable("#ContentTable" , 
                    [{ // mengambil & menampilkan kolom sesuai tabel database
                            data: 'name',
                            name: 'Name'
                        },
                        {
                            data: 'email',
                            name: 'Email'
                        },
                        {
                            data: 'subject',
                            name: 'Subject'
                        },
                        {
                            data: 'message',
                            name: 'Message'
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

            $("#ContentTable tbody").on("click", ".btn-delete", function() {
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
                        ajaxData("/delete/content", {
                            "id": data.id
                        }, function(resp) {
                            toastrshow("success", "Data berhasil dihapus", "Success");
                            ReloadDataTable("#ContentTable")
                        })
                    }
                })
            })

            $("#ContentTable tbody").on("click", ".btn-update", function() {
                let data = $(this).data();
                location.href = "{{ url("admin/faq/form?id=") }}" + data.id
            })
        </script>
    </x-slot>

</x-admin.layout>

@include('admin.master.default')
