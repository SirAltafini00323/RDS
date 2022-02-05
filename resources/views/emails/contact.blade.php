<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <h2>Nouvelle achat sur rdsmortors</h2>
    <p>Une nouvelle commande viens d'être effectué par {{ $info['panier']->user->name }}. 
        <br> Montant :  {{ $info['panier']->soldeAfterPayement() }} 
        <br> Visualisez la commande <a href=" {{ url('paniers/'.$info['panier']->reference) }}">ici</a></p>
</body>
</html>