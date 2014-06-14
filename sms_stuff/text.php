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
 
//The Report Flow//

    //Logic for getting location information
    if ($_SESSION['location'] == 1 && $_SESSION['action'] == 'report') {
        
        //grab the location information of the reported boat, and other variables from the cookie
        $location = $_REQUEST['Body'];
        $regID = $_SESSION['regID'];
        $action = $_SESSION['action'];

        //save it to the session cookie
        $_SESSION['location'] = $location;    

        // now greet the sender
        header("content-type: text/xml");
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        ?>
        <Response>
            <Message><?php echo "Action: " . $action . " RegID: " . $regID ?>. Thank you for reporting this boat.</Message>
        <!--<MediaUrl>https://demo.twilio.com/owl.png</MediaUrl>-->
        </Response>
    <?php }

    //Logic for getting Reg ID
    else if ($_SESSION['regID'] == 1 && $_SESSION['action'] == 'report') {
        
        //grab the registration ID of the boat, and other variables from the cookie
        $regID = $_REQUEST['Body'];
        $action = $_SESSION['action'];

        //save it to the session cookie
        $_SESSION['regID'] = $regID;
        $_SESSION['location'] = 1;    

        // now greet the sender
        header("content-type: text/xml");
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        ?>
        <Response>
            <Message><?php echo $action ?>. Please provide the location where you saw the boat.</Message>
        <!--<MediaUrl>https://demo.twilio.com/owl.png</MediaUrl>-->
        </Response>
    <?php }

    else if($_REQUEST['Body'] == '1') { 
        
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
            <Message><?php echo $action ?>. Please provide the ID number of the boat you are reporting.</Message>
        <!--<MediaUrl>https://demo.twilio.com/owl.png</MediaUrl>-->
        </Response>
    <?php }

//Logic for Register flow
    //input boat type step
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
            <Message>Please reply with the type of boat you are registering. 1 for BoatType A, 2 for BoatType B, 3 for BoatType 3.</Message>
        <!--<MediaUrl>https://demo.twilio.com/owl.png</MediaUrl>-->
        </Response>
    <?php }

    //input boat location step
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

    //input address step
    else if($_REQUEST['Body'] == '2') {    

        //get the action variable if it exists
        $action = $_SESSION['action'];
        //if it doesn't, set it as 'register'
        if(!strlen($action)) {
            $action = 'register';

            //Save it
            $_SESSION['action'] = $action;
        }

        //create a flag variable for the address
        $_SESSION['address'] = 1;
        
        // now greet the sender
        header("content-type: text/xml");
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        ?>
        <Response>
            <Message><?php echo $action ?>. Please reply back with your address.</Message>
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
    
    <Message>What do you want to do? Reply '1' for Report, '2' for Register, '3' for License. This was your body message: <?php echo $_REQUEST['Body'] ?></Message>
    <!--<MediaUrl>https://demo.twilio.com/owl.png</MediaUrl>-->
</Response>

<?php } ?>