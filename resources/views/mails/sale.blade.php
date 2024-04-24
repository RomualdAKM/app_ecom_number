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
            background-color: #f2f2f2;
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        p {
            color: #555;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <h2>Félicitations {{ $full_name }}, votre code promotionnel {{ $code }} a été utilisé par {{ Auth::user()->name }}, vous encaissez {{ number_format($total - ($total * $percentage / 100), 2, ',', ' ') }} F CFA.</h2>
</body>
</html>
