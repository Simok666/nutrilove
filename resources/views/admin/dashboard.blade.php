<x-admin.layout title="Dashboard">
    <x-slot name="message">
        Dashboard Admin
    </x-slot>
    <x-slot name="styles">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
        <style>
            .btn-right {
                float: right;
            }
        </style>
    </x-slot>

    <x-slot name="buttons">
    </x-slot>

    <div class="row match-height">
        <div class="row mb-2">
            <div class="col-12 col-md-3">
                <div class="card card-statistic">
                    <div class="card-body p-0">
                        <div class="d-flex flex-column">
                            <div class='px-3 py-3 d-flex justify-content-between'>
                                <h3 class='card-title'>Article</h3>
                                <br>
                                <div class="card-right d-flex align-items-center">
                                    <p>{{ $countArticle ?? '0' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-12 col-md-3">
                <div class="card card-statistic">
                    <div class="card-body p-0">
                        <div class="d-flex flex-column">
                            <div class='px-3 py-3 d-flex justify-content-between'>
                                <h3 class='card-title'>Viewers</h3>
                                <div class="card-right d-flex align-items-center">
                                    <p>{{ $countViewers ?? '0' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="card card-statistic">
                    <div class="card-body p-0">
                        <div class="d-flex flex-column">
                            <div class='px-3 py-3 d-flex justify-content-between'>
                                <h3 class='card-title'>User & Admin</h3>
                                <div class="card-right d-flex align-items-center">
                                    <p>{{ $countAdmin ?? '0' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        {{-- <script src="{{ asset('admin_assets/dist/assets/vendors/simple-datatables/simple-datatables.js') }}"></script> --}}
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

        {{-- <script>
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
        </script> --}}
    </x-slot>

</x-admin.layout>
