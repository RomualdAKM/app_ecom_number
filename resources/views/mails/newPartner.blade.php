<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Shop - Notification de vente</title>
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

        h2 {
            color: #4CAF50;
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        p {
            line-height: 1.6;
            margin-bottom: 20px;
            font-size: 16px;
        }

        .highlight {
            font-weight: bold;
            color: #4CAF50;
        }

        .signature {
            text-align: right;
            color: #4CAF50;
            font-weight: bold;
        }

        a {
            color: #4CAF50;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Félicitations, {{ $full_name }}!</h2>
        <p>
            Nous avons le plaisir de vous informer que vous êtes dès maintenant partenaire de <a href="https://contactshop.store">Contact-Shop</a>. Votre code promotionnel est <span class="highlight">{{ $code }}</span>.
        </p>
        <p>
            À chaque fois que votre code sera utilisé pour un achat sur <a href="https://contactshop.store">Contact-Shop</a>, vous encaisserez <span class="highlight">{{ $percentage }}%</span> des gains.
        </p>
        <p>
            Si vous avez des questions ou besoin d'assistance, n'hésitez pas à contacter notre service client. Nous sommes toujours là pour vous aider.
        </p>
        <p>
            Accédez au site <a href="https://contactshop.store">Contact-Shop</a> pour plus d'informations.
        </p>
        <p class="signature">
            L'équipe Contact Shop
        </p>
    </div>
    
</body>
</html>
