<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['email'], $_POST['code'], $_POST['new_password'], $_POST['confirm_password'])) {
            $email = $_POST['email'];
            $verificationCode = $_POST['code'];
            $newPassword = $_POST['new_password'];
            $confirmPassword = $_POST['confirm_password'];

            if ($newPassword === $confirmPassword) {
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                $updateQuery = "UPDATE user SET user_password = ?, user_code = NULL WHERE user_email = ? AND user_code = ?";
                
                $stmt = $webspace_01->prepare($updateQuery);
                $stmt->bind_param('sss', $hashedPassword, $email, $verificationCode);

                if ($stmt->execute()) {
                    echo '<p>Password successfully reset. You can now log in with your new password.</p>';
                } else {
                    echo '<p>Error updating the password.</p>';
                }

                $stmt->close();
            } else {
                echo '<p>The entered passwords do not match.</p>';
            }
        } else {
            echo '<p>Invalid request parameters.</p>';
        }
    } else {
        echo '<p>Invalid request method.</p>';
    }

    $webspace_01->close();
?>
