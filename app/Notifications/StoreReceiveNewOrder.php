<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;


class StoreReceiveNewOrder extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','mail', 'nexmo'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Você recebeu um novo pedido!')
                    ->greeting('Olá vendedor, tudo bem?')
                    ->line('Vovê recebeu um novo pedido na loja.')
                    ->action('Ver pedido', route('admin.orders.my'));
                    
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
            'message' => 'Você tem um novo pedido Solicitado!'
        ];
    }

   public function toNexmo($notifiable)
   {
       return (new NexmoMessage)
                    ->content('Você recebeu um novo pedido em nosso site!')
                    ->from('61999955207')
                    ->unicode();
   }
}
