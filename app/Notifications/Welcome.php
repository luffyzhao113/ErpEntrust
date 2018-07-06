<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Welcome extends Notification
{
    use Queueable;

    protected $admin;

    /**
     * Welcome constructor.
     * @param $admin
     */
    public function __construct($admin)
    {
        $this->admin = $admin;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * 数据库广播
     * @method toDatabase
     * @param $notifiable
     *
     * @return array
     *
     * @author luffyzhao@vip.126.com
     */
    public function toDatabase($notifiable)
    {
        $ip = request()->ip();
        return [
            'title' => "欢迎 {$this->admin->name} 登录系统",
            'content' => "登录IP地址:{$ip},...",
        ];
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
