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
                <div class=\"flex\">
                    <a href=\"./\"><div style=\"background-color:black; width: 30px; height: 30px; color: white;\">A</div></a>
                    <a href=\"./\"><div style=\"background-color:black; width: 30px; height: 30px; color: white;\">B</div></a>
                    <a href=\"./\"><div style=\"background-color:black; width: 30px; height: 30px; color: white;\">C</div></a>
                    <a href=\"./\"><div style=\"background-color:black; width: 30px; height: 30px; color: white;\">D</div></a>
                </div>
                <div>
                    <h1>Quick links</h1>
                    <a href=\"./\"><h2>Home</h2></a>
                    <a href=\"./\"><h2>About Us</h2></a>
                    <a href=\"./\"><h2>FAQ</h2></a>
                    <a href=\"./\"><h2>Privacy Policy</h2></a>
                    <a href=\"./\"><h2>Terms of Service</h2></a>
                    <a href=\"./\"><h2>Create an Event</h2></a>
                    <a href=\"./login.php\"><h2>Log In</h2></a>
                </div>
                <div>
                    <h1>Contact Us</h1>
                    <a href=\"./\"><h2>Email</h2></a>
                    <a href=\"./\"><h2>Phone Number</h2></a>
                </div>
                <div></div>
            </div>
        ");
    }
?>