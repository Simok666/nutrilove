<x-admin.layout title="Riwayat Cek Gizi">
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
                        <table class='table table-striped' id="ContentTable" urlAjax="{{ url("admin/gizi") }}">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Usia</th>
                                    <th>Tinggi Badan(Cm)</th>
                                    <th>Berat Badan (Kg)</th>
                                    <th>IMT</th>
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
                            data: 'nama',
                            name: 'Nama'
                        },
                        {
                            data: 'jenis_kelamin',
                            name: 'jenis_kelamin'
                        },
                        {
                            data: 'usia',
                            name: 'usia'
                        },
                        {
                            data: 'tb',
                            name: 'tb'
                        },
                        {
                            data: 'bb',
                            name: 'bb'
                        },
                        {
                            data: 'imt',
                            name: 'IMT',
                            orderable: false, 
                            searchable: false
                        }
                    ]

                )
            });;

            $("#ContentTable tbody").on("click", ".btn-update", function() {
                let data = $(this).data();
                location.href = "{{ url("admin/faq/form?id=") }}" + data.id
            })
        </script>
    </x-slot>

</x-admin.layout>

