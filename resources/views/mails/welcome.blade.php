<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bienvenu sur Contact-Shop</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-left: 10px solid #4CAF50;
        }

        h1 {
            color: #4CAF50;
            text-align: center;
        }

        p {
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .signature {
            text-align: right;
            color: #4CAF50;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Bienvenu sur Contact-Shop</h1>
        <p>Bonjour {{ $name }}, nous sommes ravis de vous inviter à vous appuyer sur nos riches fichiers de contacts WhatsApp pour renforcer votre activité professionnelle. Nous sommes convaincus que notre approche innovante et notre expertise en matière de contacts professionnels vous permettront de développer votre activité avec succès.</p>
        <p class="signature">Cordialement,<br>Équipe Contact-Shop</p>
    </div>
</body>

</html>
