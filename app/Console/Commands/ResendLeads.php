<?php

namespace App\Console\Commands;

use App\Mail\LeadReceived;
use App\Mail\LeadsDigest;
use App\Models\Lead;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ResendLeads extends Command
{
    protected $signature = 'leads:resend
        {--each : Отправить каждую заявку отдельным письмом (как новые, с Reply-To)}
        {--ids= : Только заявки с этими ID (через запятую), напр. --ids=11 или --ids=11,12}
        {--since= : Только заявки с даты YYYY-MM-DD}
        {--force : Без подтверждения}';

    protected $description = 'Разослать существующие (старые) заявки на email-получателей';

    public function handle(): int
    {
        $recipients = collect(explode(',', (string) config('mail.lead_notify')))
            ->map(fn ($email) => trim($email))
            ->filter()
            ->values()
            ->all();

        if (empty($recipients)) {
            $this->error('Не задан получатель (config mail.lead_notify / LEAD_NOTIFY_EMAIL).');
            return self::FAILURE;
        }

        $query = Lead::query()->orderBy('created_at');
        if ($ids = $this->option('ids')) {
            $list = collect(explode(',', $ids))->map(fn ($i) => (int) trim($i))->filter()->all();
            $query->whereIn('id', $list);
        }
        if ($since = $this->option('since')) {
            $query->whereDate('created_at', '>=', $since);
        }
        $leads = $query->get();

        if ($leads->isEmpty()) {
            $this->info('Заявок для отправки нет.');
            return self::SUCCESS;
        }

        $mode = $this->option('each') ? "по одному письму на заявку ({$leads->count()} писем)" : 'одним письмом-списком';
        $this->info("Найдено заявок: {$leads->count()}");
        $this->info('Получатели: ' . implode(', ', $recipients));
        $this->info('Режим: ' . $mode);

        if (! $this->option('force') && ! $this->confirm('Отправить?', true)) {
            $this->warn('Отменено.');
            return self::SUCCESS;
        }

        try {
            if ($this->option('each')) {
                foreach ($leads as $lead) {
                    Mail::to($recipients)->send(new LeadReceived($lead));
                    $this->line("  отправлено: заявка #{$lead->id}");
                }
            } else {
                Mail::to($recipients)->send(new LeadsDigest($leads));
            }
        } catch (\Throwable $e) {
            $this->error('Ошибка отправки: ' . $e->getMessage());
            return self::FAILURE;
        }

        $this->info('Готово.');
        return self::SUCCESS;
    }
}
