$(document).ready(function() {
    // Function to load stock data
    function loadStockData() {
        $.ajax({
            url: 'api/fetch_stock.php', 
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log('Stock data received:', data); 
    
                if (data.error) {
                    $('#stock-info').html('<p>Error: ' + data.error + '</p>');
                    return;
                }
                // Update the stock info section with the received data
                $('#stock-price').text('$' + data.price);
                $('#stock-change').text(data.change_percent + '%'); 
                $('#stock-volume').text(data.volume);
                $('#stock-timestamp').text(data.timestamp);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error); 
                console.error('Response:', xhr.responseText);
                $('#stock-info').html('<p>Error loading stock data.</p>');
            }
        });
    } 

    // Initial load
    loadStockData();

    // Auto-refresh every 5 minutes
    setInterval(loadStockData, 300000);

    // Form submission (buy/withdraw)
    $('.request-form').on('submit', function(e) {
        e.preventDefault();
        var $form = $(this); // Store reference to the submitted form
        var formData = $form.serialize();
        console.log('Submitting form data:', formData);
        
        $.ajax({
            url: 'api/submit_request.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                console.log('Server response:', response);
                if (response.success) {
                    alert('Request sent successfully!');
                    // Clear only the submitted form
                    $form[0].reset();
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                console.error('Response:', xhr.responseText);
                alert('Error sending request. Please try again.');
            }
        });
    });
});