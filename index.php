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
        <h1>Stock Review App</h1>
      </div>
    </div>
  </header>
  <div class="container">
    <h1>Google Stock Review</h1>
    <div id="stock-info">
        <p><strong>Current Price: </strong><span id="stock-price"></span></p>
        <p><strong>Change: </strong><span id="stock-change">--</span></p>
        <p><strong>Volume: </strong><span id="stock-volume">--</span></p>
        <p><strong>Last Updated: </strong><span id="stock-timestamp">--</span></p>
    </div>
    <div class="forms-container">
      <div class="form-section">
        <h2>Buy Shares</h2>
        <form class="request-form">
            <input type="hidden" name="action" value="buy">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <input type="number" name="shares" min="1" placeholder="Number of Shares" required>
            <button type="submit">Buy</button>
        </form>
      </div>
      <div class="form-section">
        <h2>Withdraw Shares</h2>
        <form class="request-form">
            <input type="hidden" name="action" value="withdraw">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <input type="number" name="shares" min="1" placeholder="Number of Shares" required>
            <button type="submit">Withdraw</button>
        </form>
      </div>
    </div>
  </div>
</body>

<footer> 
  <div class="footer-container">
    <p>© <?php echo date("Y");?> Stock Review App </p>
  </div> 
</footer>

</html>