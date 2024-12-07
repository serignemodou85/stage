<?php

namespace App\Mail;

use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClientInscriptionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function build()
    {
        return $this->from('toubasoftit@gmail.com')
                    ->subject('Confirmation de votre inscription')
                    ->view('emails.client_inscription')
                    ->with([
                        'nom' => $this->client->nom,
                        'prenom' => $this->client->prenom,
                        'nom_entreprise' => $this->client->nom_entreprise,
                    ]);
    }
}

