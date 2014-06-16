

<h2>Fish DB</h2>
This is a project created for the Fishackathon held at the Monterey Bay Aquarium. Our project addressed West Africa Regional Fisheries Program (WARFP) problem statement regarding the registering, licensing, and reporting of fishing vessels in West Africa. <br><br>
Fish DB allows fishermen to register and license their own boats via a mobile web interface or by using sms messaging. They can also anonymously report illegal fishing through the same interface. On the government side, we've created a web dashboard that aggregates the registration, licensing, and reporting requests that are created by fishermen. The dashboard gives a government official the ability to track, approve, and reject all of the incoming requests, eliminating the need to physically travel around the region to collect registration information.
<h3>Group Members</h3>
Kate Rushton<br>
Isha Dandavate<br>
Dan Tsai<br>
Jenton Lee<br>
<h3>Technologies Used</h3>
<ul><li>Ruby on Rails</li><li>HTML/JS/CSS</li><li>PHP</li><li>Twilio</li></ul>
<h3>SMS Functionality</h3>
To implement the sms functionality, we leveraged the Twilio API and write a PHP script to automate responses and store variables to send to our database. The script we created can be found in the 'sms_stuff' folder, under 'text.php'
