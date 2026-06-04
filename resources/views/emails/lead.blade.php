<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin:0; padding:24px; background:#f4f4f5; font-family:Arial, Helvetica, sans-serif; color:#1a1a1a;">
    <div style="max-width:560px; margin:0 auto; background:#ffffff; border-radius:12px; overflow:hidden; border:1px solid #e5e7eb;">
        <div style="background:#cc0000; padding:18px 24px;">
            <h2 style="margin:0; color:#ffffff; font-size:18px;">Новая заявка с сайта</h2>
        </div>
        <table style="width:100%; border-collapse:collapse; font-size:14px;">
            <tr><td style="padding:10px 24px; color:#6b7280; width:160px;">Тип</td><td style="padding:10px 24px; font-weight:bold;">{{ $lead->form_type === 'callback' ? 'Обратный звонок' : 'Заявка на услугу' }}</td></tr>
            <tr style="border-top:1px solid #f0f0f0;"><td style="padding:10px 24px; color:#6b7280;">Имя</td><td style="padding:10px 24px;">{{ $lead->name ?: '—' }}</td></tr>
            <tr style="border-top:1px solid #f0f0f0;"><td style="padding:10px 24px; color:#6b7280;">Телефон</td><td style="padding:10px 24px;"><a href="tel:{{ $lead->phone }}" style="color:#cc0000;">{{ $lead->phone }}</a></td></tr>
            @if($lead->email)
            <tr style="border-top:1px solid #f0f0f0;"><td style="padding:10px 24px; color:#6b7280;">Email</td><td style="padding:10px 24px;"><a href="mailto:{{ $lead->email }}" style="color:#cc0000;">{{ $lead->email }}</a></td></tr>
            @endif
            @if($lead->comment)
            <tr style="border-top:1px solid #f0f0f0;"><td style="padding:10px 24px; color:#6b7280;">Комментарий</td><td style="padding:10px 24px;">{{ $lead->comment }}</td></tr>
            @endif
            @if($lead->region)
            <tr style="border-top:1px solid #f0f0f0;"><td style="padding:10px 24px; color:#6b7280;">Регион</td><td style="padding:10px 24px;">{{ $lead->region }}</td></tr>
            @endif
            @if($lead->source_url)
            <tr style="border-top:1px solid #f0f0f0;"><td style="padding:10px 24px; color:#6b7280;">Страница</td><td style="padding:10px 24px;"><a href="{{ $lead->source_url }}" style="color:#cc0000; word-break:break-all;">{{ $lead->source_url }}</a></td></tr>
            @endif
            <tr style="border-top:1px solid #f0f0f0;"><td style="padding:10px 24px; color:#6b7280;">Время</td><td style="padding:10px 24px;">{{ optional($lead->created_at)->format('d.m.Y H:i') ?? '—' }}</td></tr>
        </table>
        <div style="padding:14px 24px; background:#fafafa; color:#9ca3af; font-size:12px; border-top:1px solid #f0f0f0;">
            Заявка №{{ $lead->id }} · также сохранена в админке сайта (/admin → Заявки).
        </div>
    </div>
</body>
</html>
