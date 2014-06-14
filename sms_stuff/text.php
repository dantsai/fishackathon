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

    //Logic for Report flow
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
        $uri = $_REQUEST['Uri'];
        
        // now greet the sender
        header("content-type: text/xml");
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        ?>
        <Response>
            <Message><?php echo $action . " ur: " . $uri ?>. Please provide the ID number of the boat you are reporting.</Message>
        <!--<MediaUrl>https://demo.twilio.com/owl.png</MediaUrl>-->
        </Response>
    <?php }

    //Logic for Register flow)
    else if($_REQUEST['Body'] == '2') { 
        

        //get the action variable if it exists
        $action = $_SESSION['action'];
        //if it doesn't, set it as 'report'
        if(!strlen($action)) {
            $action = 'register';

            //Save it
            $_SESSION['action'] = $action;
        }

        //create a variable for the regID
        $image = $_REQUEST['regID'] = 1;
        
        // now greet the sender
        header("content-type: text/xml");
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        ?>
        <Response>
            <Message><?php echo $action ?>. Please provide the ID number of the boat you are reporting.</Message>
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