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

    const BODY_HTML = '
';

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

        foreach ($execution as $result) {
            $results[] = $result['email'];
        }

        return $results;
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