<x-user.layout title="Index">
    <!-- ======= check gizi detail Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Hasil Status Gizi</h2>
                <p>Status gizi yang kami cek berdasarkan informasi yang Anda berikan.<br>
            </div>
            <div class="row ">
                <div class="col-lg-12 d-flex align-items-center justify-content-center ">
                    <div class="col-md-7  pt-4 aos-init aos-animate" data-aos="fade-left" data-aos-delay="100">

                        <b> {{ $data->nama }} </b><br>
                        Laki-laki berusia <b> {{ $data->usia }} tahun </b><br>
                        Berat Badan <b> {{ $data->bb }} </b> kg
                        <br>Tinggi Badan <b> {{ $data->tb }} </b> cm <br>
                        Menurut Anda ukuran Tubuh Anda <b> {{ $gizi->keterangan }}</b><br>
                        <br>
                        Indeks Massa Tubuh (IMT) Anda<b> {{ number_format($gizi->nilai_data,2,",",".") }} </b> <br>
                        {{ $gizi->pesan }}


                    </div>

                    <div class="col-md-6 col-lg-3 align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                        <p><br><b>Gizi Kurang, Obesitas, Kekurangan Vitamin dan Mineral Sering Terjadi pada Orang Dewasa</b><br></p>
                        <img src="{{asset('user_assets/img/gizi/isipiringku1.png')}}" class="img-fluid"  style="max-width:100%; height:auto;" alt="">
                    </div>
                    
                </div>
                
            </div>
            
        </div>
    </section><!-- check gizi detail end -->
</x-user.layout>
