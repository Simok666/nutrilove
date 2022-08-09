<div class="modal fade text-left" id="settingGizi" tabindex="-1" role="dialog"
    aria-labelledby="settingGizi" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Setting Gizi</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{! setting.gizi.upsert !}" method="POST" id="formAdd">
                    <label>Nilai Rumus: </label>
                    <div class="form-group">
                        <input type="number" step="0.01"  name="nilai_rumus" placeholder="Nilai Rumus" class="form-control" required>
                    </div>
                    <label>Keterangan: </label>
                    <div class="form-group">
                        <input type="text" name="keterangan" required placeholder="Keterangan" class="form-control">
                    </div>
                    <label>Pesan: </label>
                    <div class="form-group">
                        <input type="text" name="pesan" placeholder="Pesan" class="form-control" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <button type="submit" class="btn btn-primary ml-1" form="formAdd">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Save</span>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade text-left" id="ModalEdit" tabindex="-1" role="dialog"
    aria-labelledby="ModalEdit"aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Seting Gizi Edit </h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <center class="loading">
                    <img width="100px" src="{{ asset("loading-data.gif") }}">
                </center>
                <form action="{! setting.gizi.upsert !}" method="POST" id="formEdit">
                    <label>Nilai Rumus: </label>
                    <div class="form-group">
                        <input type="number" step="0.01"  name="nilai_rumus" placeholder="Nilai Rumus" class="form-control" required>
                        <input type="hidden" name="id">
                    </div>
                    <label>Keterangan: </label>
                    <div class="form-group">
                        <input type="text" name="keterangan" required placeholder="Keterangan" class="form-control">
                    </div>
                    <label>Pesan: </label>
                    <div class="form-group">
                        <input type="text" name="pesan" placeholder="Pesan" class="form-control" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <button type="submit" class="btn btn-primary ml-1" form="formEdit">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Save</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var FrmAddAdmin = $("#formAdd").validate({
            submitHandler: function(form) {
                submitData(form, "/admin/setting/gizi/upsert", function (resp) {
                    if (empty(resp.IsError)) ReloadDataTable("#SettingGiziTable")
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

        var FrmEditAdmin = $("#formEdit").validate({
            submitHandler: function(form) {
                submitData(form, "/admin/setting/gizi/upsert", function (resp) {
                    if (empty(resp.IsError)) ReloadDataTable("#SettingGiziTable")
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

        $("#SettingGiziTable tbody").on("click", ".btn-delete", function() {
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
                    ajaxData("/delete/setting_gizi", {
                        "id": data.id
                    }, function(resp) {
                        toastrshow("success", "Data berhasil dihapus", "Success");
                        ReloadDataTable("#SettingGiziTable")
                    })
                }
            })
        })

        $("#SettingGiziTable tbody").on("click", ".btn-update", function() {
            let data = $(this).data();
            $("#ModalEdit").modal("show")
            showLoading("#ModalEdit", true)
            hiddenComponent("#formEdit", true)
            ajaxData("/detail/setting_gizi", {
                "id": data.id
            }, function (resp) {
                if (!empty(resp.Data)) {
                    showLoading("#ModalEdit", false)
                    $.each(resp.Data[0], function (index, value) { 
                         $("#formEdit").find("[name="+ index +"]").val(value)
                    });

                    hiddenComponent("#formEdit", false)
                } else {
                    hideModal("#ModalEdit")
                    toastrshow("warning", "Data yang anda cari tidak ditemukan", "Failed")
                }
            })
        })
    });

    $(".modal").on('hide.bs.modal', function (event) {
        $(this).find('input').val("");
        $(this).find('select').val("").trigger('change');
        $(this).find('textarea').val("").trigger('change');
        $(this).find('.loading').removeClass('hidden');
        $(this).find('.base64-preview').attr("src" , "{{ asset('person-icon.png') }}")
    });
</script>
