<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Roomify – Room Information</title>

  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

    html, body {
      width: 100%;
      overflow-x: hidden;
      background: #f6e8f0;
      background-image:
          radial-gradient(circle at 15% 15%, rgba(212, 83, 126, 0.35) 0%, transparent 40%),
          radial-gradient(circle at 85% 80%, rgba(179, 120, 200, 0.38) 0%, transparent 40%),
          radial-gradient(circle at 60% 10%, rgba(240, 180, 220, 0.4) 0%, transparent 35%),
          radial-gradient(circle at 30% 80%, rgba(200, 150, 210, 0.35) 0%, transparent 35%);
      color: #2e1f29;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
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
      pointer-events: none;
    }

    .b1 { width: 100px; height: 100px; background: rgba(212, 83, 126, 0.18);  top: 8%;     left: 5%;  }
    .b2 { width: 60px;  height: 60px;  background: rgba(179, 120, 200, 0.2);  top: 15%;    right: 8%; }
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
    }

    .logo p {
      font-size: 14px;
      color: #8b6a7d;
      letter-spacing: 1px;
    }

    nav {
      display: flex;
      gap: 35px;
    }

    nav a {
      font-family: "fonts";
      font-size: 22px;
      text-decoration: none;
      color: #6b4c5e;
      position: relative;
    }

    nav a::after {
      content: "";
      position: absolute;
      left: 0;
      bottom: -6px;
      width: 0%;
      height: 2px;
      background: #b48fa8;
      transition: 0.3s;
    }

    nav a:hover::after { width: 100%; }

    /* PAGE */
    .page-wrapper { margin-top: 90px; position: relative; z-index: 1; }

    /* SECTIONS */
    section {
      padding: 80px 20px;
    }

    section:nth-child(even) {
      background: rgba(255, 255, 255, 0.35);
    }

    /* SECTION HEADER */
    .section-header {
      text-align: center;
      margin-bottom: 30px;
    }

    .section-header .room-emoji {
      font-size: 44px;
      display: block;
      margin-bottom: 10px;
    }

    .section-header h2 {
      font-family: "fonts";
      font-size: 38px;
      color: #6b4c5e;
      font-weight: 400;
      margin-bottom: 6px;
    }

    .section-header p {
      font-size: 14px;
      color: #9e7a8e;
      letter-spacing: 1px;
      text-transform: uppercase;
    }

    /* ROOM CARD */
    .room-card {
      max-width: 680px;
      margin: auto;
      background: white;
      padding: 32px 36px;
      border-radius: 22px;
      box-shadow: 0 8px 32px rgba(160, 90, 140, 0.11), 0 1.5px 4px rgba(160, 90, 140, 0.07);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      position: relative;
    }

    .room-card::before {
      content: '';
      position: absolute;
      border-radius: 50%;
      width: 90px;
      height: 90px;
      background: rgba(212, 83, 126, 0.1);
      top: -28px;
      left: -28px;
      z-index: -1;
    }

    .room-card::after {
      content: '';
      position: absolute;
      border-radius: 50%;
      width: 70px;
      height: 70px;
      background: rgba(179, 120, 200, 0.12);
      bottom: -22px;
      right: -22px;
      z-index: -1;
    }

    .room-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 16px 40px rgba(160, 90, 140, 0.16);
    }

    .room-card ul { list-style: none; }

    .room-card ul li {
      padding: 13px 0;
      font-size: 16px;
      border-bottom: 1px solid #f0e6ee;
      display: flex;
      align-items: center;
      gap: 12px;
      color: #4a3743;
    }

    .room-card ul li:last-child { border-bottom: none; }

    .room-card ul li .li-icon {
      font-size: 18px;
      width: 28px;
      text-align: center;
      flex-shrink: 0;
    }

    .room-card ul li strong {
      color: #6b4c5e;
      min-width: 110px;
    }

    /* PRICE BADGE */
    .price-row {
      background: #fdf0f7;
      border-radius: 12px;
      padding: 14px 16px !important;
      border-bottom: none !important;
      margin-top: 6px;
    }

    .price-row strong { color: #6b4c5e; }
    .price-row span   { font-size: 18px; font-weight: 700; color: #4a2d42; }

    /* FOOTER */
    footer {
      background: #3d2535;
      color: #e8d5e2;
      text-align: center;
      padding: 50px 20px;
      font-size: 16px;
      line-height: 2;
      position: relative;
      z-index: 1;
    }

    footer strong { color: #f2c4dc; font-size: 18px; }

    footer .footer-links {
      margin-top: 16px;
      font-size: 14px;
      color: #c9a8bc;
    }

    footer .footer-copy {
      margin-top: 20px;
      font-size: 13px;
      color: #9e7a8e;
      border-top: 1px solid rgba(255,255,255,0.08);
      padding-top: 16px;
    }

    @media (max-width: 768px) {
      header { padding: 0 25px; flex-direction: column; height: auto; }
      nav    { margin-top: 8px; gap: 18px; }
      nav a  { font-size: 18px; }
      .section-header h2 { font-size: 30px; }
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
  <nav>
    <a href="index.php">Home</a>
    <a href="#single">Single</a>
    <a href="#double">Double</a>
    <a href="#triple">Triple</a>
  </nav>
</header>

<div class="page-wrapper">

  <section id="single">
    <div class="section-header">
      <span class="room-emoji">🛏</span>
      <h2>Single Bed Room</h2>
      <p>Private &amp; Peaceful</p>
    </div>
    <div class="room-card">
      <ul>
        <li><span class="li-icon">🏠</span><strong>Room Type</strong> Single Sharing</li>
        <li><span class="li-icon">📐</span><strong>Room Size</strong> 12ft × 15ft</li>
        <li><span class="li-icon">✅</span><strong>Facilities</strong> Study Table, Chair, Wi-Fi, Locker</li>
        <li><span class="li-icon">🚿</span><strong>Washroom</strong> Attached</li>
        <li class="price-row"><span class="li-icon">💰</span><strong>Rent</strong> <span>₹5,000 / month</span></li>
      </ul>
    </div>
  </section>

  <section id="double">
    <div class="section-header">
      <span class="room-emoji">🛏🛏</span>
      <h2>Double Bed Room</h2>
      <p>Shared &amp; Affordable</p>
    </div>
    <div class="room-card">
      <ul>
        <li><span class="li-icon">🏠</span><strong>Room Type</strong> Double Sharing</li>
        <li><span class="li-icon">📐</span><strong>Room Size</strong> 15ft × 18ft</li>
        <li><span class="li-icon">✅</span><strong>Facilities</strong> Study Tables, Chairs, Wi-Fi, Lockers</li>
        <li><span class="li-icon">🚿</span><strong>Washroom</strong> Attached</li>
        <li class="price-row"><span class="li-icon">💰</span><strong>Rent</strong> <span>₹3,500 / month per student</span></li>
      </ul>
    </div>
  </section>

  <section id="triple">
    <div class="section-header">
      <span class="room-emoji">🛏🛏🛏</span>
      <h2>Triple Bed Room</h2>
      <p>Budget Friendly</p>
    </div>
    <div class="room-card">
      <ul>
        <li><span class="li-icon">🏠</span><strong>Room Type</strong> Triple Sharing</li>
        <li><span class="li-icon">📐</span><strong>Room Size</strong> 18ft × 20ft</li>
        <li><span class="li-icon">✅</span><strong>Facilities</strong> Study Tables, Chairs, Wi-Fi, Lockers</li>
        <li><span class="li-icon">🚿</span><strong>Washroom</strong> Common</li>
        <li class="price-row"><span class="li-icon">💰</span><strong>Rent</strong> <span>₹2,500 / month per student</span></li>
      </ul>
    </div>
  </section>

  <footer>
    <strong>Looking for a comfortable stay?</strong><br>
    Choose from our Single, Double, and Triple rooms.<br>
    <div class="footer-links">
      📧 hostel@web.com &nbsp;|&nbsp; 📞 +91-9876543210
    </div>
    <div class="footer-copy">
      © 2025 Roomify Girls Hostel. All Rights Reserved.
    </div>
  </footer>

</div>

</body>
</html>