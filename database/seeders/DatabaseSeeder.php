<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Регионы
        $regions = [
            [
                'name' => 'Казань',
                'slug' => 'kazan',
                'phone' => '+74952231925',
                'phone_display' => '+7 (495) 223-19-25',
                'email' => 'region@vtp-inz.ru',
                'address' => 'г. Казань, ул. Примерная, 1',
                'working_hours' => 'Пн-пт: 09:00–18:00',
                'sort' => 1,
            ],
            [
                'name' => 'Самара',
                'slug' => 'samara',
                'phone' => '+74952231925',
                'phone_display' => '+7 (495) 223-19-25',
                'email' => 'region@vtp-inz.ru',
                'address' => 'г. Самара, ул. Примерная, 1',
                'working_hours' => 'Пн-пт: 09:00–18:00',
                'sort' => 2,
            ],
            [
                'name' => 'Ростов-на-Дону',
                'slug' => 'rostov',
                'phone' => '+74952231925',
                'phone_display' => '+7 (495) 223-19-25',
                'email' => 'region@vtp-inz.ru',
                'address' => 'г. Ростов-на-Дону, ул. Примерная, 1',
                'working_hours' => 'Пн-пт: 09:00–18:00',
                'sort' => 3,
            ],
            [
                'name' => 'Санкт-Петербург',
                'slug' => 'spb',
                'phone' => '+74952231925',
                'phone_display' => '+7 (495) 223-19-25',
                'email' => 'region@vtp-inz.ru',
                'address' => 'г. Санкт-Петербург, ул. Примерная, 1',
                'working_hours' => 'Пн-пт: 09:00–18:00',
                'sort' => 4,
            ],
        ];

        foreach ($regions as $region) {
            DB::table('regions')->insert(array_merge($region, [
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // Настройки сайта
        $settings = [
            ['key' => 'site_name',        'value' => 'Название компании',       'label' => 'Название сайта',     'group' => 'general',   'type' => 'string'],
            ['key' => 'site_description', 'value' => 'Описание компании',       'label' => 'Описание сайта',     'group' => 'general',   'type' => 'text'],
            ['key' => 'default_phone',    'value' => '+7 (495) 223-19-25',      'label' => 'Телефон (общий)',    'group' => 'contacts',  'type' => 'string'],
            ['key' => 'default_email',    'value' => 'region@vtp-inz.ru',       'label' => 'Email (общий)',      'group' => 'contacts',  'type' => 'string'],
            ['key' => 'default_address',  'value' => 'г. Москва, ул. ...',      'label' => 'Адрес (общий)',      'group' => 'contacts',  'type' => 'string'],
            ['key' => 'working_hours',    'value' => 'Пн-пт: 09:00–18:00',     'label' => 'Время работы',       'group' => 'contacts',  'type' => 'string'],
            ['key' => 'yandex_metrika',   'value' => '',                        'label' => 'Яндекс.Метрика ID', 'group' => 'analytics', 'type' => 'string'],
            ['key' => 'footer_text',      'value' => '© 2025 Компания. Все права защищены.', 'label' => 'Текст футера', 'group' => 'general', 'type' => 'string'],
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->insert(array_merge($setting, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // Базовые страницы
        $pages = [
            ['title' => 'О компании', 'slug' => 'o-kompanii', 'type' => 'page',    'content' => '<p>Информация о компании</p>', 'sort' => 1],
            ['title' => 'Сертификаты', 'slug' => 'sertifikaty', 'type' => 'page',   'content' => '<p>Наши сертификаты</p>',      'sort' => 2],
            ['title' => 'Реквизиты',  'slug' => 'rekvizity',  'type' => 'page',    'content' => '<p>Реквизиты компании</p>',    'sort' => 3],
            ['title' => 'Цены',       'slug' => 'tseny',       'type' => 'page',   'content' => '<p>Прайс-лист</p>',            'sort' => 4],
        ];

        foreach ($pages as $page) {
            DB::table('pages')->insert(array_merge($page, [
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
