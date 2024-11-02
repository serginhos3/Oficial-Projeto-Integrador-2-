<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orçamento Em Aberto</title>
</head>
<body>
    <h1>Orçamento Em Aberto Há Mais de 90 Dias</h1>
    <p>O orçamento com ID {{ $orcamento->id }} está em aberto há mais de 90 dias.</p>
    <p>Status: {{ $orcamento->status }}</p>
    <p>Última atualização: {{ $orcamento->updated_at }}</p>
</body>
</html>
