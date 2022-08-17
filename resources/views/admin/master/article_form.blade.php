<x-admin.layout title="Content">
    <x-slot name="styles">
        <style>
            .btn-right {
                float: right;
            }
        </style>
        <link rel="stylesheet" href="{{ asset('admin_assets/plugins/select/select2.min.css') }}">
        <script src="https://cdn.ckeditor.com/4.19.1/standard-all/ckeditor.js"></script>
    </x-slot>

    <x-slot name="buttons">

        <button class="btn btn-danger btn-sm  pl-10 pr-10" onclick="history.back()">
            <i data-feather="arrow-left"></i> Kembali
        </button>
        <button class="btn btn-primary btn-sm  btn-tambah" form="form" type="submit">
            <i data-feather="save"></i> Simpan Article
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
                                        <input type="text" class="form-control validasi" 
                                            name="title" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Category</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2 id_category" multiple required>
                                            <option value="">Choose Category</option>
                                        </select>
                                        <input type="hidden" name="id_category">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Keterangan</label>
                                    <div class="col-sm-9">

                                        <textarea required placeholder="Keterangan" name="desc_content" cols="80" id="editor1" rows="10">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Tumbnail</label>
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <input type="file" class="form-control fileFormBase64">
                                            <input type="hidden" class="base_64" name="fileBase64">
                                            <div class="avatar avatar-xl me-3">
                                                <img class="preview-profile base64-preview"
                                                    src="{{ asset('person-icon.png') }}" alt="" srcset="">
                                            </div>
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
        <script src="{{ url("/admin_assets/plugins/select/select2.full.min.js") }}"></script>
        <script>
            CKEDITOR.replace('editor1', {
                fullPage: true,
                extraPlugins: 'docprops',
                // Disable content filtering because if you use full page mode, you probably
                // want to  freely enter any HTML content in source mode without any limitations.
                allowedContent: true,
                height: 320,
                removeButtons: 'PasteFromWord'
            });

            var FrmEditAdmin = $("#form").validate({
                submitHandler: function(form) {
                    setTimeout(() => {
                        submitData(form, "/admin/article/upsert", function(resp) {
                            if (empty(resp.IsError)) location.href = "{{ url('admin/article') }}"
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
                ajaxData("/detail/articles", {
                    "id": id
                }, function(resp) {
                    if (!empty(resp.Data)) {
                        showLoading(".card-body", false)
                        $.each(resp.Data[0], function(index, value) {
                            if (index !== "desc_content") $("#form").find("[name=" + index + "]").val(value).trigger("change")
                        });

                        CKEDITOR.instances['editor1'].setData(resp.Data[0].desc_content);

                        if (!empty(resp.Data[0].file)) {
                            $("#form").find(".base64-preview").attr("src", resp.Data[0]
                                .file);
                        }
                        hiddenComponent(".card-body", false)
                        getSelectCategoryArticle(resp.Data[0].id_category)
                    } else {
                        toastrshow("warning", "Data yang anda cari tidak ditemukan", "Failed")
                        setTimeout(() => {
                            location.href = "{{ url("admin/article") }}"
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
                if (tipefile != "image/png" && tipefile != "image/jpeg" && tipefile != "image/bmp") {
                    $(this).val("");
                    toastrshow("warning", "Format salah, pilih file dengan format jpg/png/bmp", "Warning");
                    return;
                }
                // if((this.files[0].size / 1024) > 2048){
                //     $(this).val("");
                //     toastrshow("warning", "Maximum file size is 2 MB", "Warning");
                //     return;
                // }

                let FR = new FileReader();
                FR.addEventListener("load", function(readerEvent) {
                    let image = new Image();
                    image.onload = function(imageEvent) {
                        let canvas = document.createElement("canvas"),
                            max_size = 300, // TODO : pull max size from a site config
                            width = image.width,
                            height = image.height;

                        if (width > height) {
                            if (width > max_size) {
                                height *= max_size / width;
                                width = max_size;
                            }
                        } else {
                            if (height > max_size) {
                                width *= max_size / height;
                                height = max_size;
                            }
                        }
                        canvas.width = width;
                        canvas.height = height;
                        canvas.getContext("2d").drawImage(image, 0, 0, width, height);

                        let base64 = canvas.toDataURL("image/jpeg");
                        image_base64 = base64;
                        // base64 = base64.replace(/^data:image\/(png|jpg|jpeg|bmp);base64,/, '');
                        parent.find(".base_64").val(base64);
                        parent.find(".fileChange").val(1);
                        parent.find(".base64-preview").prop("src", image_base64);
                    };
                    image.src = readerEvent.target.result;
                });
                FR.readAsDataURL(this.files[0]);
            });

            $(document).ready(function () {
                let id = "{{ $id_update }}"
                $(".select2").select2();
                if (!empty(id)) {
                    getDataDetail(id)
                } else {
                    getSelectCategoryArticle(0)
                }
            });

            const getSelectCategoryArticle = (selected) => {
                ajaxData("{{ url("/admin/article/kategori") }}" , {
                    is_select : true
                }, function (resp) {
                    if (empty(resp.IsError)) {
                        $(".id_category").html(resp.data)                        
                    }
                    if (!empty(selected)) {
                        selected = selected.split(",")
                        $(".id_category").val( selected).trigger("change")
                    }
                })
            } 

            $(".id_category").change(function () { 
                $("[name=id_category]").val($(this).val())
            })
        </script>
    </x-slot>

</x-admin.layout>
