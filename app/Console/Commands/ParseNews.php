<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ParseNews extends Command
{
    protected $signature = 'parse:news';
    protected $description = 'Парсинг новостей с teplovoy-punkt.ru';

    protected string $base = 'https://www.teplovoy-punkt.ru';

    public function handle(): void
    {
        $client = new Client([
            'verify'  => false,
            'timeout' => 20,
            'headers' => ['User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'],
        ]);

        $newsUrls = [
            '/news/ooo-megapolis-podpisalo-dogovor-s-ooo-glavkapitalstroy-m-na-vypolnenie-kompleksa-rabot-vklyuchayushch/',
            '/news/ooo-megapolis-podpisalo-dogovor-s-ooo-glavkapitalstroy-m-na-vypolnenie-kompleksa-rabot/',
            '/news/ooo-megapolis-podpisalo-dogovor-s-ooo-domostroy-universal/',
            '/news/ooo-megapolis-podpisalo-dogovor-s-ooo-is-grupp/',
            '/news/ooo-megapolis-podpisalo-dogovor-s-ao-615-su-na-kompleks-rabot/',
            '/news/ooo-megapolis-podpisalo-dogovor-s-ooo-panteon-na-kompleks-rabot/',
            '/news/ooo-megapolis-podpisalo-dogovor-s-ooo-isk-rodina-na-kompleks-rabot--vklyuchayushchikh-montazh-puskon/',
            '/news/ooo-megapolis-podpisalo-dogovor-s-ooo-sz-timiryazevskiy-park-na-kompleks-stroitelnomontazhnykh-rabot/',
            '/news/ooo-megapolis-podpisalo-dogovor-s-ooo-femilisiti-na--provedenie-kompleks-rabot-vklyuchayushchiy-mont/',
            '/news/ooo-megapolis-podpisalo-dogovor-s-ooo-bask-na-provedenie-kompleksa-rabot/',
        ];

        // Удаляем старые тестовые новости
        DB::table('news')->truncate();
        $this->info('🗑️  Старые новости удалены');

        $sort = 1;
        foreach ($newsUrls as $url) {
            try {
                $this->line("📥 {$url}");
                $html = $client->get($this->base . $url)->getBody()->getContents();

                // Убираем скрипты и стили
                $html = preg_replace('/<script[^>]*>.*?<\/script>/si', '', $html);
                $html = preg_replace('/<style[^>]*>.*?<\/style>/si', '', $html);
                $html = preg_replace('/<!--.*?-->/si', '', $html);

                // Заголовок
                preg_match('/<h1[^>]*>(.*?)<\/h1>/si', $html, $titleM);
                $title = trim(strip_tags($titleM[1] ?? ''));

                if (empty($title)) {
                    // Пробуем из title тега
                    preg_match('/<title>(.*?)<\/title>/si', $html, $titleM2);
                    $title = trim(strip_tags(explode('|', $titleM2[1] ?? '')[0]));
                }

                if (empty($title)) {
                    $this->warn("  ✗ Заголовок не найден");
                    continue;
                }

                // Дата публикации
                $date = now()->subDays($sort * 30);
                if (preg_match('/(\d{2})\.(\d{2})\.(\d{4})/i', $html, $dM)) {
                    try { $date = Carbon::createFromFormat('d.m.Y', $dM[0]); } catch (\Exception $e) {}
                }

                // Контент — пробуем разные паттерны
                $content = '';
                $contentPatterns = [
                    '/<div[^>]*class=["\'][^"\']*news[_-]detail[^"\']*["\'][^>]*>(.*?)<\/div>\s*<\/div>/si',
                    '/<div[^>]*id=["\']content["\'][^>]*>(.*?)<div[^>]*(?:id=["\']form|class=["\'][^"\']*feedback)/si',
                    '/<div[^>]*class=["\'][^"\']*detail[_-]text[^"\']*["\'][^>]*>(.*?)<\/div>/si',
                    '/<div[^>]*id=["\']content["\'][^>]*>(.*?)<\/div>\s*<\/div>\s*<\/div>/si',
                ];

                foreach ($contentPatterns as $pattern) {
                    if (preg_match($pattern, $html, $cM)) {
                        $c = trim($cM[1]);
                        if (strlen(strip_tags($c)) > 30) {
                            $content = $c;
                            break;
                        }
                    }
                }

                // Если контент не найден — берём текст из body
                if (empty($content)) {
                    preg_match('/<body[^>]*>(.*?)<\/body>/si', $html, $bodyM);
                    $bodyText = strip_tags($bodyM[1] ?? '');
                    $bodyText = preg_replace('/\s+/', ' ', $bodyText);
                    // Ищем абзацы с текстом новости
                    if (str_contains($bodyText, $title)) {
                        $pos = strpos($bodyText, $title);
                        $content = '<p>' . trim(mb_substr($bodyText, $pos + mb_strlen($title), 1000)) . '</p>';
                    }
                }

                // Исправляем относительные пути изображений
                $content = preg_replace('/src="\/upload\//i', 'src="' . $this->base . '/upload/', $content);

                // Изображение
                preg_match_all('/src="(https:\/\/www\.teplovoy-punkt\.ru\/upload\/[^"]+\.(jpg|jpeg|png|gif))"/i', $content, $imgM);
                $image = $imgM[1][0] ?? null;

                $excerpt = mb_substr(strip_tags($content), 0, 200);
                if (empty($excerpt)) {
                    $excerpt = mb_substr($title, 0, 200);
                }

                $slug = Str::slug($title);

                DB::table('news')->insert([
                    'title'        => $title,
                    'slug'         => $slug . '-' . $sort,
                    'content'      => !empty($content) ? $content : "<p>{$title}</p>",
                    'excerpt'      => $excerpt,
                    'image'        => $image,
                    'is_active'    => true,
                    'published_at' => $date,
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);

                $this->info("  ✓ {$title}" . ($image ? ' 🖼️' : ''));
                $sort++;
                sleep(1);

            } catch (\Exception $e) {
                $this->error("  ✗ Ошибка: " . $e->getMessage());
            }
        }

        $this->info('');
        $this->info('✅ Новости импортированы: ' . DB::table('news')->count());
    }
}
