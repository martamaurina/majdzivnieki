<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST["message"]);
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Nederīgs e-pasta formāts!'); window.history.back();</script>";
        exit();
    }
    
    $to = "2025murratava@gmail.com";
    $subject = "Jauns ziņojums no kontaktformas";
    $body = "Vārds: $name\n" .
            "E-pasts: $email\n\n" .
            "Ziņojums:\n$message";
    $headers = "From: $email\r\n" . "Reply-To: $email\r\n" . "X-Mailer: PHP/" . phpversion();
    
    if (mail($to, $subject, $body, $headers)) {
        echo "<script>alert('Ziņojums veiksmīgi nosūtīts!'); window.location.href='contact.html';</script>";
    } else {
        echo "<script>alert('Kļūda! Ziņojums netika nosūtīts.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Nederīgs pieprasījums.'); window.history.back();</script>";
}