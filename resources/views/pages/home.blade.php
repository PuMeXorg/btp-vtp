@php
    $heroBlock = $hero ?? null;

    $badgeText = $heroBlock->badge_text ?? 'Более 500 объектов сдано в эксплуатацию';
    $titleMain = $heroBlock->title ?? 'Монтаж тепловых пунктов под ключ';
    $titleAccent = $heroBlock->accent_text ?? 'от 40 дней';
    $description = $heroBlock->subtitle ?? 'Проектирование, монтаж и сдача ИТП, ЦТП и УУТЭ в ПАО «МОЭК» и МТУ Ростехнадзора';

    $primaryButtonText = $heroBlock->button_text ?? 'Получить расчёт бесплатно';
    $primaryButtonLink = $heroBlock->button_link ?? '#';

    $secondaryButtonText = $heroBlock->button2_text ?? 'Наши проекты';
    $secondaryButtonLink = $heroBlock->button2_link ?? '/portfolio';

    $heroImage = null;
    if (!empty($heroBlock?->image)) {
        $heroImage = str_starts_with($heroBlock->image, 'http')
            ? $heroBlock->image
            : asset('storage/' . ltrim($heroBlock->image, '/'));
    }

    $benefits = $heroBlock->benefits ?? null;
    if (is_string($benefits)) {
        $benefits = json_decode($benefits, true);
    }
    if (!is_array($benefits) || empty($benefits)) {
        $benefits = [
            'Ускоренное согласование в МОЭК',
            'Собственное производство',
            'Гарантия на работы',
        ];
    }

    $stats = $heroBlock->stats ?? null;
    if (is_string($stats)) {
        $stats = json_decode($stats, true);
    }
    if (!is_array($stats) || empty($stats)) {
        $stats = [
            ['value' => '500+', 'label' => 'объектов'],
            ['value' => '15', 'label' => 'лет опыта'],
            ['value' => '40', 'label' => 'дней срок'],
        ];
    }

    $bottomFeatures = $heroBlock->bottom_features ?? null;
    if (is_string($bottomFeatures)) {
        $bottomFeatures = json_decode($bottomFeatures, true);
    }
    if (!is_array($bottomFeatures) || empty($bottomFeatures)) {
        $bottomFeatures = [
            ['title' => 'Сдача в МОЭК', 'text' => 'и МТУ Ростехнадзора'],
            ['title' => 'Ускоренное', 'text' => 'согласование проектов'],
            ['title' => 'Собственное', 'text' => 'производство щитов'],
            ['title' => 'Дилеры', 'text' => 'ведущих производителей'],
        ];
    }
@endphp

<style>
    .hero-old {
        position: relative;
        overflow: hidden;
        color: #fff;
        background:
            radial-gradient(circle at 82% 50%, rgba(39, 126, 255, 0.35) 0%, rgba(39, 126, 255, 0.12) 18%, rgba(5, 16, 38, 0) 42%),
            linear-gradient(90deg, #071327 0%, #071329 46%, #0a1d3f 100%);
    }

    .hero-old__overlay {
        position: absolute;
        inset: 0;
        background:
            linear-gradient(90deg, rgba(2, 8, 20, 0.55) 0%, rgba(2, 8, 20, 0.28) 40%, rgba(2, 8, 20, 0.05) 100%);
        pointer-events: none;
    }

    .hero-old__bg {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        opacity: 0.16;
        pointer-events: none;
    }

    .hero-old .container {
        max-width: 1440px;
        margin: 0 auto;
        padding: 0 20px;
        position: relative;
        z-index: 2;
    }

    .hero-old__inner {
        min-height: 640px;
        display: grid;
        grid-template-columns: 1.15fr 0.85fr;
        gap: 40px;
        align-items: stretch;
    }

    .hero-old__left {
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 76px 0 56px;
    }

    .hero-old__badge {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 18px;
        border: 1px solid rgba(74, 151, 255, 0.45);
        background: rgba(21, 67, 135, 0.28);
        border-radius: 999px;
        font-size: 15px;
        font-weight: 600;
        color: #dcecff;
        margin-bottom: 28px;
        width: fit-content;
    }

    .hero-old__badge-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #2787ff;
        box-shadow: 0 0 0 5px rgba(39, 135, 255, 0.18);
        flex-shrink: 0;
    }

    .hero-old__title {
        margin: 0 0 22px;
        font-size: clamp(46px, 5vw, 72px);
        line-height: 1.02;
        font-weight: 800;
        letter-spacing: -0.02em;
        max-width: 860px;
    }

    .hero-old__title span {
        display: block;
        color: #1d88ff;
    }

    .hero-old__text {
        margin: 0 0 22px;
        max-width: 760px;
        font-size: 22px;
        line-height: 1.55;
        color: rgba(255, 255, 255, 0.88);
    }

    .hero-old__benefits {
        display: flex;
        flex-wrap: wrap;
        gap: 18px 26px;
        list-style: none;
        padding: 0;
        margin: 0 0 34px;
    }

    .hero-old__benefits li {
        position: relative;
        padding-left: 18px;
        color: #47d16c;
        font-size: 20px;
        font-weight: 500;
    }

    .hero-old__benefits li::before {
        content: "✓";
        position: absolute;
        left: 0;
        top: 0;
        color: #47d16c;
        font-weight: 700;
    }

    .hero-old__actions {
        display: flex;
        flex-wrap: wrap;
        gap: 18px;
    }

    .hero-old__btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 64px;
        padding: 0 34px;
        border-radius: 14px;
        font-size: 18px;
        font-weight: 700;
        text-decoration: none;
        transition: 0.2s ease;
    }

    .hero-old__btn--primary {
        background: linear-gradient(180deg, #2890ff 0%, #1678e8 100%);
        color: #fff;
        box-shadow: 0 12px 30px rgba(24, 122, 233, 0.25);
    }

    .hero-old__btn--primary:hover {
        transform: translateY(-2px);
    }

    .hero-old__btn--secondary {
        background: rgba(255, 255, 255, 0.03);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.32);
    }

    .hero-old__btn--secondary:hover {
        background: rgba(255, 255, 255, 0.08);
    }

    .hero-old__right {
        display: flex;
        align-items: flex-end;
        justify-content: flex-end;
        padding: 0 0 56px;
    }

    .hero-old__stats {
        display: flex;
        gap: 22px;
        flex-wrap: wrap;
        justify-content: flex-end;
    }

    .hero-old__stat {
        width: 128px;
        min-height: 128px;
        border-radius: 16px;
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(4px);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 16px;
    }

    .hero-old__stat-value {
        font-size: 28px;
        line-height: 1;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .hero-old__stat-label {
        font-size: 18px;
        color: rgba(255, 255, 255, 0.8);
        line-height: 1.25;
    }

    .hero-old__bottom {
        background: linear-gradient(90deg, #257fe6 0%, #2585ea 100%);
        padding: 22px 0;
        position: relative;
        z-index: 2;
    }

    .hero-old__bottom-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 26px;
    }

    .hero-old__feature {
        display: flex;
        align-items: center;
        gap: 16px;
        color: #fff;
    }

    .hero-old__feature-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.18);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .hero-old__feature-title {
        font-size: 17px;
        line-height: 1.15;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .hero-old__feature-text {
        font-size: 15px;
        line-height: 1.25;
        color: rgba(255, 255, 255, 0.9);
    }

    @media (max-width: 1200px) {
        .hero-old__inner {
            grid-template-columns: 1fr;
            min-height: auto;
        }

        .hero-old__right {
            justify-content: flex-start;
            padding-top: 0;
        }

        .hero-old__stats {
            justify-content: flex-start;
        }

        .hero-old__bottom-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .hero-old__left {
            padding: 44px 0 34px;
        }

        .hero-old__title {
            font-size: 40px;
        }

        .hero-old__text {
            font-size: 18px;
        }

        .hero-old__benefits li {
            font-size: 16px;
        }

        .hero-old__btn {
            width: 100%;
        }

        .hero-old__stat {
            width: calc(50% - 11px);
            min-width: 130px;
        }

        .hero-old__bottom-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<section class="hero-old">
    @if($heroImage)
        <div class="hero-old__bg" style="background-image: url('{{ $heroImage }}');"></div>
    @endif
    <div class="hero-old__overlay"></div>

    <div class="container">
        <div class="hero-old__inner">
            <div class="hero-old__left">
                <div class="hero-old__badge">
                    <span class="hero-old__badge-dot"></span>
                    {{ $badgeText }}
                </div>

                <h1 class="hero-old__title">
                    {{ $titleMain }}
                    <span>{{ $titleAccent }}</span>
                </h1>

                <p class="hero-old__text">
                    {{ $description }}
                </p>

                <ul class="hero-old__benefits">
                    @foreach($benefits as $benefit)
                        <li>{{ $benefit }}</li>
                    @endforeach
                </ul>

                <div class="hero-old__actions">
                    <a href="{{ $primaryButtonLink }}" class="hero-old__btn hero-old__btn--primary">
                        {{ $primaryButtonText }}
                    </a>

                    <a href="{{ $secondaryButtonLink }}" class="hero-old__btn hero-old__btn--secondary">
                        {{ $secondaryButtonText }}
                    </a>
                </div>
            </div>

            <div class="hero-old__right">
                <div class="hero-old__stats">
                    @foreach($stats as $stat)
                        <div class="hero-old__stat">
                            <div class="hero-old__stat-value">{{ $stat['value'] ?? '' }}</div>
                            <div class="hero-old__stat-label">{{ $stat['label'] ?? '' }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="hero-old__bottom">
        <div class="container">
            <div class="hero-old__bottom-grid">
                @foreach($bottomFeatures as $item)
                    <div class="hero-old__feature">
                        <div class="hero-old__feature-icon">✦</div>
                        <div>
                            <div class="hero-old__feature-title">{{ $item['title'] ?? '' }}</div>
                            <div class="hero-old__feature-text">{{ $item['text'] ?? '' }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>