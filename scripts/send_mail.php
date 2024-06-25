<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $message = htmlspecialchars($_POST['message']);

    $to = 'vegar@gmail.com';
    $subject = 'Ny melding fra Mental Racing Team';
    $body = "Navn: $name\n\nMelding:\n$message";
    $headers = 'From: no-reply@mentalracing.no' . "\r\n" .
               'Reply-To: no-reply@mentalracing.no' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    if (mail($to, $subject, $body, $headers)) {
        echo 'Meldingen din har blitt sendt!';
    } else {
        echo 'Det oppstod en feil. Vennligst prøv igjen.';
    }
} else {
    echo 'Ugyldig forespørsel.';
}
?>
