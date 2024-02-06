<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Mazuky">
    <meta name="copyright" content="Mazuky">
    <meta name="robots" content="index,follow">
    <link rel="stylesheet" href="https://www.guesstheanime.net/style.css">
    <title>Password reset</title>
    <script>
        function isPasswordValid(password) {
            if (password.length < 8) {
                return false;
            }

            var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/;
            return regex.test(password);
        }

        function validateForm() {
            var newPassword = document.getElementById("new_password").value;
            var confirmPassword = document.getElementById("confirm_password").value;

            if (!isPasswordValid(newPassword)) {
                alert("The password does not meet the minimum requirements. At least 1 uppercase letter, 1 lowercase letter, 1 number, 1 special character, and 8 characters.");
                return false;
            }

            if (newPassword !== confirmPassword) {
                alert("The passwords do not match.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body style="background: #181818;font-family: sans-serif;user-select: none;">
    <?php include ($_SERVER['DOCUMENT_ROOT']."/popup.php");?>
    <?php include ($_SERVER['DOCUMENT_ROOT']."/header.php"); ?>
    <main style="width: 512px;margin: 0 auto;color:white;">
        <h2>Password Reset</h2>

        <?php 
            include ($_SERVER['DOCUMENT_ROOT']."/data.php"); 

            if (isset($_GET['email']) && isset($_GET['code'])) {
                $email = $_GET['email'];
                $verificationCode = $_GET['code'];

                if($verificationCode == ""){
                    echo '<p>Follow the <span onclick="openemailpassPopup()" style="cursor: pointer;text-decoration: underline;">link</span> to reset your password.</p>';
                    exit;
                }

                $query = "SELECT * FROM user WHERE user_email = '$email' AND user_code = '$verificationCode'";
                $result = $webspace_01->query($query);

                if ($result && $result->num_rows > 0) {
                    echo '<form action="process_reset.php" method="post">';
                    echo '<input type="hidden" name="email" value="' . $email . '">';
                    echo '<input type="hidden" name="code" value="' . $verificationCode . '">';
                    echo '<label for="new_password">New password:</label><br>';
                    echo '<input type="password" name="new_password" required style="width: calc(100% - 25px);margin: 5px;padding: 5px;">';
                    echo '<br><br>';
                    echo '<label for="confirm_password">Confirm password:</label><br>';
                    echo '<input type="password" name="confirm_password" required style="width: calc(100% - 25px);margin: 5px;padding: 5px;">';
                    echo '<br><br>';
                    echo '<input type="submit" value="Reset password" style="padding: 10px;background: #930000;margin: 0;border: 0;border-radius: 5px;color: white;font-size: 13px;">';
                    echo '</form>';
                    exit;
                } else {
                    echo '<p>Invalid password reset link.</p>';
                    exit;
                }
            } else {
                echo '<p>Invalid password reset link.</p>';
                exit;
            }

            $webspace_01->close();
            

            if ($result) { 
                echo '<p>Password successfully reset. You can now log in with your new password.</p>';
                exit;
            } else {
                echo '<p>Error updating the password.</p>';
                exit;
            }
        ?>
    </main>


    <script>
        document.querySelector("form").addEventListener("submit", function(event) {
            if (!validateForm()) {
                event.preventDefault();
            }
        });
    </script>
</body>
</html>

