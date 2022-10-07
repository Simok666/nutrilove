<x-user.layout title="Home">
    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Kategori Artikel</h2>
                <p>Lihat artikel bagus yang kami buat</p>
            </div>

            <div class="row">
                @foreach ($category as $item)
                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="400">
                        <a href="{{ Url("articles/category/". $item->kode) }}">
                            <div class="icon-box">
                                <div class="icon">
									<img src="{{ empty($item->file) ? 'user_assets/img/services/Ibu-Menyusui-01.png' : $item->file }}" class="img-fluid" alt="">
								</div>
                                <h4 class="title">{{ $item->nama }}</h4>
                                {{-- <p class="description">{{ $item->nama }}</p> --}}
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

        </div>
    </section><!-- End Services Section -->

    <!-- ======= Check Gizi Section ======= -->
    <section id="services" class="services section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Cek Status Gizi</h2>
                <p>Segera cek status gizi anda</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-3  align-items-stretch" data-aos="zoom-in" data-aos-delay="400">
                    <a href="{{ Url("cekgizi") }}">
                        <div class="icon-box">
                            <div class="icon">
                                <img src="{{asset('user_assets/img/gizi/dewasa.png')}}" class="img-fluid" alt="">
                            </div>
                            <h4 class="title">Cek Status Gizi</h4>
                            <p class="description">Ayo cek status gizi anda</p>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </section><!-- Check Gizi Section -->

    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>F.A.Q</h2>
                <p>Frequently Asked Questions</p>
            </div>

            <ul class="faq-list" data-aos="fade-up" data-aos-delay="100">
                @foreach ($faq as $value)
                    <li>
                        <div data-bs-toggle="collapse" class="collapsed question" href="#faq1">{{ $value->message }}
                            <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i>
                        </div>
                        <div id="faq1" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                {{ $value->answer }}
                            </p>
                        </div>
                    </li>
                @endforeach
            </ul>

        </div>
    </section><!-- End F.A.Q Section -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container">

            <div class="row justify-content-between">
                <div class="col-lg-5 d-flex align-items-center justify-content-center about-img">
                    <img src="user_assets/img/about-img.svg" class="img-fluid" alt="" data-aos="zoom-in">
                </div>
                <div class="col-lg-6 pt-5 pt-lg-0">
                    <h3 data-aos="fade-up">Tentang Kami</h3>
                    <p data-aos="fade-up" data-aos-delay="100">
                        Informasi Tentang Kami dan Team Kami
                    </p>
                    <div class="row">
                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                            <i class="bx bx-receipt"></i>
                            <h4>Tentang Kami</h4>
                            <p> NutriLove beridiri pada tahun 2022 dengan tujuan sebagai media edukasi bagi masyarakat
                                luas.</p>
                            <p> Platform kami berfokus pada informasi terkait stunting yang masih menjadi masalah gizi
                                utama di Indonesia.</p>
                            <p> Kami berharap informasi yang kami sediakan dapat membantu anda untuk hidup lebih sehat.
                            </p>
                            <p> Bersama kita cegah stunting. </p><p>Eat Well, Life Healty, Good Body. </p>

                        </div>
                        <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
                            <i class="bx bxs-user-detail"></i>
                            <h4>Tim Kami :</h4>
                            <p>1. Nike Noviana Putri</p>
                            <p>2. Larissa Dian &nbsp;&nbsp;&nbsp;&nbsp;Gayatri</p>
                            <p>3. Bunga Putri &nbsp;&nbsp;&nbsp;&nbsp;Arindra</p>
                            <p>4. Riza Amru &nbsp;&nbsp;&nbsp;&nbsp;Salzabila</p>
                            <p>5. Dhiah &nbsp;&nbsp;&nbsp;&nbsp;Widyaningtyas &nbsp;&nbsp;&nbsp;&nbsp;Budi</p>
                            <p>6. Sigita Ardelia Fista</p>
                            <p>7. Bayu Puspita</p>

                        </div>
                        <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
                            <i class="bx bx-user-plus"></i>
                            <h4>Thanks to :</h4>
                            <p>1. Bapak Bastinus &nbsp;&nbsp;&nbsp;&nbsp;Doddy, SKM., MM</p>
                            <p>2. Bapak Hasan &nbsp;&nbsp;&nbsp;&nbsp;Aroni, SKM., MPH</p>
                            <p>3. Bapak Sugeng &nbsp;&nbsp;&nbsp;&nbsp;Iwan Setyobudi, &nbsp;&nbsp;&nbsp;&nbsp;STP., M.Ke. </p>
                            <p>4. Bapak Ibnu Fajar, &nbsp;&nbsp;&nbsp;&nbsp;SKM., M.Kes., RD </p>
                            <p>5. Bapak Juin &nbsp;&nbsp;&nbsp;&nbsp;Hadisuyitno, SST., &nbsp;&nbsp;&nbsp;&nbsp;M.Kes </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End About Section -->

</x-user.layout>
