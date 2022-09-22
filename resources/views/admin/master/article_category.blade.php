<div class="modal fade text-left" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="addCategory"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Category</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="formAddCategory">
                    <label>Kode</label>
                    <div class="form-group">
                        <input type="text" name="kode" placeholder="Kode" class="form-control" required>
                    </div>
                    <label>Nama</label>
                    <div class="form-group">
                        <input type="text" name="nama" required placeholder="Nama Kategory" class="form-control">
                    </div>
                    <label>Tampilkan Di Navbar User</label>
                    <div class="form-group">
                        <select name="is_show_navbar" class="form-control select2">
                            <option value="0" selected>Tidak</option>
                            <option value="1">Ya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description"rows="3"></textarea>
                    </div>
                    <label>Photo: </label>
                    <div class="form-group">
                        <input type="file" class="form-control fileFormBase64">
                        <input type="hidden" class="base_64" name="fileBase64">
                        <input type="hidden" class="fileChange" name="isChange" value="0">
                        <div class="avatar avatar-xl me-3">
                            <img class="preview-profile base64-preview" src="{{ asset('person-icon.png') }}"
                                alt="" srcset="">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <button type="submit" class="btn btn-primary ml-1" form="formAddCategory">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Save</span>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade text-left" id="ModalEditCategory" tabindex="-1" role="dialog"
    aria-labelledby="ModalEditCategory"aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Category Edit </h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <center class="loading">
                    <img width="100px" src="{{ asset('loading-data.gif') }}">
                </center>
                <form method="POST" id="formEditCategory">
                    <label>Kode</label>
                    <div class="form-group">
                        <input type="text" name="kode" placeholder="Kode" class="form-control" required>
                        <input type="hidden" name="id">
                    </div>
                    <label>Nama</label>
                    <div class="form-group">
                        <input type="text" name="nama" required placeholder="Nama Kategory" class="form-control">
                    </div>
                    <label>Tampilkan Di Navbar User</label>
                    <div class="form-group">
                        <select name="is_show_navbar" class="form-control select2">
                            <option value="0">Tidak</option>
                            <option value="1">Ya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description"rows="3"></textarea>
                    </div>
                    <label>Photo: </label>
                    <div class="form-group">
                        <input type="file" class="form-control fileFormBase64">
                        <input type="hidden" class="base_64" name="fileBase64">
                        <input type="hidden" class="fileChange" name="isChange" value="0">
                        <div class="avatar avatar-xl me-3">
                            <img class="preview-profile base64-preview" src="{{ asset('person-icon.png') }}"
                                alt="" srcset="">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <button type="submit" class="btn btn-primary ml-1" form="formEditCategory">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Save</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var FrmAddAdmin = $("#formAddCategory").validate({
            submitHandler: function(form) {
                submitData(form, "/admin/article/kategori/upsert", function(resp) {
                    if (empty(resp.IsError)) ReloadDataTable("#tableCategory")
                })
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

        var FrmEditAdmin = $("#formEditCategory").validate({
            submitHandler: function(form) {
                submitData(form, "/admin/article/kategori/upsert", function(resp) {
                    if (empty(resp.IsError)) ReloadDataTable("#tableCategory")
                })
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

        $("#tableCategory tbody").on("click", ".btn-delete", function() {
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
                    ajaxData("/delete/article_category", {
                        "id": data.id
                    }, function(resp) {
                        toastrshow("success", "Data berhasil dihapus", "Success");
                        ReloadDataTable("#tableCategory")
                    })
                }
            })
        })

        $("#tableCategory tbody").on("click", ".btn-update", function() {
            let data = $(this).data();
            $("#ModalEditCategory").modal("show")
            showLoading("#ModalEditCategory", true)
            hiddenComponent("#formEditCategory", true)
            ajaxData("/detail/article_category", {
                "id": data.id
            }, function(resp) {
                if (!empty(resp.Data)) {
                    showLoading("#ModalEditCategory", false)
                    $.each(resp.Data[0], function(index, value) {
                        $("#formEditCategory").find("[name=" + index + "]").val(value)
                    });

                    if (!empty(resp.Data[0].file)) {
                        $("#formEditCategory").find(".base64-preview").attr("src", resp.Data[0].file);
                    }

                    hiddenComponent("#formEditCategory", false)
                } else {
                    hideModal("#ModalEditCategory")
                    toastrshow("warning", "Data yang anda cari tidak ditemukan", "Failed")
                }
            })
        })
    });

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

    $(".modal").on('hide.bs.modal', function(event) {
        $(this).find('input').val("");
        $(this).find('select').val("").trigger('change');
        $(this).find('textarea').val("").trigger('change');
        $(this).find('.loading').removeClass('hidden');
        $(this).find('.base64-preview').attr("src", "{{ asset('person-icon.png') }}")
    });
</script>
