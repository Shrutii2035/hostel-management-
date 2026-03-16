<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Roomify – Girls Hostel</title>

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      scroll-behavior: smooth;
    }

    @font-face {
      font-family: "fonts";
      src: url("fonts/Hello.otf");
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f6f1f5;
      color: #2e1f29;
    }

    /* ================= HEADER ================= */
    header {
      position: fixed;
      top: 0;
      width: 100%;
      padding: 18px 70px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: rgba(255,255,255,0.85);
      backdrop-filter: blur(10px);
      box-shadow: 0 4px 25px rgba(0,0,0,0.08);
      z-index: 100;
    }

    .logo h1 {
      font-family: "fonts";
      font-size: 42px;
      color: #6b4c5e;
      margin-bottom: -6px;
    }

    .logo p {
      font-size: 14px;
      letter-spacing: 1px;
      color: #8b6a7d;
    }

    nav {
      display: flex;
      gap: 30px;
    }

    nav a {
      text-decoration: none;
      color: #6b4c5e;
      font-size: 17px;
      font-weight: 500;
      position: relative;
    }

    nav a::after {
      content: "";
      width: 0%;
      height: 2px;
      background: #b48fa8;
      position: absolute;
      left: 0;
      bottom: -5px;
      transition: 0.3s;
    }

    nav a:hover::after {
      width: 100%;
    }

    .admin-link a {
      background: #6b4c5e;
      color: white;
      padding: 10px 22px;
      border-radius: 10px;
      text-decoration: none;
      font-weight: 500;
      transition: 0.3s;
    }

    .admin-link a:hover {
      background: #b48fa8;
    }

    /* ================= HERO ================= */
    .hero {
      height: 100vh;
      background:
        linear-gradient(rgba(46,31,41,0.65), rgba(46,31,41,0.65)),
        url("hostelimg.jpg") center/cover no-repeat;
      display: flex;
      align-items: center;
      padding-left: 90px;
    }

    .hero-content {
      max-width: 620px;
      color: white;
    }

    .hero-content h1 {
      font-family: "fonts";
      font-size: 64px;
      font-weight: 200;
      line-height: 1.1;
      margin-bottom: 20px;
    }

    .hero-content p {
      font-size: 22px;
      line-height: 1.6;
      margin-bottom: 40px;
      color: #f1e8ee;
    }

    .cta-btn {
      background: #d7b6c9;
      color: #2e1f29;
      padding: 16px 38px;
      border-radius: 14px;
      font-size: 18px;
      font-weight: 500;
      text-decoration: none;
      transition: 0.3s;
    }

    .cta-btn:hover {
      background: #ffffff;
      transform: translateY(-3px);
    }

    /* ================= FEATURES ================= */
    .features {
      padding: 100px 80px;
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 30px;
    }

    .feature-card {
      background: white;
      padding: 40px 30px;
      border-radius: 22px;
      text-align: center;
      box-shadow: 0 20px 45px rgba(0,0,0,0.08);
      transition: 0.3s;
    }

    .feature-card:hover {
      transform: translateY(-8px);
    }

    .feature-card h3 {
      margin-top: 15px;
      font-size: 20px;
      color: #6b4c5e;
    }

    /* ================= ABOUT ================= */
    .about {
      padding: 90px;
      background: #ffffff;
      text-align: center;
    }

    .about h2 {
      font-family: "fonts";
      font-size: 44px;
      color: #6b4c5e;
      margin-bottom: 25px;
    }

    .about p {
      font-size: 19px;
      max-width: 900px;
      margin: auto;
      line-height: 1.8;
      color: #4a3743;
    }

    /* ================= FOOTER ================= */
    footer {
      background: #2e1f29;
      color: #ddd;
      padding: 50px 0;
      text-align: center;
      font-size: 17px;
      line-height: 1.8;
      
    }

    footer strong {
      color: white;
    }

    /* ================= RESPONSIVE ================= */
    @media (max-width: 900px) {
      header {
        padding: 18px 25px;
        flex-direction: column;
        gap: 10px;
      }

      .hero {
        padding: 40px;
        text-align: center;
      }

      .hero-content h1 {
        font-size: 46px;
        
      }

      .features {
        grid-template-columns: 1fr;
        padding: 60px 30px;
      }
    }
    .page-wrapper{
      margin-top: 90px;
    }
    html, body {
  width: 100%;
  height: 100%;
  overflow-x: hidden;
  overscroll-behavior: none;
}

  </style>
</head>

<body>
<div class="page-wrapper">
<header>
  <div class="logo">
    <h1>Roomify</h1>
    <p>Girls Hostel</p>
  </div>

  <nav>
    <a href="#">Home</a>
    <a href="roominfo.php">Rooms</a>
    <a href="facilities.html">Facilities</a>
    <a href="signin.php">Booking</a>
    <a href="hostelinfo.html">Hostel Info</a>
  </nav>

  <div class="admin-link">
    <a href="admin_login.php">Admin</a>
  </div>
</header>

<section class="hero">
  <div class="hero-content">
    <h1>Safe. Comfortable.<br>Student-First Living.</h1>
    <p>
      A premium girls hostel designed to provide safety,
      comfort, and a peaceful environment for academic growth.
    </p>
    <a href="signin.php" class="cta-btn">Book Your Room</a>
  </div>
</section>

<section class="features">
  <div class="feature-card">
    🔐
    <h3>24/7 Security</h3>
  </div>
  <div class="feature-card">
    📶
    <h3>High-Speed Wi-Fi</h3>
  </div>
  <div class="feature-card">
    🍽
    <h3>Healthy Dining</h3>
  </div>
  <div class="feature-card">
    📚
    <h3>Study Friendly</h3>
  </div>
</section>

<section class="about">
  <h2>Why Choose Roomify?</h2>
  <p>
    Roomify is more than just accommodation.  
    We offer a secure, disciplined, and homely environment where students
    can focus on their studies while enjoying comfort and independence.
  </p>
</section>

<footer>
  <strong>ABOUT US:</strong> Comfortable & affordable living for students<br>
  <strong>Contact:</strong> 9287354674<br>
  <strong>Address:</strong> 21-Queen Road, Mumbai<br>
  <strong>Email:</strong> support@roomifyhostel.com<br><br>
  © 2025 Roomify Girls Hostel. All Rights Reserved.
</footer>
  </div>
</body>
</html>
