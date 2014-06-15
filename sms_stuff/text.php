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
        $_SESSION['boatLocation'] = 0;
        $_SESSION['boatType'] = 0;
        $_SESSION['boatName'] = 0;
        $_SESSION['location'] = 0;

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

    //NEED TO FIGURE OUT HOW TO ACCEPT PICTURES!

    //Capturing additional comment (last step in report flow)
    if ($_SESSION['comment'] == 1 && $_SESSION['action'] == 'report') {
        
        //grab the additional comment
        $comment = $_REQUEST['Body'];
        
        //callback cookie variables
        $regID = $_SESSION['regID'];
        $location = $_SESSION['location'];
        $comment = $_SESSION['comment'];
        //$photoURL = $SESSION['photoURL']; //photos are not supported yet

        //save it to the session cookie
        $_SESSION['location'] = $location;  

    //Post collected information to a url query string
/*        $url = 'http://server.com/path';
        $data = array('regID' => $regID, 'location' => $location, 'comment' => $comment);

        // use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data),
            ),
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        var_dump($result);*/

        // now greet the sender
        header("content-type: text/xml");
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        ?>
        <Response>
            <Message><?php echo "RegID: " . $regID ?>. Thank you for reporting this boat.</Message>
        <!--<MediaUrl>https://demo.twilio.com/owl.png</MediaUrl>-->
        </Response>

    <?php 
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
        <!--<MediaUrl>https://demo.twilio.com/owl.png</MediaUrl>-->
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
        <!--<MediaUrl>https://demo.twilio.com/owl.png</MediaUrl>-->
        </Response>
    <?php }

    else if($_REQUEST['Body'] == '1' && $_SESSION['boatType'] == 0) { 
        
        //need to store date, time, status, phone number, photo to the database
        // HOW TO STORE AN PHOTO THAT'S SENT FROM FISHERMAN?!


        //get the action variable if it exists
        $action = $_SESSION['action'];

        //if it doesn't, set it as 'report'
        if(!strlen($action)) {
            $action = 'report';

            //Save it
            $_SESSION['action'] = $action;
        }

        //create a variable for the regID
        $_SESSION['regID'] = 1;
        //$uri = $_REQUEST['Uri'];
        
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
        $boatType = $_SESSION['boatType'];
        $boatName = $_SESSION['boatName'];
        $phoneNumber = $_REQUEST['From'];     
        

        //generate a registration ID
        $regID = 123456;

    //Post collected information to a url query string
/*        $url = 'http://server.com/path';
        $data = array('name' => $name, 'address' => $address, 'boatLocation' => $boatLocation, 'boatType' => $boatType, 'boatName' => $boatName, 'phoneNumber' => $phoneNumber, 'regID' => $regID);

        // use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data),
            ),
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        var_dump($result);*/

    //now send the message
        header("content-type: text/xml");
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        ?>
        <Response>
            <Message>
                <Body>Thank you for registering. Please paint this number, <?php echo $regID ?>, on your canoe and take a picture of it to look like this.
                <?php echo "\nName: " . $name . "\nAddress: " . $address . "\nBoat Location: " . $boatLocation . "\nBoat Type: " . $boatType . "\nBoat Name: " . $boatName . "\nPhone Number: " . $phoneNumber ?></Body>
                <!--<Media>https://demo.twilio.com/owl.png</Media>-->
            </Message>
        </Response>


    <?php 
    //clearing the cookie
    $_SESSION['action'] = 0;
    $_SESSION['name'] = 0;
    $_SESSION['address'] = 0;
    $_SESSION['boatLocation'] = 0;
    $_SESSION['boatType'] = 0;
    $_SESSION['boatName'] = 0;
    $_SESSION['location'] = 0;

    }

    //prompt boat name, capture boat type
    else if($_SESSION['boatType'] == 1 && $_SESSION['action'] == 'register') {

        //set the body to a boat type variable
        $boatType = $_REQUEST['Body'];

        //adding the boat type to the session cookie. Need to replace Boat Type A with the actual boat types
        if($boatType == 1){
            //set boat type into the session cookie
            $_SESSION['boatType'] = 'Boat Type A';    
        }
        else if($boatType == 2){
            //set boat type into session cookie
            $_SESSION['boatType'] = 'Boat Type B';    
        }
        else if($boatType == 3){
            //set boat type into session cookie
            $_SESSION['boatType'] = 'Boat Type C';    
        }

        //NOTE: don't have anything to respond to an incorrect response!        
        
        //create a flag variable for the boat name
        $_SESSION['boatName'] = 1;

        // now send the message
        header("content-type: text/xml");
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        ?>
        <Response>
            <Message>Please reply with the name of your boat.</Message>
        <!--<MediaUrl>https://demo.twilio.com/owl.png</MediaUrl>-->
        </Response>
    <?php }

    //prompt boat type step, capture boat location
    else if($_SESSION['boatLocation'] == 1 && $_SESSION['action'] == 'register') {

        //set the body to a boat location variable
        $boatLocation = $_REQUEST['Body'];

        //set boat location into the session cookie
        $_SESSION['boatLocation'] = $boatLocation;

        //create a flag variable for the boat type
        $_SESSION['boatType'] = 1;

        // now send the message
        header("content-type: text/xml");
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        ?>
        <Response>
            <Message>Please reply with the type of boat you are registering.
            1 for BoatType A
            2 for BoatType B
            3 for BoatType C</Message>
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

        //get the action variable if it exists
        $action = $_SESSION['action'];
        //if it doesn't, set it as 'register'
        if(!strlen($action)) {
            $action = 'register';

            //Save it
            $_SESSION['action'] = $action;
        }

        //create a flag variable for the name
        $_SESSION['name'] = 1;
        
        // now greet the sender
        header("content-type: text/xml");
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        ?>
        <Response>
            <Message>Please reply back with your name.</Message>
        <!--<MediaUrl>https://demo.twilio.com/owl.png</MediaUrl>-->
        </Response>
    <?php }

    else {

    // now greet the sender
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
    <!--<Message><?php echo $name ?>, thanks for the message!</Message>-->
    
    <Message>What do you want to do?
    1 for Report
    2 for Register
    </Message>
    <!--<MediaUrl>https://demo.twilio.com/owl.png</MediaUrl>-->
</Response>

<?php } ?>