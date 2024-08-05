<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ota vastaan lomakkeen tiedot ja varmista turvallisuus
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Tarkista että kentät eivät ole tyhjiä
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

        // Lähetä sähköposti
        if (mail($to, $subject, $email_message, $headers)) {
            echo "Kiitos palautteestasi!";
        } else {
            echo "Lomakkeen lähetys epäonnistui. Yritä uudelleen myöhemmin.";
        }
    } else {
        echo "Kaikki kentät ovat pakollisia.";
    }
} else {
    echo "Virheellinen pyyntö.";
}
?>