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
                <div>
                    <h1>Quick links</h1>
                    <a href=\"./\"><h2>Home</h2></a>
                    <a href=\"./\"><h2>About Us</h2></a>
                    <a href=\"./\"><h2>FAQ</h2></a>
                    <a href=\"./\"><h2>Privacy Policy</h2></a>
                    <a href=\"./\"><h2>Terms of Service</h2></a>
                    <a href=\"./login.php\"><h2>Log In</h2></a>
                    <a href=\"./register.php\"><h2>Register</h2></a>
                </div>
                <div>
                    <h1>Contact Us</h1>
                    <a href=\"./\"><h2>Email</h2></a>
                    <a href=\"./\"><h2>Phone Number</h2></a>
                </div>
                <div class=\"flex\" style=\"flex-direction: column;\">
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

    function eventRegistration() {
        
        echo("
                <form>
                    <label for=\"etitle\">Whats the title of your event?</label><br>
                    <input type=\"text\" id=\"eventTitle\" name=\"eventTitle\"><br>
                    <label for=\"eventDescription\">Whats your event about?</label><br>
                    <input type=\"text\" id=\"eventDescription\" name=\"eventDescription\"><br>
                    <label for=\"eimg\">What image would you like displayed? </label><br>
                    <input type=\"file\" id=\"eimg\" name=\"eimg\" accept=\"image/*\">
                </form>
        
        
        
        
        
        
        
        
        
        
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