<?php

namespace App\Services;

use SendinBlue\Client\Configuration;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Model\SendSmtpEmail;
use SendinBlue\Client\Model\SendSmtpEmailSender;
use SendinBlue\Client\Model\SendSmtpEmailTo;
use Illuminate\Support\Facades\Log;
use Exception;

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

    public function sendContactEmail($toEmails, $toName, $data): bool
    {
        try {
            // Configuración de API
            $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', $this->apiKey);
            $apiInstance = new TransactionalEmailsApi(null, $config);

            // Si solo viene un correo, conviértelo en array
            if (!is_array($toEmails)) {
                $toEmails = [$toEmails];
            }

            // Convertir correos a formato esperado por Brevo
            $recipients = array_map(fn($email) => new SendSmtpEmailTo(['email' => $email, 'name' => $toName]), $toEmails);

            // Crear email
            $email = new SendSmtpEmail();
            $email->setSender(new SendSmtpEmailSender([
                'name' => $this->senderName,
                'email' => $this->senderEmail
            ]));
            $email->setTo($recipients);
            $email->setSubject('Nuevo mensaje de contacto desde Komercia');
            $email->setHtmlContent(view('emails.contact-message', ['data' => $data])->render());

            // Enviar
            $apiInstance->sendTransacEmail($email);

            return true;
        } catch (Exception $e) {
            Log::error('Error al enviar correo con Brevo: ' . $e->getMessage());
            return false;
        }
    }
}
