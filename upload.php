<?php
$targetDir = "user_data/"; // Directory where uploaded files will be saved
$targetFile = $targetDir . basename($_FILES["userFile"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Check if the file is an actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["userFile"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($targetFile)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Limit file size (e.g., 500KB)
if ($_FILES["userFile"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow only specific file types (e.g., JPG, JPEG, PNG, GIF)
$allowedTypes = array("jpg", "jpeg", "png", "gif");
if (!in_array($fileType, $allowedTypes)) {
    echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
    $uploadOk = 0;
}

// Move the uploaded file to the target directory
if ($uploadOk == 1) {
    if (move_uploaded_file($_FILES["userFile"]["tmp_name"], $targetFile)) {
        echo "File uploaded successfully!";
    } else {
        echo "Error uploading file.";
    }
}
?>
