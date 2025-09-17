<?php
use Resend\Resend;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $product = strip_tags(trim($_POST["product"]));
    $address = strip_tags(trim($_POST["address"]));
    $message = strip_tags(trim($_POST["message"]));

    // Validate form data
    if (empty($name) || empty($email) || empty($product) || empty($address) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Handle error - redirect back to form with an error message
        header("Location: contact.html?status=error");
        exit;
    }

    // Initialize Resend with your API key
    $apiKey = getenv('RESEND_API_KEY'); // It's best to use an environment variable for your API key
    if (!$apiKey) {
        die("RESEND_API_KEY not set.");
    }
    $resend = Resend::client($apiKey);

    // Prepare email content
    $subject = "New Contact Form Submission from $name";
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Product of Interest: $product\n";
    $email_content .= "Address: $address\n\n";
    $email_content .= "Message:\n$message\n";

    try {
        $result = $resend->emails->send([
            'from' => 'onboarding@resend.dev', // Replace with your verified sender domain
            'to' => 'your-email@example.com', // Replace with your email address
            'subject' => $subject,
            'text' => $email_content,
        ]);

        // Redirect to a success page
        header("Location: contact.html?status=success");
        exit;

    } catch (\Exception $e) {
        // Handle API error
        error_log($e->getMessage());
        header("Location: contact.html?status=error");
        exit;
    }
} else {
    // Not a POST request, redirect to the form
    header("Location: contact.html");
    exit;
}
?>
