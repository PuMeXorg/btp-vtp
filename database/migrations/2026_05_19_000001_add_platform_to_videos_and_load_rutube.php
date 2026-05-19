<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('videos', 'platform')) {
            Schema::table('videos', function (Blueprint $t) {
                $t->string('platform', 20)->default('youtube')->after('youtube_id');
            });
        }

        DB::table('videos')->delete();

        $items = [
            ['ПНР, ул. Абрамцевская, 16 стр.1, Москва', '4267d516a43317e685372c0ce2874541'],
            ['ПНР, ул. Насосная, 1А, Москва', '61ec188d4691adde3a2333f5a8fd5b83'],
            ['ИТП, многофункциональное здание, ул. Газгольдерная, 8 стр. 8', 'c93ffcc53cd56c96ae279be5dffe058d'],
            ['ИТП, жилой корпус Западное Дегунино, ул. Верхнелихоборская, 6', 'b8d75c1e77adba70eab6ac980544d55c'],
            ['ИТП, ЖК «В стремлении к свету», ул. Илимская, вл. 3, Москва', '1ef9f051071f08425a1670628676bd8e'],
            ['ИТП, ЖК «Светлый мир «Станция Л…», ул. Люблинская, вл. 72', '0fe9539ead74d58b97bfc4826bd58c47'],
            ['ИТП, ЖК «Сказочный лес», ул. Лосиноостровская, 24к1, Москва', '46ef701d9f961982442f503004eac3e4'],
            ['ИТП, ЖК «Сказочный лес», ул. Лосиноостровская, 24к4, Москва', 'bb53960e9c719e59a10049a246de1133'],
            ['ИТП, ЖК Посольства Республики Беларусь в РФ, Погонный пр-д, 7', '6d20ca65e82f67f1c2e24e8d03144233'],
            ['ИТП, ТЦ, пос. Вешки, г.о. Мытищи', '7a18618a03f4bcaee78edfd83e21522b'],
            ['ИТП, ЖК «Облака 2.0», ул. Транспортная, д.1, корпус 1.1, Люберцы', 'c9524bfe9301c9a3f0066bee2d7ff39b'],
            ['ИТП, жилой дом фонда реновации, ул. Шумилова, 4, Москва', '36642468105dbdf6d71f46310f2795ff'],
            ['ИТП, ЖК «Новотомилино», корпус 1', 'd0f03a386c4b0a10627e82b173115b52'],
            ['ИТП, школа, ул. Летная, 7, Балашиха', 'bd8ba22460050b624042cef03a84c638'],
            ['ИТП, жилой дом, корпуса 2-3, Лыткарино', '0f9f94be9bfb54d61349bf963df8b0d1'],
            ['ИТП, детский сад, ул. Юннатов, 8 стр. 1, Балашиха', 'a275db0cc72566af5899a38f9add391c'],
            ['ИТП, Комсомольский пр., 7 корп. 1', 'ebe4aa8643a02d03cc13e347d96b9982'],
            ['ИТП, бизнес-центр, ул. Коптевская, 65, Москва', 'd5346b335f854d7fe08636694029d5ab'],
            ['ИТП, жилой дом фонда реновации, Феодосийская 7к1, Москва', '2940815b4b42d6750e37cad35d5bb67c'],
            ['ИТП, жилой дом, пос. Лыткарино, 6 микрорайон, корпус 1', '43618620245231bcb432e15efe2a00ab'],
        ];

        $now = now();
        $rows = [];
        foreach ($items as $i => [$title, $id]) {
            $rows[] = [
                'title' => $title,
                'youtube_id' => $id,
                'platform' => 'rutube',
                'preview' => null,
                'is_active' => true,
                'sort' => ($i + 1) * 10,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }
        DB::table('videos')->insert($rows);
    }

    public function down(): void {}
};
