<?php
  session_start();
  include_once('./Resources/Helper/headers.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Terms of Service</title>
    <?php createMeta() ?>
    <link rel="stylesheet" href="./Resources/Style/base.css">
    <link rel="icon" type="image/x-icon" href="./Resources/Images/Resources/favicon.png">
  </head>
  <body>
    <?php headerNoLogin("Terms of Service") ?>
    
    <main>
      <h1>Terms of Service</h1>
      
      <section class="tos-section">
        
        <h2>1. Acceptance of Terms</h2>
        <p>By accessing or using our website, you agree to be bound by these Terms of Service and any additional terms and conditions that are referenced herein. If you do not agree, you may not use our services.</p>
        
        <h2>2. Description of Service</h2>
        <p>Our platform allows users to create, manage, and join events within their local communities. We provide tools for event creation, registration, promotion, and communication. We are not responsible for the actions of event organizers or attendees outside our platform.</p>
        
        <h2>3. Account Registration</h2>
        <p>To access certain features, you must create an account. You agree to provide accurate and complete information during registration. You are responsible for keeping your account information secure and are liable for activities conducted through your account.</p>
        
        <h2>4. Event Creation and Management</h2>
        <p>Event organizers are responsible for accurately describing their events, including dates, locations, ticket prices, and other relevant details. By creating an event, you represent that you have the right to do so and that your event complies with applicable laws and regulations.</p>
        
        <h2>5. Payments and Fees</h2>
        <p>Some events may require payment for tickets. We provide a secure payment process, but we are not liable for transactions between event organizers and attendees beyond our platform. Any transaction fees or service fees will be disclosed at checkout.</p>
        
        <h2>6. Refunds and Cancellations</h2>
        <p>Refund policies vary by event and are determined by the event organizer. If an event is canceled, attendees may be entitled to a refund in accordance with the organizer's policies. Please contact the organizer directly for specific refund information. If your payment was processed through our platform, please allow 3-5 business days for the refund to be processed.</p>
        
        <h2>7. Code of Conduct</h2>
        <p>All users must act respectfully and lawfully when interacting on our platform. The following actions are prohibited:</p>
        <ul>
          <li>Harassment, threats, or abusive language toward other users.</li>
          <li>Posting false or misleading information.</li>
          <li>Impersonating other individuals or entities.</li>
          <li>Attempting to hack, disrupt, or manipulate our platform.</li>
        </ul>
        <p>Violation of these rules may result in account suspension or termination.</p>
        
        <h2>8. Intellectual Property</h2>
        <p>All content on our platform, including text, graphics, logos, and software, is owned by us or licensed to us. You may not reproduce, distribute, or use our content for commercial purposes without permission.</p>
        
        <h2>9. Liability and Indemnification</h2>
        <p>We provide our platform "as is" and are not liable for any damages arising from your use of our site, including errors, delays, or interruptions. You agree to indemnify and hold us harmless from any claims, damages, or expenses related to your use of the platform or violation of these Terms.</p>
        
        <h2>10. Changes to Terms</h2>
        <p>We reserve the right to update or modify these Terms of Service at any time. Changes will be effective upon posting on our website. Your continued use of the platform signifies acceptance of the modified Terms.</p>
        
        <h2>11. Termination of Services</h2>
        <p>We may suspend or terminate your account and access to our platform if you violate these Terms of Service. In such cases, you will not be eligible for any refunds.</p>
        
        <h2>12. Governing Law</h2>
        <p>These Terms are governed by and construed in accordance with the laws of [Your Country/State]. Any disputes arising from these Terms or your use of our services will be subject to the jurisdiction of courts in [Your Country/State].</p>
        
        <h2>13. Contact Information</h2>
        <p>If you have any questions about these Terms of Service, please contact us at via email.</p>
        
      </section>
    </main>
    
    <?php makeFooter(); ?>
  </body>
</html>
