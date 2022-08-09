<x-admin.layout title="Setting Gizi">
    <x-slot name="styles">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
        <style>
            .btn-right {
                float: right;
            }
        </style>
    </x-slot>

    <x-slot name="buttons">
        <button class="btn btn-primary btn-sm btn-right btn-admin-tambah" data-bs-toggle="modal" data-bs-target="#settingGizi">
            <i data-feather="plus"></i> Add Hasil Rumus
        </button>
    </x-slot>

    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body" style="overflow: scroll">
                        <table class='table table-striped' id="SettingGiziTable" urlAjax="{!! route('setting.gizi') !!}">
                            <thead>
                                <tr>
                                    <th>Hasil Rumus</th>
                                    <th>Keterangan</th>
                                    <th>Pesan</th>
                                    <th style="width: 80px">Action</th>
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
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

        <script>
            $(function() {
                initDatatable("#SettingGiziTable" , 
                    [{ // mengambil & menampilkan kolom sesuai tabel database
                            data: 'nilai_rumus',
                            name: 'nilai_rumus'
                        },
                        {
                            data: 'keterangan',
                            name: 'keterangan'
                        },
                        {
                            data: 'pesan',
                            name: 'pesan'
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

                let dataTable = $(selector).DataTable(
                    settingsDatatable
                );
            }
        </script>
    </x-slot>

</x-admin.layout>

@include('admin.master.setting_gizi')
