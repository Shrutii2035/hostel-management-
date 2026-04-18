<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Roomify – Sign Up</title>

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

    .b1 { width: 100px; height: 100px; background: rgba(212, 83, 126, 0.18);  top: 8%;    left: 5%;   }
    .b2 { width: 60px;  height: 60px;  background: rgba(179, 120, 200, 0.2);  top: 15%;   right: 8%;  }
    .b3 { width: 80px;  height: 80px;  background: rgba(240, 160, 210, 0.2);  bottom: 10%; left: 8%;  }
    .b4 { width: 50px;  height: 50px;  background: rgba(200, 140, 220, 0.22); bottom: 15%; right: 6%; }

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
      font-size: 32px;
      font-weight: 400;
      color: #6b4c5e;
    }

    /* MAIN */
    main {
      margin-top: 120px;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 40px 20px;
      position: relative;
      z-index: 1;
    }

    .signin-box {
      background: white;
      padding: 45px 40px;
      border-radius: 24px;
      width: 100%;
      max-width: 500px;
      box-shadow: 0 8px 32px rgba(160, 90, 140, 0.13), 0 1.5px 4px rgba(160, 90, 140, 0.07);
      text-align: center;
      position: relative;
    }

    .signin-box::before {
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

    .signin-box::after {
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

    .acc {
      font-family: "fonts";
      font-size: 38px;
      color: #6b4c5e;
      margin-bottom: 20px;
      font-weight: 400;
    }

    .info {
      font-size: 16px;
      color: #4a3743;
      text-align: left;
    }

    .info input {
      width: 100%;
      padding: 12px 14px;
      margin: 8px 0 18px 0;
      border-radius: 10px;
      border: 1px solid #ddd;
      font-size: 15px;
    }

    .info input:focus {
      outline: none;
      border-color: #b48fa8;
      box-shadow: 0 0 0 3px rgba(180,143,168,0.2);
    }

    .info input[type="submit"] {
      background: #6b4c5e;
      color: white;
      border: none;
      cursor: pointer;
      font-size: 16px;
      padding: 14px;
      border-radius: 12px;
      transition: 0.3s;
      margin-top: 10px;
    }

    .info input[type="submit"]:hover {
      background: #b48fa8;
    }

    .info h3 {
      text-align: center;
      margin-top: 20px;
      font-size: 15px;
      font-weight: normal;
    }

    .info a {
      color: #6b4c5e;
      text-decoration: none;
      font-weight: 500;
    }

    .info a:hover {
      text-decoration: underline;
    }

    .error {
      color: red;
      font-size: 13px;
      margin-top: -12px;
      margin-bottom: 10px;
      display: none;
    }

    .strength {
      font-size: 13px;
      margin-top: -12px;
      margin-bottom: 15px;
      font-weight: bold;
    }

    .weak   { color: red;    }
    .medium { color: orange; }
    .strong { color: green;  }

    @media (max-width: 768px) {
      header {
        padding: 0 25px;
        flex-direction: column;
        height: auto;
      }
      .nav-title h1 { font-size: 26px; }
      .signin-box   { padding: 35px 25px; }
      .acc          { font-size: 30px; }
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
    <h1>Sign Up</h1>
  </div>
</header>

<main>
  <form method="POST" action="signincheck.php" class="signin-box" name="signupForm" onsubmit="return validateForm();">

    <div class="acc">Create Your Account</div>

    <div class="info">
      Create Username
      <input type="text" name="name" id="username" value="<?php if(isset($_REQUEST['name'])) echo $_REQUEST['name']; ?>">
      <div class="error" id="userError">Username must be at least 8 characters</div>

      Enter Email
      <input type="text" name="email" id="email" value="<?php if(isset($_REQUEST['email'])) echo $_REQUEST['email']; ?>">
      <div class="error" id="emailError">Enter a valid email address</div>

      Set Password
      <input type="password" name="pass" id="password" onkeyup="checkStrength()">
      <div class="strength" id="strengthMsg"></div>
      <div class="error" id="passError">Password must be at least 8 characters</div>

      Confirm Password
      <input type="password" name="cpass" id="cpassword">
      <div class="error" id="cpassError">Passwords do not match</div>

      <input type="submit" value="Create Account">

      <h3>Already have an account? <a href="login.php">Login</a></h3>
      <h3><a href="index.php">Back to home page</a></h3>
    </div>

  </form>
</main>

<script>
function validateForm() {
  let valid = true;

  let username  = document.getElementById("username");
  let email     = document.getElementById("email");
  let password  = document.getElementById("password");
  let cpassword = document.getElementById("cpassword");

  let userError  = document.getElementById("userError");
  let emailError = document.getElementById("emailError");
  let passError  = document.getElementById("passError");
  let cpassError = document.getElementById("cpassError");

  if (username.value.length < 8) {
    userError.style.display = "block"; valid = false;
  } else { userError.style.display = "none"; }

  let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailPattern.test(email.value)) {
    emailError.style.display = "block"; valid = false;
  } else { emailError.style.display = "none"; }

  if (password.value.length < 8) {
    passError.style.display = "block"; valid = false;
  } else { passError.style.display = "none"; }

  if (password.value !== cpassword.value || cpassword.value === "") {
    cpassError.style.display = "block"; valid = false;
  } else { cpassError.style.display = "none"; }

  return valid;
}

function checkStrength() {
  let password    = document.getElementById("password").value;
  let strengthMsg = document.getElementById("strengthMsg");

  if (password.length === 0) { strengthMsg.innerHTML = ""; return; }

  let strength = 0;
  if (password.length >= 8)        strength++;
  if (/[A-Z]/.test(password))      strength++;
  if (/[0-9]/.test(password))      strength++;
  if (/[@$!%*?&]/.test(password))  strength++;

  if (strength <= 1) {
    strengthMsg.innerHTML = "Weak Password";
    strengthMsg.className = "strength weak";
  } else if (strength <= 3) {
    strengthMsg.innerHTML = "Medium Password";
    strengthMsg.className = "strength medium";
  } else {
    strengthMsg.innerHTML = "Strong Password";
    strengthMsg.className = "strength strong";
  }
}
</script>

</body>
</html>