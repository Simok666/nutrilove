<x-admin.layout title="Users">
    <x-slot name="styles">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
        <style>
            .btn-right {
                float: right;
            }
        </style>
    </x-slot>

    <x-slot name="buttons">
        <button class="btn btn-primary btn-sm btn-right btn-admin-tambah" data-bs-toggle="modal" data-bs-target="#adminModal">
            <i data-feather="plus"></i> Add Users
        </button>
    </x-slot>

    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body" style="overflow: scroll">
                        <table class='table table-striped' id="UserTable" urlAjax="{!! route('admin.index') !!}">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Alamat</th>
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
                initDatatable("#UserTable" , 
                    [{ // mengambil & menampilkan kolom sesuai tabel database
                            data: 'name',
                            name: 'Name'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'telp',
                            name: 'telp'
                        },
                        {
                            data: 'alamat',
                            name: 'alamat'
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
        </script>
    </x-slot>

</x-admin.layout>

@include('admin.master.admin')
