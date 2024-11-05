<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orçamento #{{ $orcamento->id }}</title>
    <style>
        @page {
            size: A4;
            margin: 20px;
        }

        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 100%;
            padding: 15px;
            background: #fff;
            border-radius: 4px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            line-height: 1.4;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 280px;
            height: auto;
        }

        .info {
            font-size: 14px;
            color: #444;
            margin-bottom: 15px;
        }

        .info p {
            margin: 4px 0;
            padding: 6px;
            background-color: #f9fafc;
            border-left: 3px solid #007bff;
            border-radius: 4px;
            font-weight: 400;
            font-size: 13px;
        }

        .info p strong {
            font-weight: 500;
            color: #222;
        }

        .validade-input {
            display: inline-block;
            border: none; 
            border-bottom: 1px solid #333;
            width: 50px;
            font-size: 14px;
            color: #333;
            outline: none;
            margin-top: 5px;
            padding: 2px 5px;
            text-align: center;
        }

        .observations {
            margin-top: 10px;
        }

        .observations h2 {
            font-size: 14px;
            color: #333;
            margin-bottom: 5px;
        }

        .observations .line {
            height: 16px;
            border-bottom: 1px solid #ddd;
            margin: 5px 0;
        }

        .signatures {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
        }

        .signature {
            width: 48%;
            text-align: center;
        }

        .signature .line {
            border-top: 1px solid #333;
            margin-top: 35px;
            padding-top: 4px;
        }

        .signature p {
            font-size: 11px;
            color: #666;
            margin-top: 4px;
        }

        .footer {
            margin-top: 10px;
            text-align: center;
            font-size: 11px;
            color: #777;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="{{ $logoSrc }}" alt="Logotipo">
        </div>
        
        <div class="info">
            <p><strong>Paciente:</strong> {{ $orcamento->paciente }}</p>
            <p><strong>Valor:</strong> R$ {{ number_format($orcamento->valor, 2, ',', '.') }}</p>
            <p><strong>Procedimento:</strong> {{ $orcamento->procedimento }}</p>
            <p><strong>Dentista:</strong> {{ $orcamento->dentista }}</p>
            <p><strong>Data:</strong> {{ $orcamento->data->format('d/m/Y') }}</p>
            <p><strong>Válido por: 30 dias</p>
        </div>

        <div class="observations">
            <h2>Observações:</h2>
            @for ($i = 0; $i < 8; $i++)
                <div class="line"></div>
            @endfor
        </div>

        <div class="signatures">
            <div class="signature">
                <div class="line"></div>
                <p>Assinatura do Paciente</p>
            </div>
            <div class="signature" style="text-align: center; margin-top: 30px;">
                <div class="line"></div>
                <p>Assinatura do Dentista</p>
            </div>
        </div>

        <div class="footer">
            <p>Mais que sorrisos, motivos para sorrir.</p>
        </div>
    </div>
</body>
</html>
