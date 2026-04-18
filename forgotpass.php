<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Roomify – Reset Password</title>

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html, body {
      width: 100%;
      height: 100%;
      overflow-x: hidden;
      background: #f6e8f0;
      background-image:
          radial-gradient(circle at 15% 15%, rgba(212, 83, 126, 0.35) 0%, transparent 40%),
          radial-gradient(circle at 85% 80%, rgba(179, 120, 200, 0.38) 0%, transparent 40%),
          radial-gradient(circle at 60% 10%, rgba(240, 180, 220, 0.4) 0%, transparent 35%),
          radial-gradient(circle at 30% 80%, rgba(200, 150, 210, 0.35) 0%, transparent 35%);
      font-family: Arial, sans-serif;
      color: #2e1f29;
      text-align: center;
    }

    @font-face {
      font-family: "fonts";
      src: url("fonts/Hello.otf");
      font-display: swap;
    }

    /* BUBBLES */
    .bubble {
      position: fixed;
      border-radius: 50%;
      z-index: 0;
    }

    .b1 { width: 100px; height: 100px; background: rgba(212, 83, 126, 0.18);  top: 8%;     left: 5%;   }
    .b2 { width: 60px;  height: 60px;  background: rgba(179, 120, 200, 0.2);  top: 15%;    right: 8%;  }
    .b3 { width: 80px;  height: 80px;  background: rgba(240, 160, 210, 0.2);  bottom: 10%; left: 8%;   }
    .b4 { width: 50px;  height: 50px;  background: rgba(200, 140, 220, 0.22); bottom: 15%; right: 6%;  }

    /* HEADER */
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

    /* MAIN */
    main {
      margin-top: 120px;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 40px 20px;
      flex-direction: column;
      position: relative;
      z-index: 1;
    }

    .reset-box {
      background: white;
      padding: 45px 40px;
      border-radius: 24px;
      width: 100%;
      max-width: 460px;
      box-shadow: 0 8px 32px rgba(160, 90, 140, 0.13), 0 1.5px 4px rgba(160, 90, 140, 0.07);
      text-align: center;
      position: relative;
    }

    .reset-box::before {
      content: '';
      position: absolute;
      border-radius: 50%;
      width: 120px;
      height: 120px;
      background: rgba(212, 83, 126, 0.15);
      top: -40px;
      left: -40px;
      z-index: -1;
    }

    .reset-box::after {
      content: '';
      position: absolute;
      border-radius: 50%;
      width: 90px;
      height: 90px;
      background: rgba(179, 120, 200, 0.2);
      bottom: -30px;
      right: -30px;
      z-index: -1;
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

    @media (max-width: 768px) {
      header {
        padding: 0 25px;
        flex-direction: column;
        height: auto;
      }
      .nav-title h1 { font-size: 24px; }
      .reset-box    { padding: 35px 25px; }
      .reset-box h2 { font-size: 28px; }
    }
  </style>
</head>

<body>

<!-- Bubbles -->
<div class="bubble b1"></div>
<div class="bubble b2"></div>
<div class="bubble b3"></div>
<div class="bubble b4"></div>

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
      Enter your registered email address and we'll send you
      a link to reset your password.
    </p>

    <label>Email Address</label>
    <input type="text" name="useremail" required>

    <input type="submit" value="Send Reset Link">

    <div class="back-link">
      <a href="login.php">← Back to Login</a>
    </div>
  </form>
</main>

</body>
</html>