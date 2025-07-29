$(document).ready(function() {
    // Function to load stock data
    function loadStockData() {
        $.ajax({
            url: '../api/fetch_stock.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#stock-price').text(data.price);
                $('#stock-change').text(data.change);
                $('#stock-volume').text(data.volume);
                $('#stock-timestamp').text(data.timestamp);
            },
            error: function() {
                $('#stock-info').html('<p>Error loading stock data.</p>');
            }
        });
    }

    // Initial load
    loadStockData();

    // Auto-refresh every 5 minutes (300000 ms)
    setInterval(loadStockData, 300000);

    // Form submission (buy/withdraw)
    $('.request-form').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '../api/submit_request.php', 
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                // Show success message
                alert('Request sent!');
            },
            error: function() {
                // Show error message
                alert('Error sending request.');
            }
        });
    });
});