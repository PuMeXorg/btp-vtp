<?php

namespace App\Services;

use App\Models\Lead;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Bitrix24Service
{
    protected string $webhookUrl;
    protected int $responsibleId;

    public function __construct()
    {
        $this->webhookUrl    = rtrim(config('services.bitrix24.webhook_url', ''), '/');
        $this->responsibleId = (int) config('services.bitrix24.responsible_id', 1);
    }

    public function createLead(Lead $lead): ?int
    {
        if (empty($this->webhookUrl)) {
            Log::warning('Bitrix24: webhook URL не настроен');
            return null;
        }

        try {
            $response = Http::timeout(10)->post(
                $this->webhookUrl . '/crm.lead.add.json',
                [
                    'fields' => [
                        'TITLE'          => 'Заявка с сайта' . ($lead->region ? " ({$lead->region})" : ''),
                        'NAME'           => $lead->name ?? 'Не указано',
                        'PHONE'          => [['VALUE' => $lead->phone, 'VALUE_TYPE' => 'WORK']],
                        'EMAIL'          => $lead->email
                                            ? [['VALUE' => $lead->email, 'VALUE_TYPE' => 'WORK']]
                                            : [],
                        'COMMENTS'       => $this->buildComment($lead),
                        'SOURCE_ID'      => 'WEB',
                        'SOURCE_DESCRIPTION' => 'Сайт: ' . ($lead->source_url ?? ''),
                        'ASSIGNED_BY_ID' => $this->responsibleId,
                    ],
                ]
            );

            if ($response->successful()) {
                $bitrix24Id = $response->json('result');
                if ($bitrix24Id) {
                    $lead->update(['bitrix24_lead_id' => $bitrix24Id]);
                    return $bitrix24Id;
                }
            }

            Log::error('Bitrix24: ошибка создания лида', [
                'status'   => $response->status(),
                'response' => $response->body(),
            ]);

        } catch (\Exception $e) {
            Log::error('Bitrix24: исключение', ['message' => $e->getMessage()]);
        }

        return null;
    }

    private function buildComment(Lead $lead): string
    {
        $lines = [];
        if ($lead->name)       $lines[] = "Имя: {$lead->name}";
        if ($lead->phone)      $lines[] = "Телефон: {$lead->phone}";
        if ($lead->email)      $lines[] = "Email: {$lead->email}";
        if ($lead->region)     $lines[] = "Регион: {$lead->region}";
        if ($lead->form_type)  $lines[] = "Тип формы: {$lead->form_type}";
        if ($lead->comment)    $lines[] = "Комментарий: {$lead->comment}";
        if ($lead->source_url) $lines[] = "Страница: {$lead->source_url}";
        return implode("\n", $lines);
    }
}