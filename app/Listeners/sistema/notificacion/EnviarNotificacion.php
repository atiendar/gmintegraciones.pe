<?php
namespace App\Listeners\sistema\notificacion;
use App\Events\sistema\notificacion\NotificacionEnviada;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
// Notifications
use Illuminate\Support\Facades\Notification;
use App\Notifications\notificacion\NotificacionSent;

class EnviarNotificacion implements ShouldQueue {
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NotificacionEnviada  $event
     * @return void
     */
    public function handle(NotificacionEnviada $event) {
        // Envía un correo a cada usuario y guarda la notificación en la BD
        Notification::send($event->usuarios, new NotificacionSent($event->notificacion));
    }
}
