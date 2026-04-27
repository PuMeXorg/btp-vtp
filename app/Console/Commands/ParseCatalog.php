<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use App\Models\Page;

class ParseCatalog extends Command
{
    protected $signature = 'parse:catalog';
    protected $description = 'Парсинг каталога шкафов автоматики';

    public function handle(): void
    {
        $client = new Client([
            'verify'  => false,
            'timeout' => 20,
            'headers' => ['User-Agent' => 'Mozilla/5.0'],
        ]);
        $base = 'https://www.teplovoy-punkt.ru';

        $items = [
            'programmirovanie-i-dispetcherizatsiya-shkafov-avtomatiki' => '/catalog/programmirovanie-i-dispetcherizatsiya-shkafov-avtomatiki/',
            'proektirovanie-shkafov-avtomatiki'   => '/catalog/proektirovanie-shkafov-avtomatiki/',
            'sborka-pod-zakaz-shkafov-avtomatiki' => '/catalog/sborka-pod-zakaz-shkafov-avtomatiki/',
        ];

        foreach ($items as $slug => $url) {
            try {
                $this->line("📥 Загружаю: {$url}");
                $html = $client->get($base . $url)->getBody()->getContents();
                $html = preg_replace('/<script[^>]*>.*?<\/script>/si', '', $html);
                $html = preg_replace('/<style[^>]*>.*?<\/style>/si', '', $html);

                preg_match('/<div[^>]*id=["\']content["\'][^>]*>(.*?)<div[^>]*id=["\'](?:form_vopros|footer)/si', $html, $m);
                $content = $m[1] ?? '';

                if (strlen(strip_tags($content)) > 50) {
                    $content = preg_replace('/src="\/upload\//i', 'src="' . $base . '/upload/', $content);
                    Page::where('slug', $slug)->update(['content' => $content, 'updated_at' => now()]);
                    $this->info("✓ Обновлено: {$slug}");
                } else {
                    $this->warn("✗ Контент не найден: {$slug}");
                }
                sleep(1);
            } catch (\Exception $e) {
                $this->error("✗ Ошибка {$slug}: " . $e->getMessage());
            }
        }

        $this->info('✅ Готово!');
    }
}
