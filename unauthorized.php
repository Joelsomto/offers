<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>
    <style>
        /* General Reset */
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #173471, #1e3d8f);
            color: #fff;
            text-align: center;
        }

        /* Container Styles */
        .container {
            max-width: 600px;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.6);
            border-radius: 10px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.5);
            animation: fadeIn 1s ease-in-out;
        }

        h1 {
            font-size: 3rem;
            margin: 0 0 10px;
            color: #ffffff; /* Gold for emphasis */
        }

        p {
            font-size: 1.2rem;
            margin: 10px 0 20px;
            line-height: 1.6;
        }

        a {
            display: inline-block;
            text-decoration: none;
            background: #173471;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            border: 2px solid #fff;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
            transition: background 0.3s, transform 0.2s, color 0.3s;
        }

        a:hover {
            background: #1e3d8f;
            color: #ffd700;
            transform: scale(1.05);
        }

        /* Keyframes for Fade-in Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            h1 {
                font-size: 2.5rem;
            }
            p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Access Denied</h1>
        <p>You do not have permission to access this page.</p>
        <a href="index.php">Return to Home</a>
    </div>
</body>
</html>
