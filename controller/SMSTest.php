<?php
 
require_once 'SMSService.php';
// Initialize the SMS service
$smsService = new SMSService(
    'MlXHORnGGOOtBa97gz07TYRN5PH7qWRA',
    'o2iL5kgRuKYmwEdS',
    '+221774964606',
    'K2A'
);

// Définir les variables dynamiques
$prenomNomAdmin = "John Doe"; 
$service = "IT Support";

// Send an SMS
$numeroDestination = '+221774964606';
$message = "Bonjour $prenomNomAdmin,\nUne nouvelle demande d'intervention au service $service est en attente de traitement.\n\nDAGE - MFB";

$result = $smsService->envoyerSMS($numeroDestination, $message);

if ($result) {
    echo "SMS sent successfully";
} else {
    echo "Failed to send SMS";
}
