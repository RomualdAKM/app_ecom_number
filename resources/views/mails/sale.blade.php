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
    </style>
</head>
<body>

    <div class="container">
        <h2>Félicitations, {{ $full_name }}!</h2>
        <p>
            Nous avons le plaisir de vous informer que votre code promotionnel <span class="highlight">{{ $code }}</span> a été utilisé avec succès par <span class="highlight">{{ Auth::user()->name }}</span>.
        </p>
        <p>
            Grâce à cette transaction, vous encaissez la somme de <span class="highlight">{{ number_format($total - ($total * $percentage / 100), 2, ',', ' ') }} F CFA</span>.
        </p>
        <p>
            Nous vous remercions pour votre engagement et votre fidélité. Nous sommes ravis de vous compter parmi nos partenaires les plus précieux et nous espérons continuer à vous offrir le meilleur service possible.
        </p>
        <p>
            Si vous avez des questions ou besoin d'assistance, n'hésitez pas à contacter notre service client. Nous sommes toujours là pour vous aider.
        </p>

        <p>
            Accédez au site <a href="https://contactshop.store">Contact-Shop</a>.
        </p>

        <p class="signature">
            L'équipe Contact Shop
        </p>
    </div>
    
</body>
</html>
