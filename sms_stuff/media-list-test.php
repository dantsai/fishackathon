<?php
// Get the PHP helper library from twilio.com/docs/php/install
require_once('Services/Twilio.php'); // Loads the library
 
// Your Account Sid and Auth Token from twilio.com/user/account
$sid = "ACff9f06e3e77389c8c7252a4250ec5136"; 
$token = "{{ 86350b0c021ec3e4ae05fa68b4b099b6 }}"; 
$client = new Services_Twilio($sid, $token);
 
// Loop over the list of medias and echo a property for each one
foreach ($client->account->messages->get('MM800f449d0399ed014aae2bcc0cc2f2ec')->media as $media) {
    echo $media->content_type;
}