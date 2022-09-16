<x-user.layout title="Index">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row justify-content-between">
          <div class="col-lg-5 d-flex align-items-center justify-content-center about-img">
            <img src="user_assets/img/about-img.svg" class="img-fluid" alt="" data-aos="zoom-in">
          </div>
          <div class="col-lg-6 pt-5 pt-lg-0">
            <h3 data-aos="fade-up">About us</h3>
            <p data-aos="fade-up" data-aos-delay="100">
              Informasi Tentang Kami dan Team Kami
            </p>
            <div class="row">
              <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                <i class="bx bx-receipt"></i>
                <h4>Tentang Kami</h4>
                <p> NutriLove beridiri pada tahun 2022 dengan tujuan sebagai media edukasi bagi masyarakat luas.</p>
                <p> platform Kami berfokus pada informasi terkait stunting yang masih menjadi masalah gizi utama di Indonesia.</p>
                <p> Kami berharap informasi yang kami sediakan dapat membantu anda untuk hidup lebih sehat. </p>
                <p> Bersama kita cegah stunting. Eat Well, Life Healty, Good Body. </p>
                
              </div>
              <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <i class="bx bx-user-plus"></i>
                <h4>Tim Kami</h4>
                <p>1. Nike Noviana Putri</p>
                <p>2. Larissa Dian Gayatri</p>
                <p>3. Bunga Putri Arindra</p>
                <p>4. Riza Amru Salzabila</p>
                <p>5. Dhiah Widyaningtyas Budi</p>
                <p>6. Sigita Ardelia Fista</p>
                <p>7. Bayu Puspita</p>
                <p>Thanks to:</p>
                <p>1. Bapak Bastinus Doddy, SKM., MM</p>
                <p>2. Bapak Hasan Aroni, SKM., MPH</p>
                <p>3. Bapak Sugeng Iwan Setyobudi, STP., M.Ke. </p>
                <p>4. Bapak Ibnu Fajar, SKM., M.Kes., RD </p>
                <p>5. Bapak Juin Hadisuyitno, SST., M.Kes </p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Services</h2>
          <p>Check out the great services we offer</p>
        </div>

        <div class="row">
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><img src="user_assets/img/services/Remaja-01-01.png" class="img-fluid" alt=""></div>
              <h4 class="title"><a href="">Lorem Ipsum</a></h4>
              <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><img src="user_assets/img/services/Ibu-Hamil-01.png" class="img-fluid" alt=""></div>
              <h4 class="title"><a href="">Sed ut perspiciatis</a></h4>
              <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><img src="user_assets/img/services/Ibu-Menyusui-01.png" class="img-fluid" alt=""></div>
              <h4 class="title"><a href="">Magni Dolores</a></h4>
              <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="400">
            <div class="icon-box">
              <div class="icon"><img src="user_assets/img/services/Baby-1-01.png" class="img-fluid" alt=""></div>
              <h4 class="title"><a href="">Nemo Enim</a></h4>
              <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Instagram</h2>
          <p>Check out our beautifull instagram</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-12">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">All</li>
              <li data-filter=".filter-app">App</li>
              <li data-filter=".filter-card">Card</li>
              <li data-filter=".filter-web">Web</li>
            </ul>
          </div>
        </div>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
        
          @foreach($content as $value)
      
          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="{{$value->file}}" class="img-fluid" alt="">
              <div class="portfolio-links">
                <a href="{{$value->file}}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="App 1"><i class="bi bi-plus"></i></a>
                <a href="portfolio-details.html" title="More Details"><i class="bi bi-link"></i></a>
              </div>
              <div class="portfolio-info">
                <h4>{{$value->title}}</h4>
                <p>App</p>
              </div>
            </div>
          </div>
          @endforeach

        </div>

      </div>
    </section><!-- End Portfolio Section -->

    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Clients</h2>
          <p>They trusted us</p>
        </div>

        <div class="clients-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><img src="user_assets/img/clients/client-1.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="user_assets/img/clients/client-2.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="user_assets/img/clients/client-3.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="user_assets/img/clients/client-4.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="user_assets/img/clients/client-5.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="user_assets/img/clients/client-6.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="user_assets/img/clients/client-7.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="user_assets/img/clients/client-8.png" class="img-fluid" alt=""></div>
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Clients Section -->
</x-user.layout>
