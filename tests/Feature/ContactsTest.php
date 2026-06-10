<?php

namespace Tests\Feature;

use App\Models\Region;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ContactsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('phone')->nullable();
            $table->string('phone_display')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('working_hours')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort')->default(0);
            $table->timestamps();
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->longText('value')->nullable();
            $table->string('type')->default('string');
            $table->string('label')->nullable();
            $table->string('group')->default('general');
            $table->timestamps();
        });

        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('type')->default('page');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->longText('content')->nullable();
            $table->string('excerpt')->nullable();
            $table->string('image')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort')->default(0);
            $table->timestamps();
        });

        Cache::flush();
    }

    public function test_contacts_show_only_active_regions_and_link_their_emails(): void
    {
        Region::create([
            'name' => 'Самара',
            'slug' => 'samara',
            'email' => 'samara@example.com',
            'is_active' => false,
            'sort' => 1,
        ]);

        Region::create([
            'name' => 'Санкт-Петербург',
            'slug' => 'spb',
            'email' => 'spb@example.com',
            'is_active' => true,
            'sort' => 2,
        ]);

        $response = $this->get(route('contacts'));

        $response
            ->assertOk()
            ->assertDontSee('Самара')
            ->assertSee('Санкт-Петербург')
            ->assertSee('href="mailto:spb@example.com"', false);
    }
}
