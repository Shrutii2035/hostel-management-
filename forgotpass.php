<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Roomify – Reset Password</title>

  <style>
    /* ========= RESET ========= */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html, body {
      width: 100%;
      height: 100%;
      overflow-x: hidden;
      background-color: #f6f1f5;
      font-family: Arial, sans-serif;
      color: #2e1f29;
      text-align: center;
    }

    @font-face {
      font-family: "fonts";
      src: url("fonts/Hello.otf");
      font-display: swap;
    }

    /* ========= HEADER ========= */
    header {
      position: fixed;
      top: 0;
      width: 100%;
      height: 90px;
      background: rgba(255,255,255,0.85);
      backdrop-filter: blur(8px);
      box-shadow: 0 4px 25px rgba(0,0,0,0.08);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 70px;
      z-index: 1000;
    }

    .logo h1 {
      font-family: "fonts";
      font-size: 42px;
      color: #6b4c5e;
      margin-bottom: -6px;
      font-weight: 400;
    }

    .logo p {
      font-size: 14px;
      color: #8b6a7d;
      letter-spacing: 1px;
    }

    .nav-title h1 {
      font-family: "fonts";
      font-size: 30px;
      color: #6b4c5e;
      font-weight: 400;
    }

    /* ========= MAIN ========= */
    main {
      margin-top: 120px;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 40px 20px;
      flex-direction: column;
    }

    .reset-box {
      background: white;
      padding: 45px 40px;
      border-radius: 24px;
      width: 100%;
      max-width: 460px;
      box-shadow: 0 20px 45px rgba(0,0,0,0.1);
      text-align: center;
    }

    .reset-box h2 {
      font-family: "fonts";
      font-size: 34px;
      color: #6b4c5e;
      margin-bottom: 15px;
      font-weight: 400;
    }

    .reset-box p {
      font-size: 15px;
      color: #4a3743;
      margin-bottom: 25px;
      line-height: 1.6;
    }

    .reset-box label {
      display: block;
      text-align: left;
      font-size: 15px;
      margin-bottom: 6px;
      color: #4a3743;
    }

    .reset-box input {
      width: 100%;
      padding: 12px 14px;
      margin-bottom: 18px;
      border-radius: 10px;
      border: 1px solid #ddd;
      font-size: 15px;
    }

    .reset-box input:focus {
      outline: none;
      border-color: #b48fa8;
      box-shadow: 0 0 0 3px rgba(180,143,168,0.2);
    }

    .reset-box input[type="submit"] {
      background: #6b4c5e;
      color: white;
      border: none;
      cursor: pointer;
      font-size: 16px;
      padding: 14px;
      border-radius: 12px;
      transition: 0.3s;
      margin-top: 5px;
    }

    .reset-box input[type="submit"]:hover {
      background: #b48fa8;
    }

    .back-link {
      margin-top: 20px;
      font-size: 14px;
    }

    .back-link a {
      color: #6b4c5e;
      text-decoration: none;
      font-weight: 500;
    }

    .back-link a:hover {
      text-decoration: underline;
    }

    /* ========= RESPONSIVE ========= */
    @media (max-width: 768px) {
      header {
        padding: 0 25px;
        flex-direction: column;
        height: auto;
      }

      .nav-title h1 {
        font-size: 24px;
      }

      .reset-box {
        padding: 35px 25px;
      }

      .reset-box h2 {
        font-size: 28px;
      }
    }
  </style>
</head>

<body>

<header>
  <div class="logo">
    <h1>Roomify</h1>
    <p>Girls Hostel</p>
  </div>

  <div class="nav-title">
    <h1>Reset Password</h1>
  </div>
</header>

<main>
  <form method="POST" action="resetpassword.php" class="reset-box">
    <h2>Forgot Your Password?</h2>
    <p>
      Enter your registered email address and we’ll send you
      a link to reset your password.
    </p>

    <label>Email Address</label>
    <input type="text" name="useremail" required>

    <input type="submit" value="Send Reset Link" >


    <div class="back-link">
      <a href="login.php">← Back to Login</a>
    </div>
  </form>
</main>

</body>
</html>
