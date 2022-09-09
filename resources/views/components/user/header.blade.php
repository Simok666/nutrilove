  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
      <div class="container d-flex align-items-center justify-content-between">

          <div class="logo">
              {{-- <h1 class="text-light"><a href="index.html"><span>Ninestars</span></a></h1> --}}
              <!-- Uncomment below if you prefer to use an image logo -->
              <a href="index.html"><img src="https://nutrilove.id/wp-content/uploads/2022/04/Logo3.png" alt="" class="img-fluid"></a>
          </div>

          <nav id="navbar" class="navbar">
              <ul>
                  <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                  <li><a class="nav-link scrollto" href="{{ Url("aboutus") }}">About Us</a></li>
                  <li><a class="nav-link scrollto" href="{{ Url("cekgizi") }}">Cek Status Gizi</a></li>
                  {{-- <li><a class="nav-link scrollto" href="{{ Url("articles") }}">Articles</a></li> --}}
                  <li class="dropdown"><a href="#"><span>Article</span> <i class="bi bi-chevron-down"></i></a>
                      <ul>
                            @foreach ($category as $item)
                                <li><a href="{{ Url("articles/category/". $item->kode) }}">{{ $item->nama }}</a></li>
                            @endforeach
                      </ul>
                  </li>
                  <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
              </ul>
              <i class="bi bi-list mobile-nav-toggle"></i>
          </nav><!-- .navbar -->

      </div>
  </header><!-- End Header -->
