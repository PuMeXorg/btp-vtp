<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ImportSeeder extends Seeder
{
    public function run(): void
    {
        // ===== УСЛУГИ (ИТП) =====
        $itp = DB::table('pages')->insertGetId([
            'title'      => 'Индивидуальные тепловые пункты (ИТП)',
            'slug'       => 'individualnyy-teplovoy-punkt',
            'type'       => 'service',
            'excerpt'    => 'Проектирование, монтаж и сдача ИТП под ключ',
            'content'    => '<p>Полный комплекс услуг по индивидуальным тепловым пунктам: проектирование, монтаж, пусконаладка и сдача в ПАО МОЭК и МТУ Ростехнадзора.</p>',
            'is_active'  => true,
            'sort'       => 1,
            'created_at' => now(), 'updated_at' => now(),
        ]);

        $services = [
            ['title' => 'Блочный тепловой пункт (БТП)',                                  'slug' => 'blochnyy-teplovoy-punkt',                         'sort' => 1],
            ['title' => 'Монтаж тепловых пунктов со сдачей в ПАО «МОЭК»',               'slug' => 'montazh-teplovykh-punktov-so-sdachey-v-pao-moek', 'sort' => 2],
            ['title' => 'Поставка и монтаж узла учёта тепловой энергии',                 'slug' => 'postavka-i-montazh-uzla-ucheta-teplovoy-energii',  'sort' => 3],
            ['title' => 'Проектирование ОВ, ВК и теплосети с согласованием в ПАО «МОЭК»','slug' => 'proektirovanie-ov-vk-i-teploseti',                'sort' => 4],
            ['title' => 'Проектирование тепловых пунктов с согласованием в ПАО «МОЭК»', 'slug' => 'proektirovanie-teplovykh-punktov',                 'sort' => 5],
            ['title' => 'Узел учёта тепловой энергии (УУТЭ)',                            'slug' => 'uzel-ucheta-teplovoy-energii',                     'sort' => 6],
            ['title' => 'Центральный тепловой пункт (ЦТП)',                              'slug' => 'tsentralnyy-teplovoy-punkt',                       'sort' => 7],
        ];

        foreach ($services as $s) {
            DB::table('pages')->insert(array_merge($s, [
                'type'       => 'service',
                'parent_id'  => $itp,
                'content'    => '<p>Описание услуги</p>',
                'is_active'  => true,
                'created_at' => now(), 'updated_at' => now(),
            ]));
        }

        // ===== КАТАЛОГ (Шкафы автоматики) =====
        $catalog = DB::table('pages')->insertGetId([
            'title'      => 'Шкафы автоматики',
            'slug'       => 'shkafy-avtomatiki',
            'type'       => 'catalog',
            'excerpt'    => 'Проектирование, сборка и программирование шкафов автоматики',
            'content'    => '<p>Собственное сертифицированное производство щитового оборудования.</p>',
            'is_active'  => true,
            'sort'       => 1,
            'created_at' => now(), 'updated_at' => now(),
        ]);

        $catalogItems = [
            ['title' => 'Программирование и диспетчеризация шкафов автоматики', 'slug' => 'programmirovanie-i-dispetcherizatsiya', 'sort' => 1],
            ['title' => 'Проектирование шкафов автоматики',                     'slug' => 'proektirovanie-shkafov-avtomatiki',     'sort' => 2],
            ['title' => 'Сборка под заказ шкафов автоматики',                   'slug' => 'sborka-pod-zakaz-shkafov-avtomatiki',   'sort' => 3],
        ];

        foreach ($catalogItems as $c) {
            DB::table('pages')->insert(array_merge($c, [
                'type'       => 'catalog',
                'parent_id'  => $catalog,
                'content'    => '<p>Описание раздела каталога</p>',
                'is_active'  => true,
                'created_at' => now(), 'updated_at' => now(),
            ]));
        }

        // ===== ПОРТФОЛИО =====
        $portfolio = [
            // Монтаж ИТП
            ['title' => 'ИТП Коптевская 65',                          'slug' => 'itp-koptevskaya-65',              'category' => 'Монтаж ИТП'],
            ['title' => 'ИТП Симферопольский проезд влд 7',           'slug' => 'itp-simferopolskiy-proezd-vld-7', 'category' => 'Монтаж ИТП'],
            ['title' => 'ИТП Феодосийская влд 7 к2',                  'slug' => 'itp-feodosiyskaya-vld-7-k2',      'category' => 'Монтаж ИТП'],
            ['title' => 'ИТП Малая Юшуньская улица, 1',               'slug' => 'itp-malaya-yushunskaya-ulitsa-1', 'category' => 'Монтаж ИТП'],
            ['title' => 'ИТП Лыткарино, 6 микрорайон, корпус 1',      'slug' => 'itp-lytkarino-6-mikrorayon',      'category' => 'Монтаж ИТП'],
            ['title' => 'ИТП Балашиха, улица Твардовского, 26',       'slug' => 'itp-balashikha-tvardovskogo-26',  'category' => 'Монтаж ИТП'],
            ['title' => 'ИТП, улица Газгольдерная, 8 стр. 8',         'slug' => 'itp-gazgoldernaya-8',             'category' => 'Монтаж ИТП'],
            // Шкафы автоматики
            ['title' => 'Шкаф управления насосами Ridan',            'slug' => 'shkaf-Ridan',                   'category' => 'Шкафы автоматики'],
            ['title' => 'Шкаф управления электроприводом Regada STO',  'slug' => 'shkaf-regada-sto',                'category' => 'Шкафы автоматики'],
            ['title' => 'ДК «Кленово»',                                'slug' => 'dk-klenovo',                      'category' => 'Шкафы автоматики'],
            ['title' => 'ЖК «Кленово»',                                'slug' => 'zhk-klenovo',                     'category' => 'Шкафы автоматики'],
        ];

        foreach ($portfolio as $i => $p) {
            DB::table('portfolio')->insert(array_merge($p, [
                'content'    => '<p>Описание проекта</p>',
                'is_active'  => true,
                'sort'       => $i + 1,
                'created_at' => now(), 'updated_at' => now(),
            ]));
        }

        // ===== ВИДЕО =====
        // YouTube ID берём из реальных видео канала teplovoy-punkt
        $videos = [
            ['title' => 'Монтаж индивидуального теплового пункта',         'youtube_id' => 'example1', 'sort' => 1],
            ['title' => 'Проектирование ИТП — этапы работы',               'youtube_id' => 'example2', 'sort' => 2],
            ['title' => 'Сдача теплового пункта в ПАО МОЭК',               'youtube_id' => 'example3', 'sort' => 3],
            ['title' => 'Шкаф автоматики — сборка и программирование',     'youtube_id' => 'example4', 'sort' => 4],
        ];

        foreach ($videos as $v) {
            DB::table('videos')->insert(array_merge($v, [
                'is_active'  => true,
                'created_at' => now(), 'updated_at' => now(),
            ]));
        }

        // ===== НОВОСТИ (структура — контент заполните в админке) =====
        $news = [
            ['title' => 'Успешная сдача ИТП в Балашихе',              'slug' => 'sdacha-itp-balashikha',    'published_at' => '2024-11-01'],
            ['title' => 'Новый проект: ИТП для жилого комплекса',     'slug' => 'itp-zhiloy-kompleks',      'published_at' => '2024-10-15'],
            ['title' => 'Расширение производства шкафов автоматики',  'slug' => 'rasshirenie-proizvodstva', 'published_at' => '2024-09-20'],
            ['title' => 'Получены новые сертификаты соответствия',    'slug' => 'novye-sertifikaty',        'published_at' => '2024-08-10'],
        ];

        foreach ($news as $n) {
            DB::table('news')->insert(array_merge($n, [
                'content'    => '<p>Текст новости. Заполните в админке.</p>',
                'excerpt'    => 'Краткое описание новости',
                'is_active'  => true,
                'created_at' => now(), 'updated_at' => now(),
            ]));
        }

        $this->command->info('✅ Данные с teplovoy-punkt.ru импортированы!');
        $this->command->warn('⚠️  Замените youtube_id в видео на реальные ID из YouTube канала компании.');
    }
}
