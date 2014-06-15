<?php


	/* Send an SMS using Twilio. You can run this file 3 different ways:
	 *
	 * - Save it as sendnotifications.php and at the command line, run 
	 *        php sendnotifications.php
	 *
	 * - Upload it to a web host and load mywebhost.com/sendnotifications.php 
	 *   in a web browser.
	 * - Download a local server like WAMP, MAMP or XAMPP. Point the web root 
	 *   directory to the folder containing this file, and load 
	 *   localhost:8888/sendnotifications.php in a web browser.
	 */

	// Step 1: Download the Twilio-PHP library from twilio.com/docs/libraries, 
	// and move it into the folder containing this file.
	require "Services/Twilio.php";
	//require "sms-reply.php";


	// Step 2: set our AccountSid and AuthToken from www.twilio.com/user/account
	$AccountSid = "ACff9f06e3e77389c8c7252a4250ec5136";
	$AuthToken = "86350b0c021ec3e4ae05fa68b4b099b6";

	// Step 3: instantiate a new Twilio Rest Client
	$client = new Services_Twilio($AccountSid, $AuthToken);

	// Step 4: make an array of people we know, to send them a message. 
	// Feel free to change/add your own phone number and name here.
	$people = array(
		"+14075368665" => "Jenton Lee",
		"+16149469900" => "Isha Dandavate",
		"+13104655587" => "Dan Tsai",
	);

	// Step 5: Loop over all our friends. $number is a phone number above, and 
	// $name is the name next to it
	foreach ($people as $number => $name) {

		$sms = $client->account->messages->sendMessage(

		// Step 6: Change the 'From' number below to be a valid Twilio number 
		// that you've purchased, or the (deprecated) Sandbox number
			"510-447-1114",

			// the number we are sending to - Any phone number
			$number,

			// the sms body
			"Hey $name, reply to this message!"
 
 			// Step 7: Add a url to the image media you want to send
        	array("https://demo.twilio.com/owl.png", "https://demo.twilio.com/logo.png")
    	);

		// Display a confirmation message on the screen
		echo "Sent message to $name";
	}
