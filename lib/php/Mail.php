<?php

require_once 'Database.php';
require_once '../swift/swift_required.php';

/**
 * Interface to Swift Mailer PHP library.
 *
 * @author David
 */
class Mail {

    const SERVER_NAME = "smtp.gmail.com";
    const SERVER_PORT = 587;
    const SERVER_ENCRYPTION = "tls";
    const SERVER_USERNAME = "tackit165";
    const SERVER_PASSWORD = "sjsusoftware";

    private static function getSmtpTransport() {
        $transport = Swift_SmtpTransport::newInstance(self::SERVER_NAME, self::SERVER_PORT);
        $transport->setUsername(self::SERVER_USERNAME);
        $transport->setPassword(self::SERVER_PASSWORD);
        $transport->setEncryption(self::SERVER_ENCRYPTION);

        return $transport;
    }

    private static function getMailer($transport = NULL) {
        if ($transport === NULL)
            $transport = self::getSmtpTransport();

        return Swift_Mailer::newInstance($transport);
    }

    public static function verifyRegistration($user) {
        //insert token into database
        $db = new Database();
        $userId = $db->real_escape_string($user->get_id());

        $db->doQuery("INSERT INTO `tackit`.`authorization` (user_id, token, creation_time, expiration_time) VALUES
            ($userId, " . self::getToken() . ", CURRENT_TIMESTAMP, TIMESTAMPADD(DAY, 1, CURRENT_TIMESTAMP))"); //1 day
        //send confirmation/verification email to user
        $mailer = self::getMailer();

        $message = Swift_Message::newInstance("Verify Registration");
        $message->setFrom("tackit165@gmail.com");
        $message->setTo("davidng0123@live.com");
        $message->setBody("Cake.");

        $mailer->send($message);
    }

    public static function getToken() {
        return openssl_random_pseudo_bytes(16);
    }
}
?>