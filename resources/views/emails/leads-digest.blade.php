<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin:0; padding:24px; background:#f4f4f5; font-family:Arial, Helvetica, sans-serif; color:#1a1a1a;">
    <div style="max-width:760px; margin:0 auto; background:#ffffff; border-radius:12px; overflow:hidden; border:1px solid #e5e7eb;">
        <div style="background:#cc0000; padding:18px 24px;">
            <h2 style="margin:0; color:#ffffff; font-size:18px;">Заявки с сайта — выгрузка ({{ $leads->count() }} шт.)</h2>
        </div>
        <table style="width:100%; border-collapse:collapse; font-size:13px;">
            <tr style="background:#fafafa; text-align:left;">
                <th style="padding:8px 12px; color:#6b7280;">#</th>
                <th style="padding:8px 12px; color:#6b7280;">Дата</th>
                <th style="padding:8px 12px; color:#6b7280;">Тип</th>
                <th style="padding:8px 12px; color:#6b7280;">Имя</th>
                <th style="padding:8px 12px; color:#6b7280;">Телефон</th>
                <th style="padding:8px 12px; color:#6b7280;">Email</th>
                <th style="padding:8px 12px; color:#6b7280;">Комментарий / страница</th>
            </tr>
            @foreach($leads as $lead)
            <tr style="border-top:1px solid #f0f0f0; vertical-align:top;">
                <td style="padding:8px 12px;">{{ $lead->id }}</td>
                <td style="padding:8px 12px; white-space:nowrap;">{{ optional($lead->created_at)->format('d.m.Y H:i') ?? '—' }}</td>
                <td style="padding:8px 12px;">{{ $lead->form_type === 'callback' ? 'Звонок' : 'Заявка' }}</td>
                <td style="padding:8px 12px;">{{ $lead->name ?: '—' }}</td>
                <td style="padding:8px 12px; white-space:nowrap;"><a href="tel:{{ $lead->phone }}" style="color:#cc0000;">{{ $lead->phone }}</a></td>
                <td style="padding:8px 12px;">{{ $lead->email ?: '—' }}</td>
                <td style="padding:8px 12px; color:#374151;">
                    {{ $lead->comment ?: '' }}
                    @if($lead->source_url)<br><span style="color:#9ca3af; font-size:11px; word-break:break-all;">{{ $lead->source_url }}</span>@endif
                </td>
            </tr>
            @endforeach
        </table>
        <div style="padding:14px 24px; background:#fafafa; color:#9ca3af; font-size:12px; border-top:1px solid #f0f0f0;">
            Разовая выгрузка существующих заявок из админки сайта (/admin → Заявки).
        </div>
    </div>
</body>
</html>
