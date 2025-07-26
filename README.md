# Stock App

## Features

- Displays real-time Rogers Communications (RCI-B.TO) stock info
- Users can submit buy/withdraw share requests
- Requests stored in MySQL
- Clean, responsive UI
- Built with PHP (8.1+), MySQL, JavaScript, HTML5, CSS3

## Setup (macOS, XAMPP)

1. **Clone repo** to `~/Applications/XAMPP/htdocs/stock-app`
2. **Create DB and Table**  
   - In phpMyAdmin, run the SQL from the requirements
3. **Configure DB Credentials** in `config/db.php`
4. **Get Alpha Vantage API Key**  
   - Create `.env` file:  
     ```
     ALPHA_VANTAGE_KEY=YOUR_API_KEY
     ```
5. **Start XAMPP** (`sudo /Applications/XAMPP/xamppfiles/xampp start`)
6. **Browse** to `http://localhost/stock-app/`

## Security Notes

- All input is validated server and client side.
- Uses PDO prepared statements to prevent SQL injection.
- API keys are never exposed to frontend.

## API Source

- [Alpha Vantage](https://www.alphavantage.co/)