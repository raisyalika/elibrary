<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Viewer - E-Library SDN Jelambar Baru 07</title>
    <link href="<?= base_url('css/style.css') ?>" rel="stylesheet"></head>
    <!-- PDF.js CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>
</head>
<body class="flex flex-col min-h-screen">
    <!-- Header - Fixed at top -->
    <header class="bg-orange-500 text-white sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <img src="assets/img/logo.png" alt="Logo" class="w-10 h-10">
                <h1 class="text-xl font-bold">E-Library SDN Jelambar Baru 07</h1>
            </div>
            <div class="space-x-4">
                <a href="#" class="hover:underline">Profil</a>
                <a href="login" class="hover:underline">Keluar</a>
            </div>
        </div>
    </header>

    <!-- Back Button -->
    <div class="bg-orange-50 p-4">
        <div class="container mx-auto">
            <a href="dashboard_user" class="inline-flex items-center text-orange-600 hover:text-orange-800">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <!-- PDF Viewer Container -->
    <main class="flex-grow bg-gray-100">
        <div class="container mx-auto px-4 py-4">
            <!-- PDF Controls -->
            <div class="bg-white rounded-lg shadow-md p-4 mb-4 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-600">
                        Halaman <span id="currentPage">1</span> dari <span id="totalPages">1</span>
                    </span>
                </div>
                <div class="flex items-center space-x-2">
                    <button id="zoomOut" class="p-2 rounded-lg hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                        </svg>
                    </button>
                    <span id="zoomLevel" class="text-sm text-gray-600">100%</span>
                    <button id="zoomIn" class="p-2 rounded-lg hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </button>
                    <button id="download" class="p-2 rounded-lg hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                    </button>
                    <button id="print" class="p-2 rounded-lg hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- PDF Viewer -->
            <div class="bg-white rounded-lg shadow-md p-4 min-h-[800px] flex justify-center">
                <canvas id="pdfViewer" class="max-w-full"></canvas>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-orange-100 mt-auto py-4">
        <div class="container mx-auto text-center">
            <h2 class="font-bold mb-2">E-Library SDN Jelambar Baru 07</h2>
            <p class="text-sm text-gray-600">© Copyright 2025 SDN Jelambar Baru 07</p>
        </div>
    </footer>

    <script>
        // Initialize PDF.js
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.worker.min.js';

        let pdfDoc = null;
        let pageNum = 1;
        let scale = 1.0;
        const canvas = document.getElementById('pdfViewer');
        const ctx = canvas.getContext('2d');

        // Get PDF URL from query parameter
        const urlParams = new URLSearchParams(window.location.search);
        const pdfUrl = urlParams.get('pdf');

        async function loadPDF(url) {
            try {
                const loadingTask = pdfjsLib.getDocument(url);
                pdfDoc = await loadingTask.promise;
                document.getElementById('totalPages').textContent = pdfDoc.numPages;
                renderPage(pageNum);
            } catch (error) {
                console.error('Error loading PDF:', error);
            }
        }

        async function renderPage(num) {
            const page = await pdfDoc.getPage(num);
            const viewport = page.getViewport({ scale });
            
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            const renderContext = {
                canvasContext: ctx,
                viewport: viewport
            };

            await page.render(renderContext);
            document.getElementById('currentPage').textContent = num;
        }

        // Zoom controls
        document.getElementById('zoomIn').onclick = () => {
            scale *= 1.2;
            document.getElementById('zoomLevel').textContent = `${Math.round(scale * 100)}%`;
            renderPage(pageNum);
        };

        document.getElementById('zoomOut').onclick = () => {
            scale *= 0.8;
            document.getElementById('zoomLevel').textContent = `${Math.round(scale * 100)}%`;
            renderPage(pageNum);
        };

        // Download PDF
        document.getElementById('download').onclick = () => {
            if (pdfUrl) {
                const link = document.createElement('a');
                link.href = pdfUrl;
                link.download = 'document.pdf';
                link.click();
            }
        };

        // Print PDF
        document.getElementById('print').onclick = () => {
            window.print();
        };

        // Load PDF if URL is provided
        if (pdfUrl) {
            loadPDF(pdfUrl);
        }
    </script>
</body>
</html>