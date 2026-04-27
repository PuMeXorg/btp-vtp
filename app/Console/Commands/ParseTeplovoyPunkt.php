<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ParseTeplovoyPunkt extends Command
{
    protected $signature   = 'parse:teplovoy';
    protected $description = 'Парсинг контента с teplovoy-punkt.ru';
    protected Client $client;
    protected string $base = 'https://www.teplovoy-punkt.ru';

    public function __construct()
    {
        parent::__construct();
        $this->client = new Client([
            'timeout'         => 20,
            'verify'          => false,
            'allow_redirects' => true,
            'headers'         => [
                'User-Agent'      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'Accept'          => 'text/html,application/xhtml+xml',
                'Accept-Language' => 'ru-RU,ru;q=0.9',
            ],
        ]);
    }

    public function handle(): void
    {
        $this->info('🚀 Начинаем парсинг teplovoy-punkt.ru...');
        $this->parsePortfolio();
        $this->parseNews();
        $this->parseVideos();
        $this->parseMissingServices();
        $this->updateContacts();
        $this->info('✅ Парсинг завершён!');
    }

    private function getHtml(string $url): string
    {
        try {
            $this->line("  📥 {$url}");
            $html = $this->client->get($url)->getBody()->getContents();
            sleep(1);
            return $html;
        } catch (\Exception $e) {
            $this->warn("  ✗ " . $e->getMessage());
            return '';
        }
    }

    private function extractContent(string $html): string
    {
        if (empty($html)) return '';
        $html = preg_replace('/<script[^>]*>.*?<\/script>/si', '', $html);
        $html = preg_replace('/<style[^>]*>.*?<\/style>/si', '', $html);
        $html = preg_replace('/<!--.*?-->/si', '', $html);

        $patterns = [
            '/<div[^>]*id=["\']content["\'][^>]*>(.*?)(?:<div[^>]*id=["\'](?:form_vopros|footer)["\'])/si',
            '/<div[^>]*class=["\'][^"\']*news[_-]detail[^"\']*["\'][^>]*>(.*?)<\/div>/si',
            '/<div[^>]*id=["\']content["\'][^>]*>(.*?)<div[^>]*class=["\'][^"\']*feedback/si',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $html, $m)) {
                $c = trim($m[1]);
                if (strlen(strip_tags($c)) > 50) {
                    $c = preg_replace('/src="\/upload\//i', 'src="' . $this->base . '/upload/', $c);
                    $c = preg_replace('/\s+class="[^"]*"/i', '', $c);
                    $c = preg_replace('/\s+style="[^"]*"/i', '', $c);
                    return $c;
                }
            }
        }
        return '';
    }

    private function extractTitle(string $html): string
    {
        preg_match('/<h1[^>]*>(.*?)<\/h1>/si', $html, $m);
        return trim(strip_tags($m[1] ?? ''));
    }

    private function extractImages(string $html): array
    {
        preg_match_all('/src="(https:\/\/www\.teplovoy-punkt\.ru\/upload\/[^"]+\.(jpg|jpeg|png|gif|webp))"/i', $html, $m);
        // Также ищем относительные пути
        preg_match_all('/src="(\/upload\/[^"]+\.(jpg|jpeg|png|gif|webp))"/i', $html, $m2);
        $relative = array_map(fn($u) => $this->base . $u, $m2[1] ?? []);
        return array_unique(array_merge($m[1] ?? [], $relative));
    }

    private function extractDate(string $html): ?\Carbon\Carbon
    {
        // Ищем дату в разных форматах
        if (preg_match('/(\d{2})\.(\d{2})\.(\d{4})/i', $html, $m)) {
            return \Carbon\Carbon::createFromFormat('d.m.Y', $m[0]);
        }
        if (preg_match('/(\d{4})-(\d{2})-(\d{2})/i', $html, $m)) {
            return \Carbon\Carbon::parse($m[0]);
        }
        return null;
    }

    // ========== ПОРТФОЛИО ==========
    private function parsePortfolio(): void
    {
        $this->info('🏗️  Парсинг портфолио...');

        $portfolioUrls = [
            // Монтаж ИТП
            ['url' => '/portfolio/montazh-itp-koptevskaya-65/itp-koptevskaya-65/',                         'category' => 'Монтаж ИТП'],
            ['url' => '/portfolio/montazh-itp-koptevskaya-65/itp-simferopolskiy-proezd-vld-7/',            'category' => 'Монтаж ИТП'],
            ['url' => '/portfolio/montazh-itp-koptevskaya-65/itp-feodosiyskaya-vld-7-k2/',                 'category' => 'Монтаж ИТП'],
            ['url' => '/portfolio/montazh-itp-koptevskaya-65/itp-malaya-yushunskaya-ulitsa-1/',            'category' => 'Монтаж ИТП'],
            ['url' => '/portfolio/montazh-itp-koptevskaya-65/itp-poselok-lytkarino-6-mikrorayon-korpus-1/', 'category' => 'Монтаж ИТП'],
            ['url' => '/portfolio/montazh-itp-koptevskaya-65/itp-balashikha-ulitsa-tvardovskogo-26/',      'category' => 'Монтаж ИТП'],
            ['url' => '/portfolio/montazh-itp-koptevskaya-65/itp-ulitsa-gazgoldernaya-8-str-8/',           'category' => 'Монтаж ИТП'],
            // Шкафы автоматики
            ['url' => '/portfolio/shkafy-avtomatiki/shkaf-upravleniya-nasosami-s-chastotnymi-preobrazovatelyami-danfoss/', 'category' => 'Шкафы автоматики'],
            ['url' => '/portfolio/shkafy-avtomatiki/shkaf-upravleniya-elektroprivodom-regada-sto/',        'category' => 'Шкафы автоматики'],
            ['url' => '/portfolio/shkafy-avtomatiki/dk-klenovo/',                                          'category' => 'Шкафы автоматики'],
            ['url' => '/portfolio/shkafy-avtomatiki/zhk-klenovo/',                                         'category' => 'Шкафы автоматики'],
        ];

        foreach ($portfolioUrls as $i => $item) {
            $html    = $this->getHtml($this->base . $item['url']);
            if (empty($html)) continue;

            $title   = $this->extractTitle($html);
            $content = $this->extractContent($html);
            $images  = $this->extractImages($html);

            if (empty($title)) {
                $this->warn("  ✗ Заголовок не найден: {$item['url']}");
                continue;
            }

            $slug = Str::slug($title);

            // Ищем существующую запись
            $existing = DB::table('portfolio')
                ->where('slug', $slug)
                ->orWhere('slug', 'like', '%' . Str::slug(explode(' ', $title)[0]) . '%')
                ->first();

            $data = [
                'title'      => $title,
                'category'   => $item['category'],
                'content'    => !empty($content) ? $content : "<p>{$title}</p>",
                'excerpt'    => mb_substr(strip_tags($content), 0, 200),
                'image'      => $images[0] ?? null,
                'updated_at' => now(),
            ];

            if ($existing) {
                DB::table('portfolio')->where('id', $existing->id)->update($data);
                $this->line("  ✓ Обновлено: {$title}" . (!empty($images) ? ' 🖼️ ' . count($images) . ' фото' : ''));
            } else {
                DB::table('portfolio')->insert(array_merge($data, [
                    'slug'       => $slug,
                    'is_active'  => true,
                    'sort'       => $i + 1,
                    'created_at' => now(),
                ]));
                $this->line("  ➕ Добавлено: {$title}" . (!empty($images) ? ' 🖼️' : ''));
            }
        }
    }

    // ========== НОВОСТИ ==========
    private function parseNews(): void
    {
        $this->info('📰 Парсинг новостей...');

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
        ];

        // Пробуем получить ещё новости
        $listHtml = $this->getHtml($this->base . '/news/');
        preg_match_all('/href="(\/news\/[^"\/][^"]+\/)"/i', $listHtml, $m);
        $extraUrls = array_filter(array_unique($m[1] ?? []), fn($u) => $u !== '/news/rss/' && $u !== '/news/');
        $allUrls = array_unique(array_merge($newsUrls, array_slice($extraUrls, 0, 20)));

        $this->line("  Всего новостей для парсинга: " . count($allUrls));

        foreach ($allUrls as $url) {
            $html    = $this->getHtml($this->base . $url);
            if (empty($html)) continue;

            $title   = $this->extractTitle($html);
            $content = $this->extractContent($html);
            $images  = $this->extractImages($html);
            $date    = $this->extractDate($html) ?? now()->subDays(rand(10, 365));

            if (empty($title)) continue;

            $slug   = Str::slug($title);
            $exists = DB::table('news')->where('slug', $slug)->orWhere('slug', 'like', $slug . '%')->exists();

            if (!$exists) {
                DB::table('news')->insert([
                    'title'        => $title,
                    'slug'         => $slug . '-' . rand(100, 999),
                    'content'      => !empty($content) ? $content : "<p>{$title}</p>",
                    'excerpt'      => mb_substr(strip_tags($content), 0, 200),
                    'image'        => $images[0] ?? null,
                    'is_active'    => true,
                    'published_at' => $date,
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);
                $this->line("  ✓ {$title}" . (!empty($images) ? ' 🖼️' : ''));
            } else {
                // Обновляем контент
                DB::table('news')->where('slug', 'like', $slug . '%')->update([
                    'content'    => !empty($content) ? $content : DB::raw('content'),
                    'image'      => $images[0] ?? DB::raw('image'),
                    'updated_at' => now(),
                ]);
                $this->line("  ~ Обновлено: {$title}");
            }
        }
    }

    // ========== ВИДЕО ==========
    private function parseVideos(): void
    {
        $this->info('🎬 Парсинг видео...');

        $html = $this->getHtml($this->base . '/video/');
        if (empty($html)) return;

        // Разные паттерны для YouTube
        $patterns = [
            '/youtube\.com\/embed\/([a-zA-Z0-9_-]{11})/i',
            '/youtu\.be\/([a-zA-Z0-9_-]{11})/i',
            '/watch\?v=([a-zA-Z0-9_-]{11})/i',
            '/data-video-id=["\']([a-zA-Z0-9_-]{11})["\']/',
            '/data-src=["\'][^"\']*youtube[^"\']*\/([a-zA-Z0-9_-]{11})["\']/',
        ];

        $ids = [];
        foreach ($patterns as $pattern) {
            preg_match_all($pattern, $html, $m);
            $ids = array_merge($ids, $m[1] ?? []);
        }
        $ids = array_unique($ids);

        // Также ищем в iframe
        preg_match_all('/<iframe[^>]*src=["\']([^"\']*youtube[^"\']*)["\'][^>]*>/i', $html, $iframes);
        foreach ($iframes[1] ?? [] as $src) {
            if (preg_match('/\/embed\/([a-zA-Z0-9_-]{11})/i', $src, $m)) {
                $ids[] = $m[1];
            }
        }
        $ids = array_unique($ids);

        if (empty($ids)) {
            // Пробуем найти через JavaScript
            preg_match_all('/["\']([a-zA-Z0-9_-]{11})["\'].*?youtube/i', $html, $m);
            $ids = array_unique($m[1] ?? []);
        }

        $this->line("  Найдено YouTube видео: " . count($ids));

        // Также попробуем спарсить страницу через RSS или sitemap
        if (empty($ids)) {
            $this->warn("  ⚠️  YouTube ID не найдены — возможно видео загружается через JS");
            $this->line("  💡 Добавьте YouTube ID вручную через админку /admin/videos");
        }

        foreach ($ids as $i => $ytId) {
            if (!DB::table('videos')->where('youtube_id', $ytId)->exists()) {
                DB::table('videos')->insert([
                    'title'      => "Видео " . ($i + 1),
                    'youtube_id' => $ytId,
                    'is_active'  => true,
                    'sort'       => $i + 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $this->line("  ✓ Добавлено: {$ytId}");
            }
        }
    }

    // ========== НЕДОСТАЮЩИЕ УСЛУГИ ==========
    private function parseMissingServices(): void
    {
        $this->info('🔧 Парсинг недостающих услуг...');

        // Ищем правильные URL через страницу услуг
        $html = $this->getHtml($this->base . '/uslugi/');
        preg_match_all('/href="(\/uslugi\/[^"\/]+\/)"/i', $html, $m);
        $serviceUrls = array_unique($m[1] ?? []);

        $this->line("  Найдено URL услуг: " . count($serviceUrls));

        foreach ($serviceUrls as $url) {
            $slug = trim(str_replace('/uslugi/', '', $url), '/');

            // Проверяем есть ли в базе
            $exists = DB::table('pages')->where('slug', $slug)->first();
            if (!$exists) {
                $this->warn("  ✗ Нет в базе: {$slug}");
                continue;
            }

            // Если контент пустой — парсим
            if (strlen(strip_tags($exists->content ?? '')) < 100) {
                $pageHtml = $this->getHtml($this->base . $url);
                $content  = $this->extractContent($pageHtml);
                $images   = $this->extractImages($pageHtml);

                if (!empty($content)) {
                    $update = ['content' => $content, 'updated_at' => now()];
                    if (!empty($images)) $update['image'] = $images[0];
                    DB::table('pages')->where('slug', $slug)->update($update);
                    $this->line("  ✓ Обновлено: {$slug}");
                }
            } else {
                $this->line("  — Уже есть: {$slug}");
            }
        }

        // Каталог — ищем правильные URL
        $catalogHtml = $this->getHtml($this->base . '/uslugi/');
        preg_match_all('/href="(\/[^"]*(?:shkafy|avtomatik)[^"]*\/)"/i', $catalogHtml, $m);
        foreach (array_unique($m[1] ?? []) as $url) {
            $this->line("  Найден URL каталога: {$url}");
        }
    }

    // ========== КОНТАКТЫ ==========
    private function updateContacts(): void
    {
        $this->info('📍 Обновление контактов...');

        DB::table('settings')->where('key', 'default_phone')->update(['value' => '+7 (495) 648-48-07']);
        DB::table('settings')->where('key', 'default_email')->update(['value' => 'zakaz@teplovoy-punkt.ru']);
        DB::table('settings')->where('key', 'default_address')->update(['value' => 'г. Москва, Дорожная улица, 60Б']);
        DB::table('settings')->where('key', 'working_hours')->update(['value' => 'Пн-пт: 08:00–18:00']);
        DB::table('settings')->where('key', 'site_name')->update(['value' => 'Мегаполис']);
        DB::table('settings')->where('key', 'footer_text')->update(['value' => '© ' . date('Y') . ' ООО «Мегаполис». Все права защищены.']);

        $this->line("  ✓ Контакты обновлены");

        // Сбрасываем кэш настроек
        \Illuminate\Support\Facades\Cache::flush();
        $this->line("  ✓ Кэш сброшен");
    }
}
