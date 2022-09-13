<x-user.layout title="Index">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Cek Status Gizi</h2>
                <p>Status gizi yang kami cek berdasarkan ukuran tubuh Anda, sesuai informasi yang Anda berikan.<br>
                    Oleh karena itu masukkanlah informasi yang benar.</p>
            </div>
            <div class="row justify-content-center">
                {{-- <div class="col-lg-12 d-flex align-items-center justify-content-center "> --}}
                    <div class="col-md-6 col-lg-3  align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                        <img src="{{asset('user_assets/img/gizi/dewasa.png')}}"  style="max-width:100%; height:auto;" class="img-fluid" alt="">
                    </div>
                    <div class="col-md-6 col-lg-3 d-flex align-items-center" data-aos="zoom-in" data-aos-delay="100">
                        <form method="post" id="cekGizi">
                            <div class="form-group">
                                <label><b>Nama Lengkap</b></label>
                                <input type="text" name="nama" class="form-control" id="inputAddress"
                                    placeholder="Masukkan Nama Lengkap Anda" required="">
                            </div>
                            <div class="form-group">
                                <label><b>Jenis Kelamin</b></label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jk" id="inlineRadio1"
                                        value="Laki-laki" required="">
                                    <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jk" id="inlineRadio2"
                                        value="Perempuan (Tidak Hamil)" required="">
                                    <label class="form-check-label" for="inlineRadio2">Perempuan (Tidak Hamil)</label>
                                </div>
                                <input type="hidden" name="jenis_kelamin">
                            </div>
                            <div class="form-row">
                                <div class="form-group ">
                                    <label><b>Usia</b></label>
                                    <input type="number" name="usia" min="0" step="0.1" max="200" class="form-control"
                                        placeholder="Tahun" required="">
                                </div>
                                <div class="form-group ">
                                    <label><b>Berat Badan (BB)</b></label>
                                    <input type="number" name="bb" min="1" step="0.1" class="form-control" placeholder="kg (1 desimal)"
                                        required="">
                                </div>
                                <div class="form-group">
                                    <label><b>Tinggi Badan (TB)</b></label>
                                    <input type="number" name="tb" min="1" step="0.1" class="form-control" placeholder="cm (1 desimal)"
                                        required="">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group ">
                                    <label><b>E-mail</b></label>
                                    <input type="email" name="email" class="form-control"
                                        placeholder="Masukkan E-mail Anda" required="">
                                </div>
                            </div>
                            <div class="col-md-2">
                            </div>
                            <div class="col text-center pt-10">
                                <button type="submit" class="btn btn-outline-info text-center gizi-button"><b style="color:#f0e9ff;">CEK STATUS GIZI
                                </b></button>
                            </div>
                        </form>
                    </div>
                {{-- </div> --}}
            </div>
        </div>
    </section><!-- End About Section -->
</x-user.layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    var FrmEditAdmin = $("#cekGizi").validate({
        submitHandler: function(form) {
            setTimeout(() => {
                let jenis_kelamin = $("input[name='jk']:checked").val();
                $("input[name='jenis_kelamin']").val(jenis_kelamin);
                submitData(form, "/cekgizi", function(resp) {
                    if (resp.IsError === false) {
                        location.href= base_url + "/cekgizi/" + resp.Data.idEncript
                    }
                }, function (resp) {  
                    if (resp.Type == "Login") {
                        $("LoginModal").modal("show");
                    }
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
</script>
