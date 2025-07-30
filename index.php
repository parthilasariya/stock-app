<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stock Review App</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="assets/js/main.js"></script>
</head>
<body>
  <header class="header">
    <div class="header-container">
      <div class="logo">
        <h1>Stock App</h1>
      </div>
    </div>
  </header>
  <div class="container">
    <h1>Rogers Communications Stock Review</h1>
    <div id="stock-info">
        <p>Price: $<span id="stock-price">--</span></p>
        <p>Change: <span id="stock-change">--</span></p>
        <p>Volume: <span id="stock-volume">--</span></p>
        <p>Last Updated: <span id="stock-timestamp">--</span></p>
    </div>
    <h2>Buy Shares</h2>
    <form class="request-form">
        <input type="hidden" name="action" value="buy">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <input type="number" name="shares" min="1" placeholder="Number of Shares" required>
        <button type="submit">Buy</button>
    </form>
    <h2>Withdraw Shares</h2>
    <form class="request-form">
        <input type="hidden" name="action" value="withdraw">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <input type="number" name="shares" min="1" placeholder="Number of Shares" required>
        <button type="submit">Withdraw</button>
    </form>
  </div>
</body>

<footer> 
  <div class="footer-container">
    <p>© <?php echo date("Y");?> Stock Review App </p>
  </div> 
</footer>

</html>