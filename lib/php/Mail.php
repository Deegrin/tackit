<?php

require_once '../swift/swift_required.php';
require_once 'Database.php';
require_once 'User.php';

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
        //get verification token
        $token = self::getToken();
        $link = '' . $token;

        //insert token into database
        $db = new Database();
        $userId = $db->real_escape_string($user->get_id());

        if ($db->doQuery("INSERT INTO `tackit`.`authorization` (user_id, token, creation_time, expiration_time) VALUES
            ($userId, '$token', CURRENT_TIMESTAMP, TIMESTAMPADD(DAY, 1, CURRENT_TIMESTAMP))") !== FALSE) {
            //send confirmation/verification email to user
            $mailer = self::getMailer();

            $message = Swift_Message::newInstance("Verify Registration");
            $message->setFrom("tackit165@gmail.com");
            $message->setTo($user->get_email());
            $message->setBody("<p>Hi " . $user->get_username() . ",</p><p>Thanks for creating a Tackit account. Please verify your account by clicking the following link:</p><p><a href=\"$link\">$link</a></p>", "text/html");
            $message->addPart("Hi " . $user->get_username() . ",\n\nThanks for creating a Tackit account. Please verify your account by clicking the following link:\n\n$link", "text/plain");

            if ($mailer->send($message) > 0)
                return true;
            else
                return false;
        } else
            return false;
    }

    public static function getToken() {
        return vsprintf("%s", bin2hex(openssl_random_pseudo_bytes(16)));
    }
}
?>