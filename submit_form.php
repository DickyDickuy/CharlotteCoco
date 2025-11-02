<?php
use Dotenv\Dotenv;

require_once 'vendor/autoload.php';

// Load environment variables from .env file
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form data
    $inquiry_type = strip_tags(trim($_POST["inquiry_type"]));
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = strip_tags(trim($_POST["phone"]));
    $company = strip_tags(trim($_POST["company"]));
    $job_title = strip_tags(trim($_POST["job_title"]));
    $company_address = strip_tags(trim($_POST["company_address"]));
    $city = strip_tags(trim($_POST["city"]));
    $state = strip_tags(trim($_POST["state"]));
    $country = strip_tags(trim($_POST["country"]));
    $message = strip_tags(trim($_POST["message"]));

    // Basic validation
    if (empty($inquiry_type) || empty($name) || empty($email) || empty($company) || empty($job_title) || empty($company_address) || empty($city) || empty($state) || empty($country) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
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
    $subject = "New Inquiry: $inquiry_type from $name at $company";
    $email_content = "You have received a new inquiry.\n\n";
    $email_content .= "Inquiry Type: $inquiry_type\n";
    $email_content .= "Name: $name\n";
    $email_content .= "Company Email: $email\n";
    $email_content .= "Phone Number: $phone\n";
    $email_content .= "Company: $company\n";
    $email_content .= "Job Title: $job_title\n";
    $email_content .= "Company Address: $company_address\n";
    $email_content .= "City: $city\n";
    $email_content .= "State/Province: $state\n";
    $email_content .= "Country: $country\n\n";
    $email_content .= "Message:\n$message\n";

    try {
        $result = $resend->emails->send([
            'from' => 'onboarding@resend.dev', 
            'to' => 'business@charlottecocosugar.com', 
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
