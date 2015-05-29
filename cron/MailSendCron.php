<?php

$base = '/Users/dev/Sites/masaze/';
require_once ($base . "cron/lib/phpmailer/class.phpmailer.php");
require_once ($base . "db/dbConnection.php");
require_once ($base . "classes/MailTemplates.php");
require_once $base . "classes/hem.php";

class MailSendCron {
    const MAIL_FROM = 'massages@olx.com';

    const NAME_FROM = 'massages@olx.com';

    const SUBJECT = 'Tu turno de masajes';

    const EMAIL_HOSTNAME = 'relay1.olx.com';

    const SMTP_HOST_1 = "mail-server";

    const SMTP_SERVER =  "smtp.betaolx.com.ar";

    const SCHEDULES_COUNT = 2;

    protected $mailer;

    public function __construct($actionType) {
        $this->init((int)$actionType);
    }

    public function init($actionType) {
        $hem = new ClassHEM();
        $hem->selectCandidates(self::SCHEDULES_COUNT);

        $mailList = $this->getMailList($actionType);

        $this->processMails($mailList, $actionType);
    }

    private function processMails($mailList, $actionType)
    {
        $erase = false;
        if ($actionType === 1) {
            foreach ($mailList as $mail) {
                $this->mailer = $this->createMailer();
                $toAddress = $mail;
                $mailType = 1;
                $mailTemplate = $this->getMailTemplate($mailType, $mail);
                $this->mailer->Sender = self::MAIL_FROM;
                $this->mailer->FromName = self::NAME_FROM;
                $this->mailer->From = self::MAIL_FROM;
                $this->mailer->Subject = self::SUBJECT;
                $this->mailer->Body = $mailTemplate;
                $this->mailer->AddAddress($toAddress, $toAddress);

                if ($this->mailer->Send()) {
                    error_log("Mail sent to: $mail - ok");
                } else {
                    error_log("Error sending email to: $mail : " . $this->mailer->ErrorInfo);
                }
            }
        } else {
            foreach ($mailList as $mail) {
                $this->mailer = $this->createMailer();
                $toAddress = $mail['email'];
                $mailType = $this->getMailTypeFromAction($actionType, $mail);
                var_dump($mailType);
                $mailTemplate = $this->getMailTemplate($mailType, $mail['email']);
                $this->mailer->Sender = self::MAIL_FROM;
                $this->mailer->FromName = self::NAME_FROM;
                $this->mailer->From = self::MAIL_FROM;
                $this->mailer->Subject = self::SUBJECT;
                $this->mailer->Body = $mailTemplate;
                $this->mailer->AddAddress($toAddress, $toAddress);

                if ($this->mailer->Send()) {
                    error_log("Mail sent to: "  . $mail['email'] . " - ok");
                    $erase = true;
                } else {
                    error_log("Error sending email to: " . $mail['email'] . " : " . $this->mailer->ErrorInfo);
                }
            }
            if ($erase) {
                $this->deleteAfterProcess();
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

    protected function getMailList ($actionType)
    {
        $dbConn = new dbConnection();
        if ($actionType === 1) {
            $sql = "SELECT email FROM masaze_users";

            $execution = $dbConn->getInstance()->executeQuery($sql);

            foreach ($execution as $result) {
                $results[] = $result['email'];
            }
        } else {
            $sql = 'SELECT u.email, a.elegible FROM masaze_users u inner join masaze_appointments a on
                (a.user_id = u.id)';

            $execution = $dbConn->getInstance()->executeQuery($sql);

            $results = $execution;
        }

        return $results;
    }

    private function deleteAfterProcess()
    {
        $sql = 'DELETE FROM masaze_appointments';

        $dbConn = new dbConnection();
        $dbConn->getInstance()->executeQueryInsert($sql);
    }

    private function getMailTemplate($mailType, $mail)
    {
        $pattern = "<<EMAILTO>>";
        $patternUserName = "<<USERNAME>>";
        $pos = strpos($mail, "@");
        $userName = substr($mail, 0, $pos);
        $template = str_replace($patternUserName, $userName, MailTemplates::retrieveMailTemplate($mailType));
        $template2 = str_replace($pattern, $mail, $template);

        return $template2;
    }

    private function getMailTypeFromAction($actionType, $mail)
    {
        switch ($actionType) {
            case 1:
                return 1;
            case 2:
                if ((int)$mail['elegible'] === 1) {
                    return 2;
                } else {
                    return 3;
                }
        }
    }
}

new MailSendCron($argv[1]);