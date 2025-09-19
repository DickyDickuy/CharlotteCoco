<?php
use Dotenv\Dotenv;

require_once 'vendor/autoload.php';

// Load environment variables from .env file
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

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

    // Initialize Resend with your API key from .env
    $apiKey = $_ENV['RESEND_API_KEY'];
    if (!$apiKey) {
        die("RESEND_API_KEY not set in .env file.");
    }
    $resend = \Resend::client($apiKey);

    // Prepare email content
    $subject = "New Contact Form Submission from $name";
    $email_content = "Name: $name
";
    $email_content .= "Email: $email
";
    $email_content .= "Product of Interest: $product
";
    $email_content .= "Address: $address

";
    $email_content .= "Message:
$message
";

    try {
        $result = $resend->emails->send([
            'from' => 'onboarding@resend.dev', 
            'to' => 'andhikahutama9@gmail.com', 
            'subject' => $subject,
            'text' => $email_content,
        ]);

        // Redirect to a success page
        header("Location: thank_you.html");
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
