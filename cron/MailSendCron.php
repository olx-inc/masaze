<?php

$base = '/Users/dev/Sites/masaze/';
require_once ($base . "cron/lib/phpmailer/class.phpmailer.php");
require_once ($base . "db/dbConnection.php");
require_once ($base . "classes/MailTemplates.php");

class MailSendCron {
    const MAIL_FROM = 'massages@olx.com';

    const NAME_FROM = 'massages@olx.com';

    const SUBJECT = 'Tu turno de masajes';

    const EMAIL_HOSTNAME = 'relay1.olx.com';

    const BODY_HTML = '<table style="border-collapse:collapse;margin:0;padding:0;background-color:#ececec;min-height:100%!important;width:100%!important" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <td align="center">
                <table style="border-collapse:collapse;text-align:left;max-width:600px" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td align="center" style="padding:20px;font-family:Arial,helvetica,sans-serif;color:#666666;font-size:11px">Reserva tu turno</td>
                        </tr>
                        <tr>
                            <td>
                                <table style="border-collapse:collapse;text-align:left;border-radius:5px 5px 0 0;background-color:#ffffff;min-width:330px;max-width:100%" border="0" cellpadding="0" cellspacing="0">
                                    <tbody>
                                        <tr>
                                            <td align="left" valign="top">
                                                <table bgcolor="#FAFAFA" width="100%" style="border-bottom-style:solid;border-bottom-width:1px;border-bottom-color:#ececec;border-radius:5px 5px 0 0" border="0" cellpadding="0" cellspacing="0">
                                                    <tbody>
                                                        <tr>
                                                            <td width="41" valign="middle" style="padding-left:20px;padding-top:10px;padding-bottom:10px">
                                                                <a href="" target="_blank">
                                                                    <img src="http://10.4.12.27:9876/images/logo.png" alt="OLX" width="200" height="65" border="0" style="display:block;margin-right:10px" />
                                                                </a>
                                                            </td>
                                                            <td valign="middle">
                                                                <a href="" style="text-decoration:none;color:#000000!important;font-size:18px;font-family:Arial,helvetica,sans-serif" target="_blank"><strong>masaże :: Sistema de turnos</strong></a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" width="100%" style="padding-top:0;padding-bottom:0;padding-right:20px;padding-left:20px">
                                                <table width="100%" style="border-collapse:collapse;text-align:left" border="0" cellpadding="0" cellspacing="0">
                                                    <tbody>
                                                        <tr>
                                                            <td valign="top" style="width:100%">
                                                                <table border="0" cellpadding="0" cellspacing="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td valign="top" style="padding-top:22px;padding-bottom:22px;font-size:31px;font-family:Arial,helvetica,sans-serif">
                                                                            Reserva tu turno para masages!
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td valign="top" style="padding-bottom:30px;font-size:13px;line-height:1.3">
                                                                                Hola USUARIO:
                                                                                <br>
                                                                                <p>
                                                                                    Haciendo click en el siguiente link vas a entrar en el sistema de reserva de turnos.
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>

                                                        </tr>
                                                        <tr>
                                                            <td valign="top" style="height:10px"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <table width="100%" style="border-collapse:collapse;text-align:left" border="0" cellpadding="0" cellspacing="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td valign="center" align="center" style="width:100%%;padding-top:10px;padding-bottom:10px;">
                                                                                 <a href="" style="display:inline-block;color:#ffffff;padding-top:12px;padding-bottom:12px;padding-left:20px;padding-right:20px;background-color:#29aae1;text-decoration:none;border-radius:5px;font-family:Arial,helvetica,sans-serif;font-size:16px;font-weight:bold;text-align:center;vertical-align:top;margin-right:10px;border-bottom:3px solid #057ea8" target="_blank">Reservalo ahora</a>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="top" style="height:10px"></td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" style="padding-bottom:20px;font-family:Arial,helvetica,sans-serif;color:#000000;font-size:13px">
                                                                Gracias por usar masaże.
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>';

    const SMTP_HOST_1 = "mail-server";

    const SMTP_SERVER =  "smtp.betaolx.com.ar";

    public function __construct($mailType) {
        $this->init($mailType);
    }

    public function init($mailType) {
        $mailList = $this->getMailList();

        $mailer = $this->createMailer();

        $mailTemplate = $this->getMailTemplate($mailType);

        foreach ($mailList as $mail) {
            $toAddress = $mail;
            $mailer->Sender = self::MAIL_FROM;
            $mailer->FromName = self::NAME_FROM;
            $mailer->From = self::MAIL_FROM;
            $mailer->Subject = self::SUBJECT;
            $mailer->Body = $mailTemplate;
            $mailer->AddAddress($toAddress, $toAddress);

            if ($mailer -> Send()) {
                error_log("Mail sent to: $mail - ok");
                $this->markMailSent($mail);
            } else {
                error_log("Error sending email to: $mail : " . $mailer -> ErrorInfo);
            }
        }
    }

    protected function createMailer() {
        $mailer = new PHPMailer();
        $mailer -> IsSMTP();
        // send via SMTP
        $mailer -> Host = self::SMTP_HOST_1;
        // SMTP servers
        $mailer -> Hostname = self::EMAIL_HOSTNAME;
        // Host Name
        $mailer -> SMTPAuth = false;
        // turn on SMTP authentication
        $mailer -> Username = 'sitemail@olx.com';
        // SMTP username
        $mailer -> Password = 'pendrive';
        // SMTP password
        $mailer -> WordWrap = 64;
        // set word wrap
        $mailer -> IsHTML(true);
        // send as HTML
        $mailer -> CharSet = 'utf-8';
        return $mailer;
    }

    protected function getMailList ()
    {
        $sql = 'SELECT u.email FROM masaze_users u inner join masaze_appointments a on
                (a.user_id = u.id) where a.sent = 0';

        $dbConn = new dbConnection();
        $execution = $dbConn->getInstance()->executeQuery($sql);

        return $execution;
    }

    private function markMailSent($mail)
    {
        $sql = 'UPDATE masaze_appointments set sent = 1 where user_id = (SELECT id
                FROM masaze_users WHERE email = "' . $mail . '")';

        $dbConn = new dbConnection();
        $dbConn->getInstance()->executeQueryInsert($sql);
    }

    private function getMailTemplate($mailTemplate)
    {
        return MailTemplates::retrieveMailTemplate($mailTemplate);
    }
}

new MailSendCron($argv);