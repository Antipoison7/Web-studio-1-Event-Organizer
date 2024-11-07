<?php
session_start();
include_once('./Resources/Helper/dbHelper.php'); // Adjust path to your DB connection file if different

// Ensure user is logged in
if (!isset($_SESSION['loginDetails']['username'])) {
    echo "User not logged in!";
    exit;
}

// Check if an image file is uploaded
if (isset($_FILES['pfp']) && $_FILES['pfp']['error'] == 0) {
    $username = $_SESSION['loginDetails']['username'];
    $targetDir = "./Resources/Images/ProfilePictures/";  // Directory to save the image
    $fileName = basename($_FILES['pfp']['name']);
    $targetFilePath = $targetDir . $fileName;

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES['pfp']['tmp_name'], $targetFilePath)) {
        // Save the new image path in the database
        $db = getDbConnection(); // Get the database connection
        $query = $db->prepare("UPDATE users SET profile_picture = ? WHERE username = ?");
        $query->execute([$targetFilePath, $username]);

        // Redirect back to profile customization page with success message
        header("Location: profileCustomise.php?status=success");
    } else {
        echo "Failed to upload the profile picture.";
    }
} else {
    echo "No profile picture uploaded or an error occurred.";
}
?>
