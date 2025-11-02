<?php

namespace App\Services;

use SendinBlue\Client\Configuration;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Model\SendSmtpEmail;
use Illuminate\Support\Facades\Log;

class BrevoService
{
    protected $apiKey;
    protected $senderEmail;
    protected $senderName;

    public function __construct()
    {
        $this->apiKey = config('services.brevo.api_key');
        $this->senderEmail = config('services.brevo.sender_email');
        $this->senderName = config('services.brevo.sender_name');
    }

    public function sendContactEmail($toEmail, $toName, $data)
    {
        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', $this->apiKey);
        $apiInstance = new TransactionalEmailsApi(null, $config);

        $email = new SendSmtpEmail();
        $email->setSender([
            'name' => $this->senderName,
            'email' => $this->senderEmail
        ]);
        $email->setTo([['email' => $toEmail, 'name' => $toName]]);
        $email->setSubject('Nuevo mensaje de contacto desde Komercia');
        $email->setHtmlContent(view('emails.contact-message', ['data' => $data])->render());

        try {
            $apiInstance->sendTransacEmail($email);
            return true;
        } catch (\Exception $e) {
            \Log::error('Error al enviar correo con Brevo: ' . $e->getMessage());
            return false;
        }
    }
}