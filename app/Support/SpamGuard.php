<?php

namespace App\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Простой антиспам для форм заявок. Без сторонних сервисов и капчи.
 *
 * Логика: honeypot-поле + эвристики по содержимому (ссылки, латиница-казино,
 * стоп-слова). Спам не блокируется ошибкой, а тихо отбрасывается — контроллер
 * отдаёт обычный «успех», но заявку не сохраняет и письмо не шлёт. Так бот не
 * понимает, что его отсекли, и не подбирает обход.
 */
class SpamGuard
{
    /** Имя скрытого honeypot-поля в форме. */
    public const HONEYPOT = 'website';

    /** Хосты в тексте: ловим доменные имена, потом отсеиваем свой домен. */
    private const HOST_RE = '~(?:https?://)?((?:[a-z0-9-]+\.)+(?:ru|com|net|org|xyz|top|club|online|site|link|gl|ly|me|io|biz|info|shop|store|app|dev))\b~iu';

    /** Стоп-слова: казино/промо/крипто/фарма/займы. */
    private const KEYWORDS_RE = '~(casino|promo\s*code|bitcoin|crypto|betting|viagra|cialis|payday\s*loan|porn|\bnude\b|escort|\$\s?\d{3,}|high\s*roller|free\s*spins|казино|букмекер|крипт[оа]|биткоин)~iu';

    /**
     * @param  array<int,string>  $fields  Ключи полей запроса, которые проверяем на содержимое.
     */
    public static function isSpam(Request $request, array $fields = ['name', 'comment']): bool
    {
        // 1. Honeypot: реальный пользователь это поле не видит и не заполняет.
        if (filled($request->input(self::HONEYPOT))) {
            return self::flag($request, 'honeypot');
        }

        $ownHost = self::ownHost($request);

        foreach ($fields as $field) {
            $value = (string) $request->input($field);

            if ($value === '') {
                continue;
            }

            // Внешняя ссылка/домен в тексте — почти всегда спам. Ссылки на свой
            // же сайт разрешаем: клиент может прислать ссылку на нужный товар.
            if (preg_match_all(self::HOST_RE, $value, $m)) {
                foreach ($m[1] as $host) {
                    $host = strtolower(ltrim($host, '.'));
                    if ($host !== $ownHost && $host !== 'www.'.$ownHost && ! str_ends_with($host, '.'.$ownHost)) {
                        return self::flag($request, "url:{$field}");
                    }
                }
            }

            if (preg_match(self::KEYWORDS_RE, $value)) {
                return self::flag($request, "keyword:{$field}");
            }
        }

        return false;
    }

    /** Собственный домен сайта без www, для белого списка ссылок. */
    private static function ownHost(Request $request): string
    {
        $host = $request->getHost();
        $appHost = parse_url((string) config('app.url'), PHP_URL_HOST);

        return strtolower(preg_replace('~^www\.~i', '', $appHost ?: $host));
    }

    private static function flag(Request $request, string $reason): bool
    {
        Log::channel(config('logging.default'))->warning('Spam lead dropped', [
            'reason' => $reason,
            'ip' => $request->ip(),
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'comment' => $request->input('comment'),
        ]);

        return true;
    }
}
