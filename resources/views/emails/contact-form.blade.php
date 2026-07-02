<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; color: #333; line-height: 1.6; }
        .container { max-w-[600px] mx-auto p-6 bg-gray-50 border border-gray-200 rounded-lg; }
        h2 { color: #45B500; }
        .details { background: #fff; padding: 15px; border-radius: 5px; border: 1px solid #eee; }
        .details p { margin-bottom: 5px; }
        .message-box { background: #f9f9f9; padding: 15px; border-left: 4px solid #45B500; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Novo pedido de contacto pelo website</h2>
        <p>Recebeu uma nova mensagem no formulário de contactos da Fresmart.</p>

        <div class="details">
            <p><strong>Nome:</strong> {{ $contactMessage->name }}</p>
            <p><strong>E-mail:</strong> {{ $contactMessage->email }}</p>
            <p><strong>Assunto:</strong> {{ $contactMessage->subject }}</p>
        </div>

        <div class="message-box">
            <strong>Mensagem:</strong><br><br>
            {!! nl2br(e($contactMessage->message)) !!}
        </div>
        
        <p style="margin-top: 30px; font-size: 12px; color: #999;">Esta mensagem foi enviada automaticamente pelo sistema da Fresmart.</p>
    </div>
</body>
</html>
