<div>
    <iframe src="{{ $pdfUrl }}" width="100%" height="800px"></iframe>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        window.addEventListener('openPdfPreview', event => {
            const pdfModal = document.getElementById('pdfPreviewModal');
            const iframe = pdfModal.querySelector('iframe');
            iframe.src = event.detail.url;
            pdfModal.classList.remove('hidden');
        });
    });
</script>
