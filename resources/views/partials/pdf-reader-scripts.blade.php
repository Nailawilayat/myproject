<script>
pdfjsLib.GlobalWorkerOptions.workerSrc =
    'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js';

function initPdfReader(pdfUrl) {
    const slider = document.getElementById('pdf-slider');

    pdfjsLib.getDocument(pdfUrl).promise.then(function (pdf) {
        for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
            renderPage(pdf, pageNum, slider);
        }
    });
}

function renderPage(pdf, pageNum, slider) {
    pdf.getPage(pageNum).then(function (page) {
        const viewport = page.getViewport({ scale: 1 });

        const containerWidth = document.querySelector('.pdf-carousel').clientWidth - 80;
        const scale = containerWidth / viewport.width;
        const scaledViewport = page.getViewport({ scale });

        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');

        canvas.width = scaledViewport.width;
        canvas.height = scaledViewport.height;
        canvas.style.display = 'block';
        canvas.style.margin = '0 auto';

        page.render({
            canvasContext: context,
            viewport: scaledViewport,
        });

        const item = document.createElement('div');
        item.classList.add('carousel-item');
        if (pageNum === 1) {
            item.classList.add('active');
        }

        const pageWrapper = document.createElement('div');
        pageWrapper.classList.add('pdf-page');
        pageWrapper.appendChild(canvas);

        item.appendChild(pageWrapper);
        slider.appendChild(item);
    });
}
</script>