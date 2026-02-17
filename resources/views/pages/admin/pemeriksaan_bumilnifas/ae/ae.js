flatpickr(".date", { dateFormat: "Y-m-d", disableMobile: "true" });

$wire.on('confirm-save', (e) => {
    Swal.fire({
        title: 'Simpan Data',
        text: `Lanjutkan simpan data pemeriksaan ?`,
        icon: "question",
        showCancelButton: true,
    }).then((result) => {
        if (result.isConfirmed) {
            $wire.save();
        }
    });
});
