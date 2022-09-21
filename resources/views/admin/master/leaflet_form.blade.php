<x-admin.layout title="Leaflet">
    <x-slot name="styles">
        <style>
            .btn-right {
                float: right;
            }
        </style>
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
                                        <input type="hidden" class="form-control validasi" name="id">
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
                                            <input type="hidden" id="base64" class="base_64" name="fileBase64">
                                            <span class="file-download"></span><br>
                                            note: Only first page in preview
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
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.489/pdf.min.js"></script> --}}
        <script>
            var pdfjsLib = window['pdfjs-dist/build/pdf'];
            // The workerSrc property shall be specified.
            pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://mozilla.github.io/pdf.js/build/pdf.worker.js';

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
                        $.each(resp.Data[0], function(index, value) {
                            if (index !== "desc_content") $("#form").find("[name=" + index + "]").val(value)
                                .trigger("change")
                        });
                        if (!empty(resp.Data[0].file)) {
                            const loadingTask = pdfjsLib.getDocument(resp.Data[0]
                                .file);

                            (async () => {
                                const pdf = await loadingTask.promise;
                                //
                                // Fetch the first page
                                //
                                const page = await pdf.getPage(1);
                                const scale = 1.5;
                                const viewport = page.getViewport({
                                    scale
                                });
                                // Support HiDPI-screens.
                                const outputScale = window.devicePixelRatio || 1;

                                //
                                // Prepare canvas using PDF page dimensions
                                //
                                const canvas = document.getElementById("pdfViewer");
                                const context = canvas.getContext("2d");

                                canvas.width = Math.floor(viewport.width * outputScale);
                                canvas.height = Math.floor(viewport.height * outputScale);
                                canvas.style.width = Math.floor(viewport.width) + "px";
                                canvas.style.height = Math.floor(viewport.height) + "px";

                                const transform = outputScale !== 1 ?
                                    [outputScale, 0, 0, outputScale, 0, 0] :
                                    null;

                                //
                                // Render PDF page into canvas context
                                //
                                const renderContext = {
                                    canvasContext: context,
                                    transform,
                                    viewport,
                                };
                                page.render(renderContext);
                            })();
                            $(".file-download").html("<a href='"+ resp.Data[0].file +"'> Preview All </a>");
                        }
                        hiddenComponent(".card-body", false)
                    } else {
                        toastrshow("warning", "Data yang anda cari tidak ditemukan", "Failed")
                        setTimeout(() => {
                            location.href = "{{ url('admin/leaflet') }}"
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

            });

            // Check for the File API support.
            // if (window.File && window.FileReader && window.FileList && window.Blob) {
            document.getElementById('myPdf').addEventListener('change', handleFileSelect, false);
            // } else {
            //     alert('The File APIs are not fully supported in this browser.');
            // }

            $("#myPdf").on("change", function(e) {
                var file = e.target.files[0]
                if (file.type == "application/pdf") {
                    var fileReader = new FileReader();
                    fileReader.onload = function() {

                        var pdfData = new Uint8Array(this.result);
                        // Using DocumentInitParameters object to load binary data.
                        var loadingTask = pdfjsLib.getDocument({
                            data: pdfData
                        });

                        loadingTask.promise.then(function(pdf) {
                            // Fetch the first page
                            var pageNumber = 1;
                            pdf.getPage(pageNumber).then(function(page) {
                                console.log('Page loaded');

                                var scale = 1.5;
                                var viewport = page.getViewport({
                                    scale: scale
                                });

                                // Prepare canvas using PDF page dimensions
                                var canvas = $("#pdfViewer")[0];
                                var context = canvas.getContext('2d');
                                canvas.height = viewport.height;
                                canvas.width = viewport.width;

                                // Render PDF page into canvas context
                                var renderContext = {
                                    canvasContext: context,
                                    viewport: viewport
                                };
                                var renderTask = page.render(renderContext);
                                renderTask.promise.then(function() {
                                    console.log('Page rendered');
                                });
                            });
                        }, function(reason) {
                            // PDF loading error
                            console.error(reason);
                        });
                    };
                    fileReader.readAsArrayBuffer(file);
                }
            });

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
                        console.log(base64String)
                    };
                })(f);
                // Read in the image file as a data URL.
                reader.readAsBinaryString(f);
            }

            $(document).ready(function() {
                let id = "{{ $id_update }}"
                if (!empty(id)) {
                    getDataDetail(id)
                }
            });
        </script>
    </x-slot>

</x-admin.layout>
