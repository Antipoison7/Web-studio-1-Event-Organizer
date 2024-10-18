<?php
//Includes the database processing and login checking
include_once('./apiDB.php');

// Set headers for the response
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

//NOTE, THIS IS SAMPLE STUFF, DO NOT USE GET WITH PASSWORDS AS IT IS UNSECURE
//THIS IS JUST TO PROVIDE SAMPLE CODE FOR USER AUTHENTICATION AND COMMANDS

// Get the request method
$method = $_SERVER['REQUEST_METHOD'];

//Pre-emptively sets the error code for if a function is not found
$errorCode = "Invalid function, function does not exist";

if(isset($_GET["function"])) //Checks to see if a function has been sent
{
    switch ($_GET["function"])
    {
        //?Function=dumpAllUserData | Dumps 'users' table data
        case 'dumpAllUserData':
            //Check to make sure username and password are set
            if(isset($_GET["Username"])&&isset($_GET["Password"])) 
            {   //Check to see if the user has at max level 3 (admin) clearance
                if(isAdmin($_GET["Username"],$_GET["Password"]))
                {
                    echo(json_encode(dumpUserData()));
                }
                else
                {
                    $errorCode = "Username and/or password invalid";
                    goto failedAPI;
                }
            }
            else
            {
                $errorCode = "Username and/or password not set";
                goto failedAPI;
            }
            break;

        //?Function=returnUserPfp | Returns user profile picture
        case 'returnUserPfp':
            if(isset($_GET["varA"]))
            {
                echo(json_encode(getProfilePicture($_GET["varA"])));
            }
            else
            {
                $errorCode = "varA not set, no username value given";
                goto failedAPI;
            }
            break;

        default: 
            failedAPI: //Skip here to display error codes
            echo(json_encode(['error' => 'invalid function usage', 'errorMessage' => $errorCode]));
            break;
            
    }
}
else //If function is not set, return all possible commands
{
    echo(json_encode(
        ['greeting' => 'Welcome to the webapi for Web Programming Studio Group 1',
        'publicFunctions' => [
            'returnUserPfp' => [
                'description' =>'Returns the path of the user\'s profile picture relative to siteRoot as the root folder', 
                'parameters' => 'Accepts one input assigned on varA=Str']
            ],
        'privateFunctions' => [
            'dumpAllUserData' => [
                'description' => 'Self explanatory, dumps all user data (NOTE: WILL NOT DUMP ACCOUNT DATA)',
                'parameters' => 'Username=Str&Password=Str']]]));
}
?>