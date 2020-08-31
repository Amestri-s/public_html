<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'require/mail/src/Exception.php';
    require 'require/mail/src/PHPMailer.php';
    require 'require/mail/src/SMTP.php';

    $mail = new PHPMailer(true);

    $title = "Action page for panels";

    require "require/head.php";



    $id = $_GET['id'];

    $action = $_GET['action'];

    $ret = $_GET['ret'];



    if(isset($ret)) {

        if($ret == "admin") {

            if(!(isset($_SESSION['perm'])) || !($_SESSION['perm'] >= 4)) {

                header('Location: /scfr/auth/');

                exit;

            }

        }else if ($ret == "mod") {

            if(!(isset($_SESSION['perm'])) || !($_SESSION['perm'] >= 3)) {

                header('Location: /scfr/auth/');

                exit;

            }

        }else {

            header('Location: /scfr/');

        }

    }else {

        header('Location: /scfr/');

    }



    if (isset($action)) {

        if($action == "del"){

            $result = mysqli_query($link, "DELETE FROM members WHERE id=$id");



            header('Location: /scfr/'.$ret.'.php');

        }else if($action == "prom") {

            $perm = mysqli_query($link, 'SELECT perm FROM members WHERE id = "'. $id.'"');

            $permres = mysqli_fetch_array($perm);



            if($permres['perm'] >= 4) {

                $promPerm = 4;

            }else {

                $promPerm = $permres['perm'] + 1;

            }



            $promSQL = 'UPDATE members

            SET perm='.$promPerm.'

            WHERE id='.$id;



            $result = mysqli_query($link, $promSQL);



            header('Location: /scfr/'.$ret.'.php');

        }else if($action == "dem") {

            $perm = mysqli_query($link, 'SELECT perm FROM members WHERE id = "'. $id.'"');

            $permres = mysqli_fetch_array($perm);



            if($permres['perm'] <= 0) {

                $demPerm = 0;

            }else {

                $demPerm = $permres['perm'] - 1;

            }



            $demSQL = 'UPDATE members

            SET perm='.$demPerm.'

            WHERE id='.$id;



            $result = mysqli_query($link, $demSQL);



            header('Location: /scfr/'.$ret.'.php');            

        }else if($action == "accept") {

            $app = mysqli_query($link, 'SELECT * FROM scfrapps WHERE id = "'.$id.'"');
            $res = mysqli_fetch_array($app);

            $acceptSQLOutcome = 'UPDATE scfrapps

            SET outcome= "Accepted"

            WHERE id='.$id;


            $acceptSQLFeedback = 'UPDATE scfrapps

            SET outcomeFeedback= "You were accepted! You must do the following next steps. 1) Join the Discord for SCFR at https://discord.gg/Vsu8njk. 2) Join the Roblox group at https://www.roblox.com/groups/5135713/SC-SCFR. 3) Read the operating procedures at https://docs.google.com/document/d/1DmAMd9oek-BlAX-SEW9FH8RvKSI8Ko-PW4B0tPp4hmk/edit?usp=sharing."

            WHERE id='.$id;

            $result = mysqli_query($link, $acceptSQLOutcome);
            $result = mysqli_query($link, $acceptSQLFeedback);

            try {
                //Server settings
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'mail.scfr.site';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'admin@scfr.site';                     // SMTP username
                $mail->Password   = 'Sinbad1825';                               // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            
                //Recipients
                $mail->setFrom('admin@scfr.site', 'SCFR Apps');
                $mail->addAddress($res['email']);
            
                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Application results';
                $mail->Body    = '<b>Hello, '.$res['username'].'.</b> <br><br>  Your application has been accepted. You now have a few more steps that need completing. These include:<br><ul type="circle"><li>Joining the Discord for SCFR located <a href="https://discord.gg/Vsu8njk">here</a></li><li>Joining the Roblox group located <a href="https://www.roblox.com/groups/5135713/SC-SCFR">here</a></li></ul><br>If you have any more questions, contact a member of command.';
                $mail->AltBody = 'Your application has been accepted. Please check our tracker for more details on the next steps to undertake.';
            
                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

            header('Location: /scfr/'.$ret.'.php'); 

        }else if($action == "deny") {

            $app = mysqli_query($link, 'SELECT * FROM scfrapps WHERE id = "'.$id.'"');
            $res = mysqli_fetch_array($app);

            $acceptSQLOutcome = 'UPDATE scfrapps

            SET outcome= "Denied"

            WHERE id='.$id;


            $acceptSQLFeedback = 'UPDATE scfrapps

            SET outcomeFeedback= "You were denied. Feel free to try again. Some common errors include incorrect details and lack of detail."

            WHERE id='.$id;

            $result = mysqli_query($link, $acceptSQLOutcome);
            $result = mysqli_query($link, $acceptSQLFeedback);

            try {
                //Server settings
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'mail.scfr.site';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'admin@scfr.site';                     // SMTP username
                $mail->Password   = 'Sinbad1825';                               // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            
                //Recipients
                $mail->setFrom('admin@scfr.site', 'SCFR Apps');
                $mail->addAddress($res['email']);
            
                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Application results';
                $mail->Body    = '<b>Hello, '.$res['username'].'.</b> <br><br><p>Unfortunately, your application has been denied. This is usually due to lack of detail or incorrect details provided. You can always try again by going back to our site and clicking the new application button on your dashboard.<br>If you have any more questions, contact a member of command.</p>';
                $mail->AltBody = 'Unfortunately, your application has been denied. You can always try again by going back to our site and clicking the new application button on your dashboard.';
            
                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }


            header('Location: /scfr/'.$ret.'.php');   
        }
    }else if($action == "deletenotice"){

        $result = mysqli_query($link, "DELETE FROM notices WHERE id=$id");



        header('Location: /scfr/'.$ret.'.php');

    }else if($action == "deleteresource"){

        $result = mysqli_query($link, "DELETE FROM resources WHERE id=$id");



        header('Location: /scfr/'.$ret.'.php');

    }else{

        header('Location: /scfr/');

    }

?>