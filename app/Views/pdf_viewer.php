<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View PDF</title>
    <style>
        html, body {
            margin: 0;
            height: 100%;
            overflow: hidden;
        }
        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</head>
<body>
    <!-- 
         The PDF.js viewer is hosted at mozilla.github.io/pdf.js/web/viewer.html.
         We pass our PDF URL as a URL-encoded parameter to the viewer.
    -->
    <iframe src="https://mozilla.github.io/pdf.js/web/viewer.html?file=<?= urlencode($pdfUrl) ?>"></iframe>
</body>
</html>
