<?php
include("db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_email = $_POST['useremail'];
    $newpass    = $_POST['newpass'];
    $cpass      = $_POST['cpass'];

    if ($newpass === $cpass) {
        $hashed_pass = password_hash($newpass, PASSWORD_DEFAULT);

        $query = "UPDATE users SET pass='$hashed_pass' WHERE email='$user_email' OR username='$user_email'";

        if (mysqli_query($conn, $query)) {
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
              <meta charset="UTF-8">
              <title>Roomify – Password Updated</title>
              <style>
                * { margin: 0; padding: 0; box-sizing: border-box; }

                html, body {
                  width: 100%;
                  height: 100%;
                  background: #f6e8f0;
                  background-image:
                      radial-gradient(circle at 15% 15%, rgba(212, 83, 126, 0.35) 0%, transparent 40%),
                      radial-gradient(circle at 85% 80%, rgba(179, 120, 200, 0.38) 0%, transparent 40%),
                      radial-gradient(circle at 60% 10%, rgba(240, 180, 220, 0.4) 0%, transparent 35%),
                      radial-gradient(circle at 30% 80%, rgba(200, 150, 210, 0.35) 0%, transparent 35%);
                  font-family: Arial, sans-serif;
                }

                .bubble { position: fixed; border-radius: 50%; z-index: 0; }
                .b1 { width: 100px; height: 100px; background: rgba(212, 83, 126, 0.18);  top: 8%;     left: 5%;  }
                .b2 { width: 60px;  height: 60px;  background: rgba(179, 120, 200, 0.2);  top: 15%;    right: 8%; }
                .b3 { width: 80px;  height: 80px;  background: rgba(240, 160, 210, 0.2);  bottom: 10%; left: 8%;  }
                .b4 { width: 50px;  height: 50px;  background: rgba(200, 140, 220, 0.22); bottom: 15%; right: 6%; }

                /* Overlay */
                .overlay {
                  position: fixed;
                  inset: 0;
                  background: rgba(0, 0, 0, 0.35);
                  display: flex;
                  align-items: center;
                  justify-content: center;
                  z-index: 9999;
                }

                /* Popup card */
                .popup {
                  background: white;
                  padding: 44px 38px;
                  border-radius: 22px;
                  text-align: center;
                  max-width: 380px;
                  width: 90%;
                  box-shadow: 0 8px 32px rgba(160, 90, 140, 0.18);
                  position: relative;
                }

                .popup::before {
                  content: '';
                  position: absolute;
                  border-radius: 50%;
                  width: 100px;
                  height: 100px;
                  background: rgba(212, 83, 126, 0.12);
                  top: -30px;
                  left: -30px;
                  z-index: -1;
                }

                .popup::after {
                  content: '';
                  position: absolute;
                  border-radius: 50%;
                  width: 75px;
                  height: 75px;
                  background: rgba(179, 120, 200, 0.15);
                  bottom: -25px;
                  right: -25px;
                  z-index: -1;
                }

                .popup .icon {
                  font-size: 52px;
                  margin-bottom: 16px;
                }

                .popup h2 {
                  color: #6b4c5e;
                  font-size: 26px;
                  font-weight: 500;
                  margin-bottom: 10px;
                }

                .popup p {
                  color: #4a3743;
                  font-size: 15px;
                  line-height: 1.6;
                  margin-bottom: 28px;
                }

                .popup a {
                  display: inline-block;
                  background: #6b4c5e;
                  color: white;
                  padding: 13px 32px;
                  border-radius: 12px;
                  text-decoration: none;
                  font-size: 15px;
                  transition: 0.3s;
                }

                .popup a:hover {
                  background: #b48fa8;
                }
              </style>
            </head>
            <body>

            <!-- Bubbles -->
            <div class="bubble b1"></div>
            <div class="bubble b2"></div>
            <div class="bubble b3"></div>
            <div class="bubble b4"></div>

            <!-- Popup -->
            <div class="overlay">
              <div class="popup">
                <div class="icon">✅</div>
                <h2>Password Reset!</h2>
                <p>Your password has been updated successfully. You can now log in with your new password.</p>
                <a href="login.php">← Back to Login</a>
              </div>
            </div>

            </body>
            </html>
            <?php
        } else {
            echo "<script>alert('Something went wrong. Please try again.'); window.history.back();</script>";
        }

    } else {
        echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
    }
}
?>