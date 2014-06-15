<?php
 
    // start the session
    session_start();
 
    // get the session varible if it exists
    $counter = $_SESSION['counter'];
 
    // if it doesnt, set the default
    if(!strlen($counter)) {
        $counter = 0;
    }
 
    // increment it
    $counter++;
 
    // save it
    $_SESSION['counter'] = $counter;

    // make an associative array of senders we know, indexed by phone number
    $people = array(
        "+14075368665" => "Jenton Lee",
        "+16149469900" => "Isha Dandavate",
        "+13104655587" => "Dan Tsai",
    );
 
    // if the sender is known, then greet them by name
    // otherwise, consider them just another monkey
    if(!$name = $people[$_REQUEST['From']]) {
        $name = "Monkey";
    }


    //If 'reset' is typed into the body, reset the cookie

    if($_REQUEST['Body'] == 'Reset'){
        //clearing the cookie. Reset for debugging purposes
        $_SESSION['regID'] = 0;
        $_SESSION['action'] = 0;
        $_SESSION['name'] = 0;
        $_SESSION['address'] = 0;
        $_SESSION['comment'] = 0;
        $_SESSION['boatLocation'] = 0;
        $_SESSION['boatLength'] = 0;
        $_SESSION['boatName'] = 0;
        $_SESSION['location'] = 0;
        $_SESSION['boatEngine'] = 0;


        // now greet the sender
        header("content-type: text/xml");
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        ?>
        <Response>
            <Message>Cookies have been reset!</Message>
        <!--<MediaUrl>https://demo.twilio.com/owl.png</MediaUrl>-->
        </Response>
    <?php }

//The Report Flow//

    //Capturing additional comment (last step in report flow)
    if ($_SESSION['comment'] == 1 && $_SESSION['action'] == 'report') {
        
        //grab the additional comment
        $comment = $_REQUEST['Body'];
        
        //callback cookie variables
        $regID = $_SESSION['regID'];
        $location = $_SESSION['location'];
        $comment = $_SESSION['comment'];
        $phoneNumber = $_REQUEST['From'];   

        //save it to the session cookie
        $_SESSION['location'] = $location;  

        //Post collected information to a url query string
        $url = 'http://fishackathon.herokuapp.com/report/textpost';
        $data = array('regID' => "$regID", 'location' => "$location", 'comment' => "$comment");
        $url = $url . '?' . http_build_query($data);
        $result = file_get_contents($url);

        //trying another way to send confirmation text
        require "Services/Twilio.php";
        $AccountSid = "ACff9f06e3e77389c8c7252a4250ec5136";
        $AuthToken = "86350b0c021ec3e4ae05fa68b4b099b6";
        $client = new Services_Twilio($AccountSid, $AuthToken);
        $sms = $client->account->messages->sendMessage("510-447-1114",$phoneNumber,"Thank you for reporting this boat.");


        //clearing the cookie
        $_SESSION['regID'] = 0;
        $_SESSION['action'] = 0;
        $_SESSION['location'] = 0;
        $_SESSION['comment'] = 0;

    }

    //Prompt for additional comment, capture location
    else if ($_SESSION['location'] == 1 && $_SESSION['action'] == 'report') {

        //get the location information
        $location = $_REQUEST['Body'];

        //save it to the session cookie
        $_SESSION['location'] = $location;

        //create a flag variable for the comment
        $_SESSION['comment'] = 1;    

        // now greet the sender
        header("content-type: text/xml");
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        ?>
        <Response>
            <Message>Please provide any additional comments regarding what the boat is doing wrong.</Message>
        </Response>
    <?php }

    //Prompt for location, capture Reg ID
    else if ($_SESSION['regID'] == 1 && $_SESSION['action'] == 'report') {
        
        //grab the registration ID of the boat, and other variables from the cookie
        $regID = $_REQUEST['Body'];

        //save it to the session cookie
        $_SESSION['regID'] = $regID;

        //create a flag variable for the location
        $_SESSION['location'] = 1;    

        // now greet the sender
        header("content-type: text/xml");
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        ?>
        <Response>
            <Message>Please provide the location where you saw the boat.</Message>
        </Response>
    <?php }

    else if($_REQUEST['Body'] == '1') { 
        
        //need to store date, time, status, phone number, photo to the database
        // HOW TO STORE AN PHOTO THAT'S SENT FROM FISHERMAN?!


        //get the action variable if it exists
        $action = 'report';
        $_SESSION['action'] = $action;

        //create a variable for the regID
        $_SESSION['regID'] = 1;
        
        // now greet the sender
        header("content-type: text/xml");
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        ?>
        <Response>
            <Message>Please provide the ID number of the boat you are reporting.</Message>
        </Response>
    <?php }

//Logic for Register flow
    //capture boat name and finish.
    else if($_SESSION['boatName'] == 1 && $_SESSION['action'] == 'register') {

        //set the body to a boat name variable
        $boatName = $_REQUEST['Body'];

        $_SESSION['boatName'] = $boatName;

        //callback cookie variables
        $name = $_SESSION['name'];
        $address = $_SESSION['address'];
        $boatLocation = $_SESSION['boatLocation'];
        $boatLength = $_SESSION['boatLength'];
        $boatName = $_SESSION['boatName'];
        $phoneNumber = $_REQUEST['From'];   
        $boatEngine = $_SESSION['boatEngine'];  
        
        //generate a registration ID
        $regID = 4126;

    //Post collected information to a url query string
        $url = 'http://fishackathon.herokuapp.com/registration/textpost';
        $data = array('name' => $name, 'address' => $address, 'boatLocation' => $boatLocation, 'boatLength' => $boatLength, 'boatName' => $boatName, 'phoneNumber' => $phoneNumber, 'regID' => $regID);
        $url = $url . '?' . http_build_query($data);
        $result = file_get_contents($url);

        //trying another way to send confirmation text
        require "Services/Twilio.php";
        $AccountSid = "ACff9f06e3e77389c8c7252a4250ec5136";
        $AuthToken = "86350b0c021ec3e4ae05fa68b4b099b6";
        $client = new Services_Twilio($AccountSid, $AuthToken);
        $sms = $client->account->messages->sendMessage("510-447-1114",$phoneNumber,"Thank you for registering. Please paint this number, $regID, on your canoe and take a picture of it.\nName: $name \nAddress: $address \nBoat Location: $boatLocation \nBoat Length: $boatLength \nHas Engine?: $boatEngine \nBoat Name: $boatName \nPhone Number: $phoneNumber");

    //clearing the cookie
    $_SESSION['action'] = 0;
    $_SESSION['name'] = 0;
    $_SESSION['address'] = 0;
    $_SESSION['boatLocation'] = 0;
    $_SESSION['boatLength'] = 0;
    $_SESSION['boatName'] = 0;
    $_SESSION['location'] = 0;
    $_SESSION['boatEngine'] = 0;

    }

    //prompt boat name, capture boat engine question
    else if($_SESSION['boatEngine'] == 1 && $_SESSION['action'] == 'register') {

        //set the body to a boat engine variable
        $boatEngine = $_REQUEST['Body'];

        //set boat engine into the session cookie
        $_SESSION['boatEngine'] = $boatEngine;
        
        //create a flag variable for the boat name
        $_SESSION['boatName'] = 1;

        // now send the message
        header("content-type: text/xml");
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        ?>
        <Response>
            <Message>Please reply with the name of your boat.</Message>
        </Response>
    <?php }

    //prompt engine question, capture boat length
    else if($_SESSION['boatLength'] == 1 && $_SESSION['action'] == 'register') {

        //set the body to a boat length variable
        $boatLength = $_REQUEST['Body'];

        //set boat length into the session cookie
        $_SESSION['boatLength'] = $boatLength;

        //create a flag variable for the boat type
        $_SESSION['boatEngine'] = 1;

        // now send the message
        header("content-type: text/xml");
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        ?>
        <Response>
            <Message>Does your boat have an engine? (Yes or No)</Message>
        </Response>
    <?php }

    //prompt boat length, capture boat location
    else if($_SESSION['boatLocation'] == 1 && $_SESSION['action'] == 'register') {

        //set the body to a boat location variable
        $boatLocation = $_REQUEST['Body'];

        //set boat location into the session cookie
        $_SESSION['boatLocation'] = $boatLocation;

        //create a flag variable for the boat type
        $_SESSION['boatLength'] = 1;

        // now send the message
        header("content-type: text/xml");
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        ?>
        <Response>
            <Message>How long is your boat? (in meters)</Message>
        <!--<MediaUrl>https://demo.twilio.com/owl.png</MediaUrl>-->
        </Response>
    <?php }

    //prompt boat location step and capture address
    else if($_SESSION['address'] == 1 && $_SESSION['action'] == 'register') {

        //set the body to an address variable
        $address = $_REQUEST['Body'];

        //set address into the session cookie
        $_SESSION['address'] = $address;

        //create a flag variable for the boat location
        $_SESSION['boatLocation'] = 1;

        // now send the message
        header("content-type: text/xml");
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        ?>
        <Response>
            <Message>Please reply with the location of your boat.</Message>
        <!--<MediaUrl>https://demo.twilio.com/owl.png</MediaUrl>-->
        </Response>
    <?php }

 //prompt for address step, and capture name
    else if($_SESSION['name'] == 1 && $_SESSION['action'] == 'register') {    

        $name = $_REQUEST['Body'];

        //Save it
        $_SESSION['name'] = $name;

        //create a flag variable for the address
        $_SESSION['address'] = 1;
        
        // now greet the sender
        header("content-type: text/xml");
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        ?>
        <Response>
            <Message>Please reply back with your address.</Message>
        <!--<MediaUrl>https://demo.twilio.com/owl.png</MediaUrl>-->
        </Response>
    <?php }

    //prompt for name step, and capture action
    else if($_REQUEST['Body'] == '2') {    

        $action = 'register';

        //Save it to cookie
        $_SESSION['action'] = $action;

        //create a flag variable for the name
        $_SESSION['name'] = 1;
        
        // now greet the sender
        header("content-type: text/xml");
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        ?>
        <Response>
            <Message>Please reply back with your name.</Message>
        </Response>
    <?php }

    else {

    // now greet the sender
    header("content-type: text/xml, image/png");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>    
    <Message><Body>What do you want to do?
    1 for Report
    2 for Register</Body>    
    </Message>
</Response>

<?php } ?>