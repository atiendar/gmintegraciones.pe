<?php
namespace App\Notifications\factura;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
// Models
use App\Models\Sistema;
// Otros
use Carbon\Carbon;

class NotificacionFacturaGenerada extends Notification {
    use Queueable;
    protected $cliente;
    protected $plantilla;
    protected $factura;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($cliente, $plantilla, $factura) {
      $this->cliente    = $cliente;
      $this->plantilla  = $plantilla;
      $this->factura    = $factura;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable) {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable) {
      $year = Carbon::parse(Sistema::datos()->sistemaFindOrFail()->year_de_ini);
/*
      if($this->factura->fact_pdf_nom != null) {
        $fact_pdf = file_get_contents(env('APP_URL').\Storage::url($this->factura->fact_pdf_rut.$this->factura->fact_pdf_nom));
        $fact_xlm = file_get_contents(env('APP_URL').\Storage::url($this->factura->fact_xlm_rut.$this->factura->fact_xlm_nom));
      }
      if($this->factura->ppd_pdf_nom != null) {
        $ppd_pdf = file_get_contents(env('APP_URL').\Storage::url($this->factura->ppd_pdf_rut.$this->factura->ppd_pdf_nom));
        $ppd_xlm = file_get_contents(env('APP_URL').\Storage::url($this->factura->ppd_xlm_rut.$this->factura->ppd_xlm_nom));
      }
*/
        return (new MailMessage)
          ->subject($this->plantilla->asunt)
        //  ->attachData($fact_pdf, 'factura.pdf')
        //  ->attachData($fact_xlm, 'factura.xlm')
        //  ->attachData($ppd_pdf, 'ppd.pdf')
        //  ->attachData($ppd_xlm, 'ppd.xlm')
          ->view(
            'correo.' . $this->plantilla->id, [
                // SISTEMA
                'nombre_de_la_empresa'              => Sistema::datos()->sistemaFindOrFail()->emp, 
                'nombre_de_la_empresa_abreviado'    => Sistema::datos()->sistemaFindOrFail()->emp_abrev,
                'telefono_fijo'                     => Sistema::datos()->sistemaFindOrFail()->lad_fij.Sistema::datos()->sistemaFindOrFail()->tel_fij,
                'extension'                         => Sistema::datos()->sistemaFindOrFail()->ext, 
                'telefono_movil'                    => Sistema::datos()->sistemaFindOrFail()->lad_mov.Sistema::datos()->sistemaFindOrFail()->tel_mov, 
                'direccion_uno'                     => Sistema::datos()->sistemaFindOrFail()->direc_uno,
                'correo_ventas'                     => Sistema::datos()->sistemaFindOrFail()->corr_vent,
                'year_de_inicio_de_la_empresa'      => $year->year, 
                'pagina_web_de_la_empresa'          => Sistema::datos()->sistemaFindOrFail()->pag,
                'pagina_de_inicio_del_sistema'      => url(config('app.url')),
                'year_actual'                       => date("Y"),
                
                // USUARIO
                'nombre_completo_del_usuario'       => $notifiable->nom . ' ' . $notifiable->apell,
                'nombre_del_usuario'                => $notifiable->nom,
                'apellido_del_usuario'              => $notifiable->apell,
                'email_registro_del_usuario'        => $notifiable->email_registro,
                
                // EXTRAS
                'id_factura'                        =>  $this->factura->id,
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
