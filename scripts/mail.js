document.addEventListener('DOMContentLoaded', function() {
    const contactButton = document.getElementById('contactButton');

    contactButton.addEventListener('click', function() {
        const name = prompt('Vennligst skriv inn ditt navn:');
        if (name) {
            const message = prompt('Vennligst skriv inn din melding:');
            if (message) {
                const formData = new FormData();
                formData.append('name', name);
                formData.append('message', message);

                fetch('scripts/send_mail.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    alert('Meldingen din har blitt sendt!');
                })
                .catch(error => {
                    alert('Det oppstod en feil. Vennligst prøv igjen.');
                    console.error('Error:', error);
                });
            } else {
                alert('Melding er påkrevd.');
            }
        } else {
            alert('Navn er påkrevd.');
        }
    });
});
