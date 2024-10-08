<?php
// Tarkista, onko lomake lähetetty POST-menetelmällä
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ota lomakkeen tiedot ja puhdista ne mahdollisista haitallisista merkinnöistä
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Tarkista, että kentät eivät ole tyhjiä
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Aseta vastaanottajan sähköpostiosoite
        $to = "turosburger@gmail.com";

        // Aseta sähköpostin otsikko
        $subject = "Uusi palaute Turo's Burgerin sivustolta";

        // Rakenna sähköpostin viesti
        $email_message = "Nimi: $name\n";
        $email_message .= "Sähköposti: $email\n";
        $email_message .= "Viesti:\n$message\n";

        // Aseta sähköpostin otsakkeet
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";

        // Lähetä sähköposti ja tarkista, onnistuiko lähetys
        if (mail($to, $subject, $email_message, $headers)) {
            // Jos lähetys onnistui, näytä kiitosviesti ja ohjaa takaisin etusivulle 3 sekunnin kuluttua
            echo '<!DOCTYPE html>
            <html lang="fi">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Kiitos palautteestasi</title>
                <style>
                    body { font-family: Arial, sans-serif; }
                    .message-container { max-width: 600px; margin: 0 auto; text-align: center; padding: 20px; }
                    p { font-size: 18px; }
                </style>
            </head>
            <body>
                <div class="message-container">
                    <p>Kiitos palautteestasi!</p>
                    <p>Sinut ohjataan takaisin etusivulle...</p>
                </div>
                <meta http-equiv="refresh" content="3;url=index.html">
            </body>
            </html>';
        } else {
            // Jos lähetys epäonnistui, näytä virheviesti
            echo '<!DOCTYPE html>
            <html lang="fi">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Virhe</title>
                <style>
                    body { font-family: Arial, sans-serif; }
                    .message-container { max-width: 600px; margin: 0 auto; text-align: center; padding: 20px; }
                    p { font-size: 18px; }
                </style>
            </head>
            <body>
                <div class="message-container">
                    <p>Lomakkeen lähetys epäonnistui. Yritä uudelleen myöhemmin.</p>
                </div>
            </body>
            </html>';
        }
    } else {
        // Jos kentät ovat tyhjiä, näytä virheviesti
        echo '<!DOCTYPE html>
        <html lang="fi">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Virhe</title>
            <style>
                body { font-family: Arial, sans-serif; }
                .message-container { max-width: 600px; margin: 0 auto; text-align: center; padding: 20px; }
                p { font-size: 18px; }
            </style>
        </head>
        <body>
            <div class="message-container">
                <p>Kaikki kentät ovat pakollisia.</p>
            </div>
        </body>
        </html>';
    }
} else {
    // Jos pyyntö ei ole POST-menetelmällä, näytä virheviesti
    echo '<!DOCTYPE html>
    <html lang="fi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Virhe</title>
        <style>
            body { font-family: Arial, sans-serif; }
            .message-container { max-width: 600px; margin: 0 auto; text-align: center; padding: 20px; }
            p { font-size: 18px; }
        </style>
    </head>
    <body>
        <div class="message-container">
            <p>Virheellinen pyyntö.</p>
        </div>
    </body>
    </html>';
}
?>