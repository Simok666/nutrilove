<x-user.layout title="Leaflet">
    <!-- ======= F.A.Q Section ======= -->
    <section id="services" class="services section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Leaflet</h2>
            </div>

            <div class="row">
                @foreach ($leaflet ?? [] as $index => $item)
                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch card-leaflet" data-canvas="canvas{{ $index }}" data-url="{{ $item->file }}" data-aos="zoom-in" data-aos-delay="100">
                        <div class="icon-box">
                            <div class="icon">
								<canvas id="canvas{{ $index }}" class="preview-pdf base64-preview img-fluid"></canvas>
							</div>
                            <h4 class="title"><a href="{{ Url("leaflet/detail?kode=".$item->kode) }}">{{ $item->title }}</a></h4>
                            <p class="description"></p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <x-slot name="script">
		<script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
        <script>
			// var pdfjsLib = window['pdfjs-dist/build/pdf'];
            // // // The workerSrc property shall be specified.
            // pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://mozilla.github.io/pdf.js/build/pdf.worker.js';
			$(document).ready(function () {
				$(".card-leaflet").each(function (index, element) {
					// element == this
					showPdfPreview(element, $(element).data("url"))
				});
			});

            

            const showPdfPreview = (selector, url) => {
                const loadingTask = pdfjsLib.getDocument(url);

                (async () => {
                    const pdf = await loadingTask.promise;
                    //
                    // Fetch the first page
                    //
                    const page = await pdf.getPage(1);
                    const scale = 1.5;
                    const viewport = page.getViewport({
                        scale
                    });

					const outputScale = window.devicePixelRatio || 1;

                    const canvas = document.getElementById($(selector).data("canvas"));
                    const context = canvas.getContext("2d");

                    canvas.width = Math.floor(viewport.width * outputScale);
                    canvas.height = Math.floor(viewport.height * outputScale);

                    const transform = outputScale !== 1 ? [outputScale, 0, 0, outputScale, 0, 0] :
                        null;

                    const renderContext = {
                        canvasContext: context,
                        transform,
                        viewport,
                    };
                    page.render(renderContext);
                })();
            }
        </script>
    </x-slot>
</x-user.layout>
