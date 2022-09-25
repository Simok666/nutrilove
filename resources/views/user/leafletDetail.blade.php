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
                width: 100px;
                height: 40px;
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
    <section id="services" class="services section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Leaflet</h2>
            </div>

            <div class="row">

                <div id="loader">Loading ......</div>
                <canvas id="pdf_canvas"></canvas>
                <div class="container">
                    <button id="prev_page">Previos Page</button>
                    <button id="next_page">next Page</button>
                    <span id="current_page_num"></span>
                    of
                    <span id="total_page_num"></span>
            
                    <input type="text" id="page_num">
                    <button id="go_to_page">Go To Page</button>
                </div>
            </div>
        </div>
    </section>
    <x-slot name="script">

        <!-- Replace pdf.js with downloaded pdf.js file -->
        <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
        <script>
            // intial params
            let pdf;
            let canvas;
            let isPageRendering;
            let pageRenderingQueue = null;
            let canvasContext;
            let totalPages;
            let currentPageNum = 1;

            // events
            window.addEventListener('load', function() {
                isPageRendering = false;
                pageRenderingQueue = null;
                canvas = document.getElementById('pdf_canvas');
                canvasContext = canvas.getContext('2d');

                initEvents();
                initPDFRenderer();
            });

            function initEvents() {
                let prevPageBtn = document.getElementById('prev_page');
                let nextPageBtn = document.getElementById('next_page');
                let goToPage = document.getElementById('go_to_page');
                prevPageBtn.addEventListener('click', renderPreviousPage);
                nextPageBtn.addEventListener('click', renderNextPage);
                goToPage.addEventListener('click', goToPageNum);
            }

            // init when window is loaded
            function initPDFRenderer() {

                var url = '{{ $leaflet->file }}';

                // const url = 'test1.pdf'; // replace with your pdf location

                let option = {
                    url
                };


                pdfjsLib.getDocument(option).promise.then(pdfData => {
                    totalPages = pdfData.numPages;
                    let pagesCounter = document.getElementById('total_page_num');
                    pagesCounter.textContent = totalPages;
                    // assigning read pdfContent to global variable
                    pdf = pdfData;
                    renderPage(currentPageNum);
                });
            }

            function renderPage(pageNumToRender = 1, scale = 1) {
                isPageRendering = true;
                document.getElementById('current_page_num').textContent = pageNumToRender;
                pdf.getPage(pageNumToRender).then(page => {
                    document.getElementById("loader").style.display = "none";
                    const viewport = page.getViewport({
                        scale: 1
                    });
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;
                    
                    let renderCtx = {
                        canvasContext,
                        viewport
                    };
                    page.render(renderCtx).promise.then(() => {
                        isPageRendering = false;
                        if (pageRenderingQueue !==
                            null) { // this is to check of there is next page to be rendered in the queue
                            renderPage(pageNumToRender);
                            pageRenderingQueue = null;
                        }
                    });
                });
            }

            function renderPageQueue(pageNum) {
                if (pageRenderingQueue != null) {
                    pageRenderingQueue = pageNum;
                } else {
                    renderPage(pageNum);
                }
            }

            function renderNextPage(ev) {
                if (currentPageNum >= totalPages) {
                    alert("This is the last page");
                    return;
                }
                currentPageNum++;
                renderPageQueue(currentPageNum);
            }

            function renderPreviousPage(ev) {
                if (currentPageNum <= 1) {
                    alert("This is the first page");
                    return;
                }
                currentPageNum--;
                renderPageQueue(currentPageNum);
            }

            function goToPageNum(ev) {
                let numberInput = document.getElementById('page_num');
                let pageNumber = parseInt(numberInput.value);
                if (pageNumber) {
                    if (pageNumber <= totalPages && pageNumber >= 1) {
                        currentPageNum = pageNumber;
                        numberInput.value = "";
                        renderPageQueue(pageNumber);
                        return;
                    }
                }
                alert("Enter a valide page numer");
            }
        </script>
    </x-slot>
</x-user.layout>