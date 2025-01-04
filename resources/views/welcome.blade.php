<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher's Companion App</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }
        header {
			background: linear-gradient(90deg, #96ccb3, #42b47f);
            padding: 20px;
            color: white;
            text-align: center;
        }
        header img {
            max-width: 100px;
            border-radius: 12px;
        }
        .main-content {
            padding: 20px;
            text-align: center;
        }
        .main-content h1 {
            font-size: 2.5em;
            color: #ff5e57;
        }
        .main-content p {
            font-size: 1.2em;
            margin: 15px 0;
            color: #555;
        }
        .main-content .cta-buttons a {
            text-decoration: none;
            color: white;
            background: #ff5e57;
            padding: 12px 20px;
            margin: 10px;
            border-radius: 8px;
            display: inline-block;
            font-size: 1.1em;
            transition: background 0.3s ease-in-out;
        }
        .main-content .cta-buttons a:hover {
            background: #ff3c2e;
        }
        footer {
            background: #2c2c2c;
            color: #bbb;
            text-align: center;
            padding: 20px;
            margin-top: 20px;
        }
        footer a {
            color: #ff5e57;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <header>
        <img src="{{ asset('images/adaptive-icon.png') }}" alt="App Logo">
        <h1>Teacher's Companion</h1>
        <p>Streamline your classroom management effortlessly!</p>
    </header>
    <div class="main-content">
        <h1>Organize Your Classroom</h1>
        <p>
            Teacher's Companion is your go-to app for managing rosters and keeping
            everything organized, all in one place.
        </p>
        <div class="cta-buttons">
            <a href="#download-ios">Download for iOS</a>
            <a href="https://rpro.px2.co.za/application-b7d5072d-9301-4e5f-8852-1e86e992993f.apk">Download for Android</a>
        </div>
    </div>
    <footer>
        <p>© 2025 Teacher's Companion. All rights reserved. | <a href="#">Privacy Policy</a></p>
    </footer>
</body>
</html>
