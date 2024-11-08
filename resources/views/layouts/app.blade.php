<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stocks Report</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Link to your CSS -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>

    @livewireStyles
</head>
<body>
    <div id="pdfPreviewModal" class="fixed inset-0 bg-gray-700 bg-opacity-50 hidden">
        <div class="bg-white w-11/12 md:w-3/4 lg:w-1/2 xl:w-1/3 mx-auto mt-10 p-4 rounded shadow-lg">
            <iframe src="" width="100%" height="600px"></iframe>
            <button onclick="document.getElementById('pdfPreviewModal').classList.add('hidden')" class="mt-4 px-4 py-2 bg-red-500 text-white rounded">Close</button>
        </div>
    </div>

    <div class="container mx-auto">
        @yield('content') <!-- This is where the content of other views will be injected -->
    </div>
    
    <script src="{{ asset('js/app.js') }}"></script> <!-- Link to your JS -->
    @livewireScripts

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            window.addEventListener('openPdfPreview', event => {
                const pdfModal = document.getElementById('pdfPreviewModal');
                const iframe = pdfModal.querySelector('iframe');
                iframe.src = event.detail.url;  // Set the PDF URL in the iframe
                pdfModal.classList.remove('hidden'); // Show the modal
            });
        });
    </script>
</body>
</html>
