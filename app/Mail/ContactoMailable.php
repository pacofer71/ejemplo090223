<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactoMailable extends Mailable
{
    use Queueable, SerializesModels;

    public array $datos;
    

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $datos)
    {
        $this->datos=$datos; //nombre, contenido    nombre, contenido, email
        if(!isset($datos['email']))  $this->datos['email']=auth()->user()->email
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address($this->datos['email'], $this->datos['nombre']),
            subject: 'Formulario de Contacto',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'mcontacto.index',
            with:[
                'nombre'=>$this->datos['nombre'],
                'email'=>$this->datos['email'],
                'contenido'=>$this->datos['contenido']
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
