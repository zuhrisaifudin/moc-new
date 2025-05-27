<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MocRequestSentToFuctionRequest extends Notification
{
    use Queueable;

    protected $moc;

    /**
     * Create a new notification instance.
     */
    public function __construct($moc)
    {
         $this->moc = $moc;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Permohonan MOC Telah Dikirim')
                    ->greeting('Halo ' . $notifiable->name)
                    ->line('Permohonan Manajemen Perubahan (MOC) Anda telah berhasil dikirim ke Fungsi Pengusul.')
                    ->line('ID Permohonan: ' . $this->moc->id)
                    ->action('Lihat Detail Permohonan', url('/moc-requests/' . $this->moc->id))
                    ->line('Terima kasih telah menggunakan layanan kami.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
