<?php

$base = "../";
require_once ($base . "cron/lib/phpmailer/class.phpmailer.php");
require_once ($base . "db/dbConnection.php");
require_once ($base . "classes/MailTemplates.php");
require_once $base . "classes/hem.php";

class ProcessEvent {
    const ADMIN_MAIL_TO = 'melina.couto@olx.com';
    const ADMIN_MAIL_SUBJECT = 'Turnos concedidos';
    const MAIL_FROM = 'massages@olx.com';
    const NAME_FROM = 'massages@olx.com';
    const SUBJECT_CONFIRMED = 'Turno de masajes asignado';
    const SUBJECT_INVITE = 'Te invitamos a una pausa...';
    const EMAIL_HOSTNAME = 'relay1.olx.com';
    const SMTP_HOST_1 = "mail-server";
    const SMTP_SERVER =  "smtp.betaolx.com.ar";
    const SCHEDULES_COUNT = 15;

    protected $mailer;
    protected $emailListSelected = array();
    protected $emailListDiscarded = array();
    protected $actionType = 0;

    public function __construct($actionType) {
        $this->actionType = (int)$actionType;
    }

    public function process() {
        $hem = new ClassHEM();
        $hem->selectCandidates(self::SCHEDULES_COUNT);

        $mailList = $this->getMailList();
        $this->processMails($mailList);

        if ( ! empty($this->emailListSelected)) {
          $this->sendResultEmail();
        }
        return true;
    }

    private function processMails($mailList)
    {
        $erase = false;
        if ($this->actionType === 1) {
            foreach ($mailList as $mail) {
                $this->mailer = $this->createMailer();
                $toAddress = $mail;
                $mailType = 1;
                $mailTemplate = $this->getMailTemplate($mailType, $mail);
                $this->mailer->Sender = self::MAIL_FROM;
                $this->mailer->FromName = self::NAME_FROM;
                $this->mailer->From = self::MAIL_FROM;
                $this->mailer->Subject = self::SUBJECT_INVITE;
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
              $mailType = $this->getMailTypeFromAction($mail);
              $this->setEmailLists($mailType, $mail);
              $this->sortArray();
            }

            foreach ($mailList as $mail) {
                $this->mailer = $this->createMailer();
                $toAddress = $mail['email'];
                $mailType = $this->getMailTypeFromAction($mail);
                $mailTemplate = $this->getMailTemplate($mailType, $mail);
                $this->mailer->Sender = self::MAIL_FROM;
                $this->mailer->FromName = self::NAME_FROM;
                $this->mailer->From = self::MAIL_FROM;
                $this->mailer->Subject = self::SUBJECT_CONFIRMED;
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

    protected function getMailList ()
    {
        $dbConn = new dbConnection();
        $results = array();

        if ($this->actionType === 1) {
            $sql = "SELECT email FROM masaze_users WHERE active = 1;";
            $execution = $dbConn->getInstance()->executeQuery($sql);

            foreach ($execution as $result) {
                $results[] = $result['email'];
            }
        } else if ($this->actionType === 2) {
            $sql = 'SELECT u.email, a.elegible, s.time_schedules FROM masaze_users u inner join masaze_appointments a on
                (a.user_id = u.id) LEFT JOIN masaze_schedules AS s ON (a.id_schedule = s.id)';

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
      if (1 === $mailType) {
      	$pattern = "<<EMAILTO>>";
      	$patternUserName = "<<USERNAME>>";
      	$pos = strpos($mail, "@");
      	$userName = substr($mail, 0, $pos);
      	$template = str_replace($patternUserName, $userName, MailTemplates::retrieveMailTemplate($mailType));
      	$template2 = str_replace($pattern, $mail, $template);

      	return $template2;
      } else {
      	$pattern = "<<EMAILTO>>";
      	$patternUserName = "<<USERNAME>>";
      	$patternAppointment = "<<APPOINTMENT>>";
        $patternSchedule = "<<SCHEDULED>>";
      	$pos = strpos($mail['email'], "@");
      	$userName = substr($mail['email'], 0, $pos);
      	$template = str_replace($patternUserName, $userName, MailTemplates::retrieveMailTemplate($mailType));
        $template = str_replace($pattern, $mail['email'], $template);
        $template = str_replace($patternAppointment, $mail['time_schedules'], $template);

        $scheduled = "";
        foreach ($this->emailListSelected as $row) {
          $scheduled .= "<tr><td>" . $row['time_schedules'] . "</td><td>" . $row['email']  . "</td></tr>";
        }

        $template = str_replace($patternSchedule, $scheduled, $template);

      	return $template;
      }
    }

    private function getMailTypeFromAction($mail)
    {
        switch ($this->actionType) {
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

    private function setEmailLists($mailType, $mail) {
      if (2 === $mailType) {
        $this->emailListSelected[] = $mail;
      } elseif (3 === $mailType) {
        $this->emailListDiscarded[] = $mail;
      }
    }

    private function sendResultEmail() {
      $mailTemplate = "<b>Turnos asignados:</b><br/><br/";
      foreach ($this->emailListSelected as $selected) {
        $mailTemplate .= $selected['email'] . ' - ' . $selected['time_schedules'] . '<br/>';
      }
      $mailTemplate .= "<br/><b>Lista de espera:</b><br/><br/>";
      foreach ($this->emailListDiscarded as $discarded) {
        $mailTemplate .= $discarded['email'] . '<br/>';
      }

      $this->mailer = $this->createMailer();
      $toAddress = self::ADMIN_MAIL_TO;
      $this->mailer->Sender = self::MAIL_FROM;
      $this->mailer->FromName = self::NAME_FROM;
      $this->mailer->From = self::MAIL_FROM;
      $this->mailer->Subject = self::ADMIN_MAIL_SUBJECT;
      $this->mailer->Body = $mailTemplate;
      $this->mailer->AddAddress($toAddress, $toAddress);

      if ($this->mailer->Send()) {
          error_log("Mail sent to: "  . $toAddress . " - ok");
          $erase = true;
      } else {
          error_log("Error sending email to: " . $toAddress . " : " . $this->mailer->ErrorInfo);
      }
    }

    private function sortArray() {
      foreach ($this->emailListSelected as $key => $row) {
        $schedule[$key] = $row['time_schedules'];
      }
        array_multisort($schedule, SORT_ASC, $this->emailListSelected);
    }
}
