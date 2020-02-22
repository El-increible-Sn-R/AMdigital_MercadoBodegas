<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmacionDeReserva extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $datosNecesarios;
    public function __construct($DatosNecesarios)
    {
        $this->datosNecesarios=$DatosNecesarios;
    }
    public function build()
    {
        return $this->from('mercadobodegastestperu@gmail.com','Mercado Bodegas')
                ->view('ConfirmacionDeReserva')
                ->subject('Confirmacion de reserva');
    }
}
