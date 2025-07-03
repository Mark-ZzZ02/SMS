<?php
include('../config/dbcon.php'); // Or your database connection path

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $case_id = mysqli_real_escape_string($con, $_POST['case_id']);
    $image_type = $_POST['image_type']; // 'statement_image', 'medical_proof', 'evidence_image'

    // Validate field
    $allowed_fields = ['statement_image', 'medical_proof', 'evidence_image'];
    if (!in_array($image_type, $allowed_fields)) {
        die("Invalid image type.");
    }

    // Get current image
    $getQuery = "SELECT `$image_type` FROM categories WHERE id='$case_id' LIMIT 1";
    $result = mysqli_query($con, $getQuery);
    $row = mysqli_fetch_assoc($result);
    $currentImage = $row[$image_type];

    // Handle Upload only (delete removed)
    if (isset($_POST['upload_image']) && isset($_FILES['image_file'])) {
        $file = $_FILES['image_file'];

        if ($file['error'] === 0 && $file['size'] > 0) {
            $filename = time() . '_' . basename($file['name']);
            $target = "../uploads/" . $filename;

            if (move_uploaded_file($file['tmp_name'], $target)) {
                // Delete old image
                if ($currentImage && file_exists("../uploads/$currentImage")) {
                    unlink("../uploads/$currentImage");
                }

                $updateQuery = "UPDATE categories SET `$image_type`='$filename' WHERE id='$case_id'";
                mysqli_query($con, $updateQuery);

                header("Location: /admin/view_case.php?id=$case_id");
                exit;
            } else {
                echo "Failed to upload image.";
            }
        } else {
            echo "Invalid image file.";
        }
    }
}
?>
