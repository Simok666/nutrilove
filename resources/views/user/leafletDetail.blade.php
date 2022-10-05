<x-user.layout title="Leaflet">
    <x-slot name="styles">
        <style>
            /* canvas {
                width: 500px;
                height: 500px;
                border: 3px solid black;
                border-radius: 10px;
            } */

            button {
                outline: 0;
                border: none;
                border-radius: 3px;
                color: white;
                background: black;
                /* width: 100px;
                height: 40px; */
                transition: all .1s ease-in-out;
            }

            button:hover {
                background: none;
                border: 3px solid black;
                color: black;
            }
        </style>
    </x-slot>
    <!-- ======= F.A.Q Section ======= -->
    <div class="row">
    <section id="services" class="services section-bg">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Leaflet</h2>
            </div>
            <div class="row">
                <iframe src="https://flowpaper.com/flipbook/{{ $leaflet->file }}" width="70%" height="800" style="border: none;" allowFullScreen>
                </iframe>
            </div>
            
        </div>
    </section>
    <div class="container" data-aos="fade-up">
        <div class="col-lg-12 d-flex align-items-center justify-content-center">
            <button type="button" class="btn btn-labeled btn-info">
                Kembali ke Home</button>
        </div>
    </div>
    </div>
    
</x-user.layout>