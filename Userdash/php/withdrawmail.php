<?php
$from= "no-reply@goldtradefx.com";
$to="contact@goldtradefx.com";

$subject="Withdraw request";
$message="Someone sent a withdraw request on the site. Review it here: https://www.goldtradefx.com/admin/withdrawlist.php
    Take a brief look:
    Name: $card_holder
    Abount: $amount
    Timestamp: $reqcreate_datetime 


";



$headers="From:" . $from;



$retval = mail ($to,$subject,$message,$headers);

if( $retval == false ) {
    echo "Message could not be sent...";
    }else {
    }
?>