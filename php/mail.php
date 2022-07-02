<?php
$from= "no-reply@goldtradefx.com";
$to="contact@goldtradefx.com";

$subject="New reachout request";
$message="Someone sent a reachout request on the site. Review it here: https://www.goldtradefx.com/admin/reachoutreq.php
    brief review:
    Contact name: $contact_name
    Contact phone: $contact_phone

";



$headers="From:" . $from;



$retval = mail ($to,$subject,$message,$headers);

if( $retval == true ) {
        header("Location: ../index.php");
    }else {
    echo "Message could not be sent...";
    }
?>