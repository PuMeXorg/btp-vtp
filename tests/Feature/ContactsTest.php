<?php

namespace Tests\Feature;

use App\Models\Region;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
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

    public function test_region_can_be_selected_without_submitting_a_form(): void
    {
        Region::create([
            'name' => 'Санкт-Петербург',
            'slug' => 'spb',
            'email' => 'spb@example.com',
            'is_active' => true,
            'sort' => 1,
        ]);

        $this->get(route('region.set-link', ['region' => 'spb', 'redirect' => route('contacts')]))
            ->assertRedirect(route('contacts'))
            ->assertSessionHas('region', 'spb');
    }

    public function test_layout_controls_do_not_submit_technical_forms(): void
    {
        $this->get(route('contacts'))
            ->assertOk()
            ->assertDontSee('action="'.route('region.set').'"', false)
            ->assertDontSee('name="region"', false)
            ->assertDontSee('type="submit"', false)
            ->assertDontSee('this.form.submit()', false)
            ->assertDontSee('method="GET"', false);
    }

    public function test_mobile_phone_migration_sets_the_shared_number_for_all_regions(): void
    {
        Region::create([
            'name' => 'Санкт-Петербург',
            'slug' => 'spb',
            'phone' => '+78122000000',
            'phone_display' => '+7 (812) 200-00-00',
            'is_active' => true,
        ]);

        Region::create([
            'name' => 'Казань',
            'slug' => 'kazan',
            'phone' => '+78432000000',
            'phone_display' => '+7 (843) 200-00-00',
            'is_active' => true,
        ]);

        $migration = require database_path('migrations/2026_06_30_000001_update_all_contacts_phone_to_mobile.php');
        $migration->up();

        $this->assertDatabaseHas('regions', [
            'slug' => 'spb',
            'phone' => '+79919877947',
            'phone_display' => '+7 991 987 79 47',
        ]);

        $this->assertDatabaseHas('regions', [
            'slug' => 'kazan',
            'phone' => '+79919877947',
            'phone_display' => '+7 991 987 79 47',
        ]);
    }

    public function test_moscow_phone_migration_updates_default_and_all_regions(): void
    {
        DB::table('settings')->insert([
            'key' => 'default_phone',
            'value' => '+7 991 987 79 47',
            'type' => 'string',
            'group' => 'contacts',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Region::create([
            'name' => 'Казань',
            'slug' => 'kazan',
            'phone' => '+79919877947',
            'phone_display' => '+7 991 987 79 47',
            'is_active' => true,
        ]);

        $migration = require database_path('migrations/2026_08_10_000001_update_public_phone_to_moscow.php');
        $migration->up();

        $this->assertDatabaseHas('settings', [
            'key' => 'default_phone',
            'value' => '+7 (495) 223-19-25',
        ]);
        $this->assertDatabaseHas('regions', [
            'slug' => 'kazan',
            'phone' => '+74952231925',
            'phone_display' => '+7 (495) 223-19-25',
        ]);
    }
}
