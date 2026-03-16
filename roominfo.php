<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Roomify – Room Information</title>

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
      color: #2e1f29;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
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
      font-size: 24px;
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

    nav a:hover::after {
      width: 100%;
    }

    /* ========= PAGE WRAPPER ========= */
    .page-wrapper {
      margin-top: 90px;
    }

    /* ========= SECTIONS ========= */
    section {
      padding: 90px 20px;
    }

    h2 {
      font-family: "fonts";
      font-size: 42px;
      color: #6b4c5e;
      text-align: center;
      margin-bottom: 35px;
      font-weight: 400;
    }

    /* ========= ROOM CARD ========= */
    .room-card {
      max-width: 760px;
      margin: auto;
      background: white;
      padding: 35px;
      border-radius: 22px;
      box-shadow: 0 18px 40px rgba(0,0,0,0.08);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .room-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 25px 55px rgba(0,0,0,0.12);
    }

    .room-card ul {
      list-style: none;
    }

    .room-card ul li {
      padding: 14px 0;
      font-size: 17px;
      border-bottom: 1px solid #eee;
    }

    .room-card ul li strong {
      color: #6b4c5e;
    }

    /* ========= FOOTER ========= */
    footer {
      background: #2e1f29;
      color: #ddd;
      text-align: center;
      padding: 50px 20px;
      font-size: 17px;
      line-height: 1.8;
    }

    footer strong {
      color: white;
    }

    /* ========= RESPONSIVE ========= */
    @media (max-width: 768px) {
      header {
        padding: 0 25px;
        flex-direction: column;
        height: auto;
      }

      nav {
        margin-top: 8px;
        gap: 18px;
      }

      nav a {
        font-size: 20px;
      }

      h2 {
        font-size: 32px;
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

  <nav>
    <a href="index.php"> Home</a>
    <a href="#single">Single Bed</a>
    <a href="#double">Double Bed</a>
    <a href="#triple">Triple Bed</a>
  </nav>
</header>

<div class="page-wrapper">

  <section id="single">
    <h2>Single Bed Room</h2>
    <div class="room-card">
      <ul>
        <li><strong>Room Type:</strong> Single Sharing</li>
        <li><strong>Room Size:</strong> 12ft × 15ft</li>
        <li><strong>Facilities:</strong> Study Table, Chair, Wi-Fi, Locker</li>
        <li><strong>Rent:</strong> ₹5000 per month</li>
        <li><strong>Washroom:</strong> Attached</li>
      </ul>
    </div>
  </section>

  <section id="double">
    <h2>Double Bed Room</h2>
    <div class="room-card">
      <ul>
        <li><strong>Room Type:</strong> Double Sharing</li>
        <li><strong>Room Size:</strong> 15ft × 18ft</li>
        <li><strong>Facilities:</strong> Study Tables, Chairs, Wi-Fi, Lockers</li>
        <li><strong>Rent:</strong> ₹3500 per month (per student)</li>
        <li><strong>Washroom:</strong> Attached</li>
      </ul>
    </div>
  </section>

  <section id="triple">
    <h2>Triple Bed Room</h2>
    <div class="room-card">
      <ul>
        <li><strong>Room Type:</strong> Triple Sharing</li>
        <li><strong>Room Size:</strong> 18ft × 20ft</li>
        <li><strong>Facilities:</strong> Study Tables, Chairs, Wi-Fi, Lockers</li>
        <li><strong>Rent:</strong> ₹2500 per month (per student)</li>
        <li><strong>Washroom:</strong> Common</li>
      </ul>
    </div>
  </section>

  <footer>
    <strong>Looking for a comfortable stay?</strong><br>
    Choose from our Single, Double, and Triple rooms.<br><br>
    Contact: hostel@web.com | +91-9876543210<br>
    © 2025 Roomify Girls Hostel. All Rights Reserved.
  </footer>

</div>

</body>
</html>
