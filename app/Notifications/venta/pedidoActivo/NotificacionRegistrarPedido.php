<?php
namespace App\Notifications\venta\pedidoActivo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
// Models
use App\Models\Sistema;
// Otros
use Carbon\Carbon;

class NotificacionRegistrarPedido extends Notification { // No implementar ShouldQueue
    use Queueable;
    protected $cliente;
    protected $pedido;
    protected $plantilla;
    
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($cliente, $pedido, $plantilla) {
        $this->cliente      = $cliente;
        $this->pedido       = $pedido;
        $this->plantilla    = $plantilla;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail']; // 'database', 'mail'
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable) {
        $year = Carbon::parse(Sistema::datos()->sistemaFindOrFail()->year_de_ini);
        return (new MailMessage)
        ->subject($this->plantilla->asunt)
        ->view(
            'correo.' . $this->plantilla->id, [
                // General
                'nombre_completo_del_usuario'       => $notifiable->nom . ' ' . $notifiable->apell,
                'nombre_del_usuario'                => $notifiable->nom,
                'apellido_del_usuario'              => $notifiable->apell,
                'email_registro_del_usuario'        => $notifiable->email_registro,
                'nombre_de_la_empresa'              => Sistema::datos()->sistemaFindOrFail()->emp_abrev,
                'year_de_inicio_de_la_empresa'      => $year->year,
                'pagina_web_de_la_empresa'          => Sistema::datos()->sistemaFindOrFail()->pag,
                'pagina_de_inicio_del_sistema'      => url(config('app.url')),
                'year_actual'                       => date("Y"),
                // Otros
                'numero_de_pedido'                  => $this->pedido->serie,
            ]
        );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
        
    }
}