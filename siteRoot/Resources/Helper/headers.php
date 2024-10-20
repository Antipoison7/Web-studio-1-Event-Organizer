<?php
    include_once('./Resources/Helper/loginHelper.php');

    function makeHeader($title)
    {
    echo("
            <div class=\"header\">
                <p>" . $title . "</p>
            </div>
        ");
    }

    function makeFooter()
    {
    echo("
            <div class=\"footer\">
                <!--<div class=\"flex\">
                    <a href=\"./\"><div style=\"background-color:black; width: 30px; height: 30px; color: white;\">A</div></a>
                    <a href=\"./\"><div style=\"background-color:black; width: 30px; height: 30px; color: white;\">B</div></a>
                    <a href=\"./\"><div style=\"background-color:black; width: 30px; height: 30px; color: white;\">C</div></a>
                    <a href=\"./\"><div style=\"background-color:black; width: 30px; height: 30px; color: white;\">D</div></a>
                 </div> -->
                <div class=\"footerItem\">
                    <h1>Quick links</h1>
                    <a href=\"./HomePage.php\"><h2>Home</h2></a>
                    <a href=\"./AboutUs.php\"><h2>About Us</h2></a>
                    <a href=\"./FAQSite.php\"><h2>FAQ</h2></a>
                    <a href=\"./PrivacyPolicy.php\"><h2>Privacy Policy</h2></a>
                    <a href=\"./TermsOfService.php\"><h2>Terms of Service</h2></a>
                    <a href=\"./login.php\"><h2>Log In</h2></a>
                    <a href=\"./register.php\"><h2>Register</h2></a>");

                    if(isset($_SESSION["loginDetails"])){if(isValidLogin($_SESSION["loginDetails"]["username"], $_SESSION["loginDetails"]["password"])){
                        echo("<a href=\"./Resources/Helper/logout.php\"><h2>Log Out</h2></a>");
                    }}

    echo("
                </div>
                <div class=\"footerItem\">
                    <h1>Contact Us</h1>
                    <a href=\"mailto:orders.connor@gmail.com\"><h2>Email</h2></a>
                    <a href=\"./\"><h2>Phone Number</h2></a>
                    <br>
                </div >
                <div class=\"footerItem\">
                    <div>
                        <h1>Forum Links</h1>
                        <a href=\"./discussionForum.php\"><h2>Home</h2></a>
                        
                        <br>
                    </div>
                    <div>
                        <h1>Event Links</h1>
                        <a href=\"./eventRegistration.php\"><h2>Create an Event</h2></a>
                        
                        <br>
                    </div>
                    <div>
                        <h1>Profile Links</h1>
                        <a href=\"./profileCustomise.php\"><h2>Customize Profile</h2></a>
                        
                        <br>
                    </div>
                    <div>
                        <h1>Moderation</h1>
                        <a href=\"./adminControls.php\"><h2>Mod Portal</h2></a>
                        
                        <br>
                    </div> 
                    <div>
                        <h1>Fancommunity</h1>
                        <a href=\"./fancommunity.php\"><h2>Social</h2></a>
                        
                        <br>
                    </div>                   
                </div>
            </div>
        ");
    }

    
    function headerNoLogin($title)
    {
        if(isset($_SESSION["loginDetails"])){if(isValidLogin($_SESSION["loginDetails"]["username"], $_SESSION["loginDetails"]["password"])){
            $pfpVal = "default.png";
            try
                {
                    $db = new PDO("mysql:host=talsprddb02.int.its.rmit.edu.au;dbname=COSC3046_2402_UGRD_1479_G4", "COSC3046_2402_UGRD_1479_G4", "GYS3sfUkzIqA");
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt = $db->prepare("SELECT profile_picture FROM users WHERE username = :name;");

                    if(containsAt($_SESSION["loginDetails"]["username"]))
                    {
                        $setName = getUsername($_SESSION["loginDetails"]["username"]);
                    }
                    else
                    {
                        $setName = $_SESSION["loginDetails"]["username"];
                    }

                    $stmt->bindParam(':name', $setName, PDO::PARAM_STR);
                    $stmt->execute();

                    $pfpVal = $stmt->fetchColumn();

                    $db = null;
                    $stmt = null;
                }
                catch (PDOException $e)
                {
                    echo("oh great heavens: " . $e->getMessage());
                }

            echo("
            <div class=\"mainHeader\">
                <div id=\"logo\"><a href=\"./HomePage.php\">
                    <img  src=\"./Resources/Images/Resources/WebsiteLogo.webp\" alt=\"WebsiteLogo\" width=\"100\" height=\"100\">
                </a></div>

                <h1>$title</h1>
                <div>
                <a href=\"./profileView.php\">
                <img src=\"." . $pfpVal . "\" alt=\"User Profile Picture\" class=\"headerPfp\">
                </a>
                    <a href=\"./shoppingcart.php\" class=\"cartIcon\"><img src=\"./Resources/Images/Resources/shoppingCart.svg\" alt=\"Your Cart\" style=\"height:3em\"></a></div>
                </div>
            </div>
        ");
        }
        else
        {
            echo("
            <div class=\"mainHeader\">
                <div id=\"logo\"><a href=\"./HomePage.php\">
                    <img  src=\"./Resources/Images/Resources/WebsiteLogo.webp\" alt=\"WebsiteLogo\" width=\"100\" height=\"100\">
                </a></div>

                <h1>$title</h1>
                <div>
                    <a href=\"./login.php\"><div class=\"smallButtonInv\">Login</div></a>
                    <a href=\"./register.php\"><div class=\"smallButtonInv\">Register</div></a>
                    <a href=\"./shoppingcart.php\" class=\"cartIcon\"><img src=\"./Resources/Images/Resources/shoppingCart.svg\" alt=\"Your Cart\" style=\"height:3em\"></a></div>
                </div>
            </div>
        ");
        }
        }
        else
        {
            echo("
            <div class=\"mainHeader\">
                <div id=\"logo\"><a href=\"./HomePage.php\">
                    <img  src=\"./Resources/Images/Resources/WebsiteLogo.webp\" alt=\"WebsiteLogo\" width=\"100\" height=\"100\">
                </a></div>

                <h1>$title</h1>
                <div>
                    <a href=\"./login.php\"><div class=\"smallButtonInv\">Login</div></a>
                    <a href=\"./register.php\"><div class=\"smallButtonInv\">Register</div></a>
                    <a href=\"./shoppingcart.php\" class=\"cartIcon\"><img src=\"./Resources/Images/Resources/shoppingCart.svg\" alt=\"Your Cart\" style=\"height:3em\"></a></div>
                </div>
            </div>
        ");
        }

        
    }

    function createMeta()
    {
        echo("<meta charset=\"UTF-8\">
              <meta name=\"description\" content=\"A free online event hoster and forum platform\">
              <meta name=\"author\" content=\"RMIT Group 1\">
              <meta name=\"keywords\" content=\"Forums, Forum, Events, Event Hosting\">");
    }
?>

