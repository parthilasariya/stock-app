# Stock App

## Features

- Displays real-time Rogers Communications (RCI-B.TO) stock info
- Users can submit buy/withdraw share requests
- Requests stored in MySQL
- Clean, responsive UI
  
## 🛠️ Technologies

- **Backend**: PHP 8.1+
- **Database**: MySQL
- **Frontend**: HTML5, CSS3, JavaScript
- **API**: TwelveData
- **Server**: Apache (XAMPP)

## Setup (macOS, XAMPP)

1. **Clone repo** to `~/Applications/XAMPP/htdocs/stock-app`
2. **Create DB and Table**  
   - In phpMyAdmin, run the SQL from the requirements
3. **Configure DB Credentials** in `config/db.php`
4. **API**: 'https://twelvedata.com/'
5. **Start XAMPP** (`sudo /Applications/XAMPP/xamppfiles/xampp start`)
6. **Browse** to `http://localhost/stock-app/`

## Security Notes

- All input is validated server and client side.
- Uses PDO prepared statements to prevent SQL injection.
