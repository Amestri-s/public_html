<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'require/mail/src/Exception.php';
    require 'require/mail/src/PHPMailer.php';
    require 'require/mail/src/SMTP.php';

    $mail = new PHPMailer(true);


    $title = "Main application";

    require "require/head.php";

    if(!(isset($_SESSION["loggedin"])) && !($_SESSION["loggedin"] == true)){

        header("location: /scfr/auth/");

        exit;

    } else {

        $scfrApps = mysqli_query($link, 'SELECT id, outcome, outcomeFeedback, createdAt FROM scfrapps WHERE username = "'. $_SESSION['username'].'"');

        $eligible = 0;



        while($res = mysqli_fetch_array($scfrApps)) {

            if ($res['outcome'] == "Denied") {$eligible = 1;} else {$eligible = 0;};

        }

        

        $sfrAppCount = mysqli_num_rows($scfrApps);



        if ($sfrAppCount < 1) {

            $eligible = 1;

        }



        if ($eligible < 1) {

            header("location: /scfr/dashboard.php"); 

        }

    }



    $username = $discordUsername = $robloxProfileLink = $civName = $age = $haveMic = $timeZone = $whyBePart = $experience = $anythingShouldKnow = $readGuidelines = $readApp = $oldEnough = "";



    if($_SERVER["REQUEST_METHOD"] == "POST"){



        //Setup all the values

        $username = $_SESSION['username'];

        $discordUsername = trim($_POST["discordUsername"]);

        $email = trim($_POST['email']);

        $robloxProfileLink = trim($_POST["profileLink"]);

        $civName = trim($_POST["civName"]);

        $age = trim($_POST["age"]);



        if(isset($_POST["hasMic"]) == null) {

            $haveMic = 0;

        } else {

            $haveMic = trim($_POST["hasMic"]);

        }



        $timeZone = trim($_POST["timeZone"]);

        $whyBePart = trim($_POST["whyJoin"]);

        $experience = trim($_POST["experience"]);

        $anythingShouldKnow = trim($_POST["anythingShouldKnow"]);



        if(isset($_POST["readGuidelines"]) == null) {

            $readGuidelines = 0;

        } else {

            $readGuidelines = trim($_POST["readGuidelines"]);

        }



        if(isset($_POST["readApp"]) == null) {

            $readApp = 0;

        } else {

            $readApp = trim($_POST["readApp"]);

        }



        if(isset($_POST["oldEnough"]) == null) {

            $oldEnough = 0;

        } else {

            $oldEnough = trim($_POST["oldEnough"]);

        }



        $sql = "INSERT INTO scfrapps (username, email, discordUsername, robloxProfileLink, civName, age, doHaveMic, timeZone, whyBePart, experience, anythingWannaKnow, readGuidelines, readApp, oldEnough) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";



        if($stmt = mysqli_prepare($link, $sql)){

            // Bind variables to the prepared statement as parameters

            mysqli_stmt_bind_param($stmt, "sssssiissssiii", $username, $email, $discordUsername, $robloxProfileLink, $civName, $age, $haveMic, $timeZone, $whyBePart, $experience, $anythingShouldKnow, $readGuidelines, $readApp, $oldEnough);

                        

            // Attempt to execute the prepared statement

            if(mysqli_stmt_execute($stmt)){

                // Redirect to dashboard

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
                    $mail->addAddress($email);
                
                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = 'Application confirmation';
                    $mail->Body    = '<b>Hello, '.$username.'.</b> <br><br>  Your application has been sent off and should be read in around 1-3 days. Sometimes even less. You will recieve another email with your outcome after the application has been reviewed and this can also be viewed on your dashboard.<br><br>If you have any questions, contact a member of command.';
                    $mail->AltBody = 'Your application has been sent off and should be read in around 1-3 days. Sometimes even less. You will recieve another email with your outcome after the application has been reviewed and this can also be viewed on your dashboard.';
                
                    $mail->send();
                    echo 'Message has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }

            } else{

                echo "Something went wrong. Please try again later.";

            }

            $webhook_url = "https://discordapp.com/api/webhooks/743916683328094279/bISGeMUy6WB91VJLpedMB_DbblD4hYOUHhZAzKJrQIC7HOMYE84M765qGVFlh5cFMwsJ";
            $timestamp = date("c", strtotime("now"));

            $json_data = json_encode([

                    "username" => "SCFR",

                    "avatar_url" => "https://scfr.site/img/logo.png",

                    "embeds" => [
                        [
                            "title" => "Application",

                            "type" => "rich",

                            "description" => $_SESSION['username']." just created an application. You can view the full details of the app or accept it by logging in to your account at the SCFR site.",

                            "url" => "https://scfr.site/scfr",

                            "timestamp" => $timestamp,

                            "color" => hexdec("#ff0000"),

                            "footer" => [
                                "text" => "SCFR",
                            ],

                            "fields" => [
                                [
                                    "name" => "Username",
                                    "value" => $username,
                                    "inline" => false
                                ],
                                [
                                    "name" => "Discord username",
                                    "value" => $discordUsername,
                                    "inline" => false
                                ],
                                [
                                    "name" => "Age",
                                    "value" => $age,
                                    "inline" => false
                                ],
                                [
                                    "name" => "Why do you want to join SCFR?",
                                    "value" => $whyBePart,
                                    "inline" => false
                                ],
                                [
                                    "name" => "What experience do you have?",
                                    "value" => $experience,
                                    "inline" => false
                                ],
                                ],
                                [
                                    "name" => "Anything else we should know?",
                                    "value" => $anythingShouldKnow,
                                    "inline" => false
                                ]
                            ]
                        ]

                ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

                $ch = curl_init($webhook_url);
                curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
                curl_setopt( $ch, CURLOPT_POST, 1);
                curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
                curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt( $ch, CURLOPT_HEADER, 0);
                curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

                $response = curl_exec( $ch );
                curl_close( $ch );

            header("location: /scfr/dashboard.php");

            
            // Close statement

        }



    }

?>



<form class="border border-light p-5 m-5" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">



    <p class="h4 mb-4 text-center">SCFR Application</p>





    <label for="discordUsername">What is your Discord username?</label>

    <input type="text" id="discordUsername" class="form-control mb-4" placeholder="Amestris#8094" name="discordUsername" required>


    <label for="email">What is your email? Your results will be sent here.</label>

    <input type="email" id="email" class="form-control mb-4" placeholder="email@example.com" name="email" required>



    <label for="textInput">Please link your Roblox profile.</label>

    <input type="text" id="textInput" class="form-control mb-4" placeholder="https://www.roblox.com/users/335027300/profile" name="profileLink" required>



    <label for="civName">What is your civilian name? This is who you wish to identify as when on team.</label>

    <input type="text" id="civName" class="form-control mb-4" placeholder="Ben Barns" name="civName" required>



    <label for="age">How old are you?</label>

    <input type="number" id="age" class="form-control mb-4" placeholder="13+" name="age" required>



    <div class="custom-control custom-checkbox mb-4">

        <input type="checkbox" class="custom-control-input" id="hasMic" name="hasMic" value="1">

        <label class="custom-control-label" for="hasMic">Tick, if you have a mic.</label>

    </div>



    <label for="timeZone">What is your timezone?</label>

    <input type="text" id="timeZone" class="form-control mb-4" placeholder="EDT" name="timeZone" required>



    <label for="whyJoin">Why do you want to join SCFR? Detail required. (3-5 sentences reccomended)</label>

    <textarea id="whyJoin" class="form-control mb-4" placeholder="Response that contains 3-5 sentences." name="whyJoin" required></textarea>



    <label for="experience">What experience, if any, do you have?</label>

    <textarea id="experience" class="form-control mb-4" placeholder="Response that contains details of experience in the field." name="experience" required></textarea>



    <label for="anythingShouldKnow">Is there anything we should know before reading your application?</label>

    <textarea id="anythingShouldKnow" class="form-control mb-4" placeholder="Response containing information about self." name="anythingShouldKnow"></textarea>



    <div class="custom-control custom-checkbox mb-4">

        <input type="checkbox" class="custom-control-input" id="readGuidelines" value="1" name="readGuidelines" required>

        <label class="custom-control-label" for="readGuidelines">Tick, if you have read and agree with our and SCRP's guidelines.</label>

    </div>



    <div class="custom-control custom-checkbox mb-4">

        <input type="checkbox" class="custom-control-input" id="readApp" value="1" name="readApp" required>

        <label class="custom-control-label" for="readApp">Tick, if you have read and confirmed that everything you put in this application is accurate and correct.</label>

    </div>



    <div class="custom-control custom-checkbox mb-4">

        <input type="checkbox" class="custom-control-input" id="oldEnough" name="oldEnough" value="1">

        <label class="custom-control-label" for="oldEnough">Tick, if you are 13+.</label>

    </div>



    <button class="btn btn-danger btn-block" type="submit">Send</button>

</form>



<?php

    require "require/footer.php";

?>