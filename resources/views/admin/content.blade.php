<x-admin.layout title="Content">
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
            <i data-feather="plus"></i> Add Content
        </button>
    </x-slot>

    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body" style="overflow: scroll">
                        <table class='table table-striped' id="UserTable" urlAjax="{!! route('admin.content') !!}">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Title</th>
                                    <th>Keterangan</th>
                                    <th>File</th>
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
                            data: 'kode',
                            name: 'Kode'
                        },
                        {
                            data: 'title',
                            name: 'Title'
                        },
                        {
                            data: 'desc_content',
                            name: 'Keterangan'
                        },
                        {
                            data: 'file',
                            name: 'File'
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

            const initDatatable = (selector , columns = {} , settings = {}) => {
                let tableSelector = $(selector);
                let settingsDatatable = {
                    processing: true,
                    responsive: true,
                    serverSide: true,
                    ajax: tableSelector.attr("urlAjax"), // memanggil route yang menampilkan data json
                }

                if (columns != {} ) {
                    settingsDatatable.columns = columns
                }

                if (settings != {}) {
                    $.each(settings, function (index, item) { 
                        settingsDatatable[index] = item
                    });
                }

                let dataTable = $("#UserTable").DataTable(
                    settingsDatatable
                );
            }
        </script>
    </x-slot>

</x-admin.layout>

@include('admin.master.default')
