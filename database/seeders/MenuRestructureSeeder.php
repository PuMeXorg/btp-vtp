cat > database/seeders/MenuRestructureSeeder.php << 'EOF'
<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class MenuRestructureSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | О компании
        |--------------------------------------------------------------------------
        */

        Page::updateOrCreate(
            ['slug' => 'o-kompanii'],
            [
                'title' => 'О нас',
                'type' => 'page',
                'parent_id' => null,
                'sort' => 1,
                'is_active' => true,
                'content' => '<p>Информация о компании ВТП Инжиниринг. Текст можно отредактировать в админке.</p>',
            ]
        );

        Page::updateOrCreate(
            ['slug' => 'sertifikaty'],
            [
                'title' => 'Сертификаты ВТП',
                'type' => 'page',
                'parent_id' => null,
                'sort' => 2,
                'is_active' => true,
                'content' => '<p>Сертификаты компании ВТП. Загрузите изображения и документы через админку.</p>',
            ]
        );

        Page::updateOrCreate(
            ['slug' => 'sobstvennoe-proizvodstvo'],
            [
                'title' => 'Собственное производство',
                'type' => 'page',
                'parent_id' => null,
                'sort' => 3,
                'is_active' => true,
                'content' => '<p>Описание собственного производства компании. Текст можно отредактировать в админке.</p>',
            ]
        );

        // Реквизиты пока скрываем, так как в новой структуре заказчика их нет
        Page::where('slug', 'rekvizity')->update(['is_active' => false]);

        /*
        |--------------------------------------------------------------------------
        | Услуги
        |--------------------------------------------------------------------------
        */

        // БТП — используем существующую страницу БТП, но делаем её верхним пунктом услуг
        $btp = Page::updateOrCreate(
            ['slug' => 'blochnyy-teplovoy-punkt'],
            [
                'title' => 'БТП',
                'type' => 'service',
                'parent_id' => null,
                'sort' => 1,
                'is_active' => true,
                'excerpt' => 'Блочные тепловые пункты под ключ.',
                'content' => '<p>Описание услуги БТП. Текст можно заменить через админку.</p>',
            ]
        );

        // Насосные станции
        $pumpStations = Page::updateOrCreate(
            ['slug' => 'nasosnye-stantsii'],
            [
                'title' => 'Насосные станции',
                'type' => 'service',
                'parent_id' => null,
                'sort' => 2,
                'is_active' => true,
                'excerpt' => 'Проектирование, производство и монтаж насосных станций.',
                'content' => '<p>Описание насосных станций. Здесь можно добавить 3 раздела с описанием станций.</p>',
            ]
        );

        // Тепловые пункты
        $thermalPoints = Page::updateOrCreate(
            ['slug' => 'teplovye-punkty'],
            [
                'title' => 'Тепловые пункты',
                'type' => 'service',
                'parent_id' => null,
                'sort' => 3,
                'is_active' => true,
                'excerpt' => 'ИТП и ЦТП под ключ.',
                'content' => '<p>Общий раздел по тепловым пунктам: ИТП и ЦТП.</p>',
            ]
        );

        // ИТП — используем старую страницу
        Page::updateOrCreate(
            ['slug' => 'individualnyy-teplovoy-punkt'],
            [
                'title' => 'ИТП',
                'type' => 'service',
                'parent_id' => $thermalPoints->id,
                'sort' => 1,
                'is_active' => true,
                'excerpt' => 'Индивидуальные тепловые пункты.',
                'content' => '<p>Описание ИТП. Можно отредактировать в админке.</p>',
            ]
        );

        // ЦТП — используем старую страницу
        Page::updateOrCreate(
            ['slug' => 'tsentralnyy-teplovoy-punkt'],
            [
                'title' => 'ЦТП',
                'type' => 'service',
                'parent_id' => $thermalPoints->id,
                'sort' => 2,
                'is_active' => true,
                'excerpt' => 'Центральные тепловые пункты.',
                'content' => '<p>Описание ЦТП. Можно отредактировать в админке.</p>',
            ]
        );

        // Проектирование
        Page::updateOrCreate(
            ['slug' => 'proektirovanie'],
            [
                'title' => 'Проектирование',
                'type' => 'service',
                'parent_id' => null,
                'sort' => 4,
                'is_active' => true,
                'excerpt' => 'Проектирование тепловых пунктов и внутренних инженерных систем.',
                'content' => '<p>Проектирование тепловых пунктов, БТП, насосных станций и внутренних инженерных систем.</p>',
            ]
        );

        // Производство электрощитового оборудования
        Page::updateOrCreate(
            ['slug' => 'proizvodstvo-elektroshitovogo-oborudovaniya'],
            [
                'title' => 'Производство электрощитового оборудования',
                'type' => 'service',
                'parent_id' => null,
                'sort' => 5,
                'is_active' => true,
                'excerpt' => 'Проектирование и производство электрощитового оборудования.',
                'content' => '<p>Описание производства электрощитового оборудования. Можно добавить фото производства, этапы сборки и преимущества.</p>',
            ]
        );

        // Пусконаладка
        Page::updateOrCreate(
            ['slug' => 'puskonaladka'],
            [
                'title' => 'Пусконаладка',
                'type' => 'service',
                'parent_id' => null,
                'sort' => 6,
                'is_active' => true,
                'excerpt' => 'Пусконаладочные работы для ИТП, ЦТП, БТП и насосных станций.',
                'content' => '<p>Описание пусконаладочных работ. Можно отредактировать в админке.</p>',
            ]
        );

        // Автоматизация ИТП и ЦТП
        $automation = Page::updateOrCreate(
            ['slug' => 'avtomatizatsiya-itp-i-ctp'],
            [
                'title' => 'Автоматизация ИТП и ЦТП',
                'type' => 'service',
                'parent_id' => null,
                'sort' => 7,
                'is_active' => true,
                'excerpt' => 'Автоматизация тепловых пунктов на базе современных контроллеров.',
                'content' => '<p>Автоматизация ИТП и ЦТП. Ниже представлены используемые решения и производители.</p>',
            ]
        );

        $automationBrands = [
            ['title' => 'ТЕКОН', 'slug' => 'tekon', 'sort' => 1],
            ['title' => 'Трансформер', 'slug' => 'transformer', 'sort' => 2],
            ['title' => 'ОВЕН', 'slug' => 'oven', 'sort' => 3],
            ['title' => 'Segnetics', 'slug' => 'Segnetics', 'sort' => 4],
            ['title' => 'Ridan / Ридан', 'slug' => 'danfos', 'sort' => 5],
        ];

        foreach ($automationBrands as $brand) {
            Page::updateOrCreate(
                ['slug' => $brand['slug']],
                [
                    'title' => $brand['title'],
                    'type' => 'service',
                    'parent_id' => $automation->id,
                    'sort' => $brand['sort'],
                    'is_active' => true,
                    'excerpt' => 'Описание решения ' . $brand['title'] . '.',
                    'content' => '<p>Описание решения ' . $brand['title'] . '. Здесь можно рассказать, где применяется оборудование, какие задачи решает и какие преимущества даёт.</p>',
                ]
            );
        }

        // Монтаж под ключ
        $turnkey = Page::updateOrCreate(
            ['slug' => 'montazh-pod-klyuch'],
            [
                'title' => 'Монтаж под ключ',
                'type' => 'service',
                'parent_id' => null,
                'sort' => 8,
                'is_active' => true,
                'excerpt' => 'Монтаж БТП и насосных станций под ключ.',
                'content' => '<p>Комплексный монтаж оборудования под ключ: от подготовки до сдачи объекта.</p>',
            ]
        );

        Page::updateOrCreate(
            ['slug' => 'montazh-btp-pod-klyuch'],
            [
                'title' => 'БТП',
                'type' => 'service',
                'parent_id' => $turnkey->id,
                'sort' => 1,
                'is_active' => true,
                'excerpt' => 'Монтаж БТП под ключ.',
                'content' => '<p>Описание монтажа БТП под ключ.</p>',
            ]
        );

        Page::updateOrCreate(
            ['slug' => 'montazh-nasosnykh-stantsiy-pod-klyuch'],
            [
                'title' => 'Насосные станции',
                'type' => 'service',
                'parent_id' => $turnkey->id,
                'sort' => 2,
                'is_active' => true,
                'excerpt' => 'Монтаж насосных станций под ключ.',
                'content' => '<p>Описание монтажа насосных станций под ключ.</p>',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Цены
        |--------------------------------------------------------------------------
        */

        Page::updateOrCreate(
            ['slug' => 'tseny'],
            [
                'title' => 'Цены',
                'type' => 'page',
                'parent_id' => null,
                'sort' => 4,
                'is_active' => true,
                'content' => '
                    <h2>Цены</h2>
                    <table>
                        <tr><td>БТП</td><td>от 800 000 ₽</td></tr>
                        <tr><td>Насосные станции</td><td>от 300 000 ₽</td></tr>
                        <tr><td>Проектирование</td><td>по расчёту</td></tr>
                        <tr><td>Проектирование внутренних инженерных систем</td><td>от 210 000 ₽</td></tr>
                    </table>
                ',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Скрываем старые пункты, которые не нужны в новой структуре
        |--------------------------------------------------------------------------
        */

        $hideSlugs = [
            'postavka-i-montazh-uzla-ucheta-teplovoy-energii',
            'uzel-ucheta-teplovoy-energii',
            'montazh-teplovykh-punktov-so-sdachey-v-pao-moek-i-mtu-rostekhnadzora',
            'proektirovanie-ov-vk-i-teploseti-s-soglasovaniem-v-pao-moek',
            'proektirovanie-teplovykh-punktov-s-soglasovaniem-v-pao-moek',
            'algoritm-soglasovaniya-proektnoy-dokumentatsii',
            'algoritm-raboty-pod-klyuch-po-itp',
            'algoritm-montazha-i-sdachi-itp',
            'algoritm-soglasovaniya-proektnoy-dokumentatsii-s-pao-moek',
            'algoritm-raboty-pod-klyuch-po-itp-ot-proektirovaniya',
            'algoritm-montazha-i-sdachi-itp-soglasovannyy-proekt',
            'shkafy-avtomatiki',
            'programmirovanie-i-dispetcherizatsiya-shkafov-avtomatiki',
            'proektirovanie-shkafov-avtomatiki',
            'sborka-pod-zakaz-shkafov-avtomatiki',
        ];

        Page::whereIn('slug', $hideSlugs)->update(['is_active' => false]);

        $this->command->info('Новая структура меню создана.');
    }
}
EOF