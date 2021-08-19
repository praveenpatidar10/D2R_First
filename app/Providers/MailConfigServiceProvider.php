<?php

namespace App\Providers;

use Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        if (\Schema::hasTable('site_settings')) {
            $mail = DB::table('site_settings')->first();
            if ($mail){
                $config = array(
                    'driver'     => $mail->mail_driver,
                    'host'       => $mail->mail_host,
                    'port'       => $mail->mail_port,
                    'from'       => array('address' => $mail->mail_from_address, 'name' => $mail->mail_from_name),
                    'encryption' => $mail->mail_encryption,
                    'username'   => $mail->mail_username,
                    'password'   => $mail->mail_password,
                    'sendmail'   => '/usr/sbin/sendmail -bs',
                    'pretend'    => false,
                );
                Config::set('mail', $config);
            }
        }
    }
}