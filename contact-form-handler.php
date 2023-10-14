<?php 
    $name = $_POST['name'];
    $visitor_email = $_POST['email'];
    $subject_ofVisitor = $_POST['valueSub'];
    $message = $_POST['message'];
    
    // $email_from = 'ecell@viit.ac.in';

    $email_subject = 'New Contact-Form Submission on Blog';


    $email_body = "User Name: $name.\n".
                    "User Email: $visitor_email.\n".
                      "Subject: $subject_ofVisitor.   (1: Sponsers/Partners 2:Industry Collab 3:Feedback 4:Others)\n".
                        "Message: $message.\n";

    $to = "rupesh.kapse.30@gmail.com";

    $headers = "From: $email_form \r\n";

    $headers = "Reply-To: $visitor_email \r\n";

    mail($to,$email_subject,$email_body,$headers);

    header("Location: contact-us.html");
?>