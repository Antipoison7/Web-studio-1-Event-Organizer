<?php
  session_start();
  include_once('./Resources/Helper/headers.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>FAQ</title>
    <?php createMeta() ?>
    <link rel="stylesheet" href="./Resources/Style/base.css">
    <link rel="icon" type="image/x-icon" href="./Resources/Images/Resources/favicon.png">
  </head>
  <body>
    <?php headerNoLogin("FAQ") ?>
    
    <main>
      <h1>Frequently Asked Questions</h1>
      <section class="faq-section">
        
        <div class="faq-item">
          <h2>How do I create an event?</h2>
          <p>To create an event, log in to your account and go to the "Create an Event" page. Fill in all necessary details, like the event name, description, location, date, and ticket price if applicable. Once completed, click "Submit" to publish your event.</p>
        </div>
        
        <div class="faq-item">
          <h2>How can I join an event?</h2>
          <p>Browse the events on our homepage or use the filter to find events by location, category, or date. Once you find an event you’re interested in, click "Join" or "RSVP" and follow the instructions. If there are tickets, you’ll need to complete the payment process.</p>
        </div>
  
        
        <div class="faq-item">
          <h2>How do I apply a coupon code at checkout?</h2>
          <p>When you’re ready to complete your ticket purchase, enter your coupon code in the "Coupon Code" field during checkout. Our system will automatically verify the code and apply the discount if it’s valid.</p>
        </div>
        
        <div class="faq-item">
          <h2>What should I do if I have issues with my account or event?</h2>
          <p>If you encounter any problems, feel free to reach out to our customer support team via our "Contact Us" page. We’re here to help!</p>
        </div>
        
      </section>
    </main>
    
    <?php makeFooter(); ?>
  </body>
</html>
