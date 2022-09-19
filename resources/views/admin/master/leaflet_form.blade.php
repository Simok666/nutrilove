<x-admin.layout title="Leaflet">
    <x-slot name="styles">
        <style>
            .btn-right {
                float: right;
            }
        </style>
        <script src="https://cdn.ckeditor.com/4.19.1/standard-all/ckeditor.js"></script>
    </x-slot>

    <x-slot name="buttons">

        <button class="btn btn-danger btn-sm  pl-10 pr-10" onclick="history.back()">
            <i data-feather="arrow-left"></i> Kembali
        </button>
        <button class="btn btn-primary btn-sm  btn-tambah" form="form" type="submit">
            <i data-feather="save"></i> Simpan Leaflet
        </button>
    </x-slot>
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body" style="overflow: scroll">
                        <center class="loading d-none">
                            <img width="100px" src="{{ asset('loading-data.gif') }}">
                        </center>
                        <div class="col-12">
                            <form id="form" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Kode</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control validasi" id="kode"
                                            name="kode" required>
                                            <input type="hidden" class="form-control validasi"
                                            name="id">
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control validasi" id="title"
                                            name="title" required>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Tumbnail</label>
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <input type="file" id="myPdf" class="form-control fileFormBase64">
                                            <input type="text" id="base64" class="base_64" name="fileBase64">
                                            <canvas id="pdfViewer" class="preview-pdf base64-preview"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">

        <script>

            var FrmEditAdmin = $("#form").validate({
                submitHandler: function(form) {
                    setTimeout(() => {
                        submitData(form, "/admin/leaflet/upsert", function(resp) {
                            if (empty(resp.IsError)) location.href = "{{ url('admin/leaflet') }}"
                        })
                    }, 400);
                },
                errorPlacement: function(error, element) {
                    if (element.parent(".input-group").length) {
                        error.insertAfter(element.parent()); // radio/checkbox?
                    } else if (element.hasClass("select2") || element.hasClass("select")) {
                        error.insertAfter(element.next("span")); // select2
                    } else {
                        error.insertAfter(element); // default
                    }
                }
            });

            const getDataDetail = (id) => {
                ajaxData("/detail/leaflet", {
                    "id": id
                }, function(resp) {
                    if (!empty(resp.Data)) {
                        showLoading(".card-body", false)
                        console.log(resp.Data);
                        if (!empty(resp.Data[0].file)) {
                            $("#form").find(".base64-preview").attr("src", resp.Data[0]
                                .file);
                        }
                        hiddenComponent(".card-body", false)
                    } else {
                        toastrshow("warning", "Data yang anda cari tidak ditemukan", "Failed")
                        setTimeout(() => {
                            location.href = "{{ url("admin/leaflet") }}"
                        }, 2000);
                    }
                })
            }

            $(".fileFormBase64").change(function() {
                let selector = $(this);
                let parent = $(this).parent();

                if (!this.files || !this.files[0]) {
                    return;
                }
                let tipefile = this.files[0].type.toString();
                // console.log(tipefile);
                if (tipefile != "application/pdf") {
                    $(this).val("");
                    toastrshow("warning", "Format salah, pilih file dengan format pdf", "Warning");
                    return;
                }
                // if((this.files[0].size / 1024) > 2048){
                //     $(this).val("");
                //     toastrshow("warning", "Maximum file size is 2 MB", "Warning");
                //     return;
                // }

            });
            
            // Check for the File API support.
            if (window.File && window.FileReader && window.FileList && window.Blob) {
            document.getElementById('myPdf').addEventListener('change', handleFileSelect, false);
            } else {
            alert('The File APIs are not fully supported in this browser.');
            }

            function handleFileSelect(evt) {
            var f = evt.target.files[0]; // FileList object
            var reader = new FileReader();
            // Closure to capture the file information.
            reader.onload = (function(theFile) {
                return function(e) {
                var binaryData = e.target.result;
                //Converting Binary Data to base 64
                var base64String = window.btoa(binaryData);
                //showing file converted to base64
                document.getElementById('base64').value = base64String;
                alert('File converted to base64 successfuly!\nCheck in Textarea');
                };
            })(f);
            // Read in the image file as a data URL.
            reader.readAsBinaryString(f);
            }

            $(document).ready(function () {
                let id = "{{ $id_update }}"
                if (!empty(id)) {
                    getDataDetail(id)
                }
            });
        </script>
    </x-slot>

</x-admin.layout>
