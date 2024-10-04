<?php
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
                    <a href=\"./index.php\"><h2>About Us</h2></a>
                    <a href=\"./FAQSite.php\"><h2>FAQ</h2></a>
                    <a href=\"./PrivacyPolicy.php\"><h2>Privacy Policy</h2></a>
                    <a href=\"./TermsOfService.php\"><h2>Terms of Service</h2></a>
                    <a href=\"./login.php\"><h2>Log In</h2></a>
                    <a href=\"./register.php\"><h2>Register</h2></a>
                </div>
                <div class=\"footerItem\">
                    <h1>Contact Us</h1>
                    <a href=\"./\"><h2>Email</h2></a>
                    <a href=\"./\"><h2>Phone Number</h2></a>
                </div >
                <div class=\"footerItem\">
                    <div>
                        <h1>Forum Links</h1>
                        <a href=\"./\"><h2>Home</h2></a>
                        <a href=\"./\"><h2>About Us</h2></a>
                    </div>
                    <div>
                        <h1>Event Links</h1>
                        <a href=\"./eventRegistration.php\"><h2>Create an Event</h2></a>
                        <a href=\"./\"><h2>About Us</h2></a>
                    </div>
                    <div>
                        <h1>Profile Links</h1>
                        <a href=\"./\"><h2>Home</h2></a>
                        <a href=\"./\"><h2>About Us</h2></a>
                    </div>
                </div>
            </div>
        ");
    }

    
    function headerNoLogin($title)
    {
        echo("
                <div class=\"mainHeader\">
                    <h1>$title</h1>
                    <div>
                        <a href=\"./login.php\"><div class=\"smallButton\">Login</div></a>
                        <a href=\"./register.php\"><div class=\"smallButtonInv\">Register</div></a>
                        <a><img src=\"./Resources/Images/Resources/shoppingCart.svg\" alt=\"Your Cart\" style=\"height:3em\"></a>
                    </div>
                </div>
            ");
    }
?>