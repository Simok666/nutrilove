  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
      <div class="container d-flex align-items-center justify-content-between">

          <div class="logo">
              {{-- <h1 class="text-light"><a href="index.html"><span>Ninestars</span></a></h1> --}}
              <!-- Uncomment below if you prefer to use an image logo -->
              <a href="/"><img src="https://nutrilove.id/img.png" alt="" class="img-fluid"></a>
          </div>

          <nav id="navbar" class="navbar">
              <ul>
                  <li><a class="nav-link scrollto active" href={{ Url("/") }}>Home</a></li>
                  <li><a class="nav-link scrollto" href="{{ Url("about") }}">Tentang Kami</a></li>
                  <li><a class="nav-link scrollto" href="{{ Url("cekgizi") }}">Cek Status Gizi</a></li>
                  <li><a class="nav-link scrollto" href="{{ Url("leaflet") }}">Leaflet</a></li>
                  <li class="dropdown"><a href="#"><span>Artikel</span> <i class="bi bi-chevron-down"></i></a>
                      <ul>
                            @foreach ($category as $item)
                                <li><a href="{{ Url("articles/category/". $item->kode) }}">{{ $item->nama }}</a></li>
                            @endforeach
                      </ul>
                  </li>
                  <li><a class="nav-link scrollto" href="{{ Url("contact") }}">Hubungi Kami</a></li>
                  @if (empty(Auth::user()->id))
                    <li><a class="nav-link scrollto" href="{{ Url("login") }}">Login</a></li>

                  @else
                    <li><a class="nav-link scrollto" href="{{ Url("logout") }}">Logout</a></li>
                  @endif
              </ul>
              <i class="bi bi-list mobile-nav-toggle"></i>
          </nav><!-- .navbar -->

      </div>
  </header><!-- End Header -->
