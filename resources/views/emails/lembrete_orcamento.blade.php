<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lembrete de Orçamento</title>
</head>
<body>
    <h1>Olá {{ $orcamento->paciente }},</h1>
    <p>Este é um lembrete sobre o seu orçamento:</p>
    <p><strong>Procedimento:</strong> {{ $orcamento->procedimento }}</p>
    <p><strong>Status:</strong> {{ $orcamento->status }}</p>
    <p><strong>Data:</strong> {{ $orcamento->data->format('d/m/Y') }}</p>
    <p>Atenciosamente,</p>
    <p>Sua equipe.</p>
</body>
</html>
