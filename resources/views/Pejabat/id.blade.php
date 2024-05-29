<!DOCTYPE html>
<html>
<head>
    <title>Edit PDF</title>
    <style>
        #pdf-container {
            position: relative;
            border: 1px solid black;
            overflow: auto;
            margin: 0 auto; /* Center the container */
        }
        #pdf-canvas {
            width: 100%;
            height: auto;
        }
        #draggable {
            width: 50px; /* Display size */
            height: 50px; /* Display size */
            position: absolute;
            cursor: move;
            z-index: 10; /* Ensure the draggable image is above the canvas */
        }
        #navigation-controls {
            margin: 10px 0;
            text-align: center; /* Center the navigation controls */
        }
    </style>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
</head>
<body>
    <form action="{{ route('savePDF') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="" id="posX" name="x">
        <input type="" id="posY" name="y">
        <input type="" id="pageNum" name="page">
        <input type="" id="documentId" name="id" value="{{ $id }}">
        <button type="submit">Save PDF</button>
    </form>

    <div id="navigation-controls">
        <button id="prev-page" type="button">Previous</button>
        <span>Page: <span id="page-num"></span> / <span id="page-count"></span></span>
        <button id="next-page" type="button">Next</button>
    </div>

    <div id="pdf-container">
        <canvas id="pdf-canvas"></canvas>
        <div id="draggable">
            <img src="{{ asset('files/qrcodes/' . $image) }}" id="draggable-image" width="80" height="80">
        </div>
    </div>

    <script>
        let pdfDoc = null,
            pageNum = 1,
            pageRendering = false,
            pageNumPending = null,
            scale = 1.3, // Adjust the scale as needed
            canvas = document.getElementById('pdf-canvas'),
            ctx = canvas.getContext('2d');

        function renderPage(num) {
            pageRendering = true;
            pdfDoc.getPage(num).then(function(page) {
                let viewport = page.getViewport({ scale: scale });
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                let renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };
                let renderTask = page.render(renderContext);

                renderTask.promise.then(function() {
                    pageRendering = false;
                    if (pageNumPending !== null) {
                        renderPage(pageNumPending);
                        pageNumPending = null;
                    }
                });

                // Set the container size based on the viewport
                document.getElementById('pdf-container').style.width = viewport.width + 'px';
                document.getElementById('pdf-container').style.height = viewport.height + 'px';
            });

            document.getElementById('page-num').textContent = num;
            document.getElementById('pageNum').value = num; // Set the hidden input value to the current page number
        }

        function queueRenderPage(num) {
            if (pageRendering) {
                pageNumPending = num;
            } else {
                renderPage(num);
            }
        }

        function onPrevPage() {
            if (pageNum <= 1) {
                return;
            }
            pageNum--;
            queueRenderPage(pageNum);
        }

        function onNextPage() {
            if (pageNum >= pdfDoc.numPages) {
                return;
            }
            pageNum++;
            queueRenderPage(pageNum);
        }

        document.getElementById('prev-page').addEventListener('click', onPrevPage);
        document.getElementById('next-page').addEventListener('click', onNextPage);

        // Load the PDF
        const url = '{{ url('files/Tanda-Tangan/' . $file) }}';
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.worker.min.js';

        pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
            pdfDoc = pdfDoc_;
            document.getElementById('page-count').textContent = pdfDoc.numPages;
            renderPage(pageNum);
        });

       $(function() {
    $("#draggable").draggable({
        containment: "#pdf-container",
        stop: function(event, ui) {
            let canvasRect = canvas.getBoundingClientRect();
            let pdfCanvas = document.getElementById('pdf-canvas');
            let scaleX = pdfCanvas.width / canvasRect.width;
            let scaleY = pdfCanvas.height / canvasRect.height;
            let dpi = window.devicePixelRatio * 96; // Mendapatkan DPI dari layar
            
            // Menghitung ukuran gambar dalam milimeter
            let widthPx = $("#draggable-image").width();
            let heightPx = $("#draggable-image").height();
            let widthMm = ((widthPx / dpi) * 25.4).toFixed(5); // Lima digit di belakang koma
            let heightMm = ((heightPx / dpi) * 25.4).toFixed(5); // Lima digit di belakang koma
            
            console.log("Ukuran gambar (lebar x tinggi): " + widthMm + " mm x " + heightMm + " mm");

            // Menghitung posisi relatif gambar terhadap kanvas PDF dalam mm
            let posXpx = ui.position.left;
            let posYpx = ui.position.top;
            let posXmm = ((posXpx / canvasRect.width) * pdfCanvas.width / dpi * 33).toFixed(5); // Lima digit di belakang koma
            let posYmm = ((posYpx / canvasRect.height) * pdfCanvas.height / dpi * 33).toFixed(5); // Lima digit di belakang koma

            console.log("Posisi X dalam milimeter: " + posXmm + " mm");
            console.log("Posisi Y dalam milimeter: " + posYmm + " mm");

            // Menetapkan nilai posisi X dan Y ke input form
            $('#posX').val(posXmm);
            $('#posY').val(posYmm);
        }
    });
});



    </script>
</body>
</html>
