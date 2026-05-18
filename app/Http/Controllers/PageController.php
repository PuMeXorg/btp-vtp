<?php

namespace App\Http\Controllers;

use App\Models\HomepageBlock;
use App\Models\News;
use App\Models\Page;
use App\Models\Portfolio;
use App\Models\Video;

class PageController extends Controller
{
    public function home()
    {
        $blocks = HomepageBlock::active()->get();

        $services = Page::active()
            ->where('type', 'service')
            ->whereNotNull('parent_id')
            ->orderBy('sort')
            ->take(6)
            ->get();

        $news = News::active()->take(3)->get();

        $portfolio = Portfolio::active()
            ->take(6)
            ->get();

        return view('pages.home', compact(
            'blocks',
            'services',
            'news',
            'portfolio'
        ));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function certificates()
    {
        $certificates = [
            [
                'title' => 'Сертификат ВТП Инжиниринг 2026',
                'preview' => '/public/certificates/previews/sertifikat-vtp-2026.png',
                'file' => '/public/certificates/sertifikat-vtp-2026.pdf',
            ],
            [
                'title' => 'Сертификат генерального дистрибьютора (тепловое оборудование)',
                'preview' => '/public/certificates/previews/sertifikat-distribytor.png',
                'file' => '/public/certificates/sertifikat-distribytor.pdf',
            ],
            [
                'title' => 'Свидетельство СРО В.01485.23',
                'preview' => '/public/certificates/previews/svidetelstvo-sro.png',
                'file' => '/public/certificates/svidetelstvo-sro.pdf',
            ],
            [
                'title' => 'Декларация о соответствии БТП',
                'preview' => '/public/certificates/previews/deklaracia-btp.png',
                'file' => '/public/certificates/deklaracia-btp.pdf',
            ],
            [
                'title' => 'Декларация о соответствии',
                'preview' => '/public/certificates/previews/deklaracia.png',
                'file' => '/public/certificates/deklaracia.pdf',
            ],
            [
                'title' => 'Декларация ЕАЭС: коллекторы из нержавеющей стали',
                'preview' => '/public/certificates/previews/sertifikat-vtp-4.png',
                'file' => '/public/certificates/sertifikat-vtp-4.pdf',
            ],
            [
                'title' => 'Декларация ЕАЭС: шкаф с узлом присоединения',
                'preview' => '/public/certificates/previews/sertifikat-vtp-5.png',
                'file' => '/public/certificates/sertifikat-vtp-5.pdf',
            ],
            [
                'title' => 'Сертификат ВТП №1',
                'preview' => '/public/certificates/previews/sertifikat-vtp-1.png',
                'file' => '/public/certificates/sertifikat-vtp-1.pdf',
            ],
            [
                'title' => 'Сертификат ВТП №2',
                'preview' => '/public/certificates/previews/sertifikat-vtp-2.png',
                'file' => '/public/certificates/sertifikat-vtp-2.pdf',
            ],
            [
                'title' => 'Сертификат ВТП №3',
                'preview' => '/public/certificates/previews/sertifikat-vtp-3.png',
                'file' => '/public/certificates/sertifikat-vtp-3.pdf',
            ],
        ];

        return view('pages.certificates', compact('certificates'));
    }

    public function requisites()
    {
        return view('pages.requisites');
    }

    public function services()
    {
        $services = Page::active()
            ->where('type', 'service')
            ->whereNull('parent_id')
            ->orderBy('sort')
            ->get();

        return view('pages.services', compact('services'));
    }

    public function service(string $slug)
    {
        $page = Page::active()
            ->where('type', 'service')
            ->where('slug', $slug)
            ->firstOrFail();

        $children = $page->children()
            ->where('type', 'service')
            ->get();

        return view('pages.service', compact('page', 'children'));
    }

    public function catalog()
    {
        $items = Page::active()
            ->where('type', 'catalog')
            ->whereNull('parent_id')
            ->orderBy('sort')
            ->get();

        return view('pages.catalog', compact('items'));
    }

    public function catalogItem(string $slug)
    {
        $page = Page::active()
            ->where('type', 'catalog')
            ->where('slug', $slug)
            ->firstOrFail();

        $children = $page->children()
            ->where('type', 'catalog')
            ->get();

        return view('pages.catalog-item', compact('page', 'children'));
    }

    public function prices()
    {
        $page = Page::active()->where('slug', 'tseny')->firstOrFail();
        return view('pages.prices', compact('page'));
    }

    public function news()
    {
        $news = News::active()->paginate(9);
        return view('pages.news', compact('news'));
    }

    public function newsItem(string $slug)
    {
        $item = News::active()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('pages.news-item', compact('item'));
    }

    public function videos()
    {
        $videos = Video::active()->paginate(12);
        return view('pages.videos', compact('videos'));
    }

    public function contacts()
    {
        return view('pages.contacts');
    }

    public function portfolio()
    {
        $items = Portfolio::active()->get();
        return view('pages.portfolio', compact('items'));
    }

    public function portfolioItem(string $slug)
    {
        $item = Portfolio::active()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('pages.portfolio-item', compact('item'));
    }
}
