let html5QRCodeScanner = new Html5QrcodeScanner(
    "reader", {
        fps: 30,
        qrbox: {
            width: 200,
            height: 200,
        },
    }
);

function onScanSuccess(decodedText, decodedResult) {
    var variabelData = { data: {
        code: decodedResult.decodedText
    }};
    Livewire.dispatch('qr-scanned-pulang', variabelData);
    html5QRCodeScanner.clear();
}

function onScanFailure(error) {
    var variabelData = { status: 'failed', error: error };
    Livewire.dispatch('qr-scanned-failed-pulang', variabelData);
}

html5QRCodeScanner.render(onScanSuccess);

// (Optional) Scan dari gambar upload
document.addEventListener('DOMContentLoaded', function () {
    const uploadButton = document.querySelector('.html5-qrcode-anchor-scan-image');
    if (uploadButton) {
        uploadButton.addEventListener('click', function () {
            const html5QrCode = new Html5Qrcode(/* id element */"reader");
            html5QrCode.scanFile()
                .then(onScanSuccess)
                .catch(err => console.error('Scan image error', err));
        });
    }
});
