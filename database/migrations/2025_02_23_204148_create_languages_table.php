<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('language_code', 5)->unique();
            $table->string('locale_code', 5)->unique();
            $table->boolean('active')->default(false);
            $table->boolean('is_default')->default(false);
        });

        DB::table('languages')->insert([
            \App\Models\Base\Language::SPANISH,
            \App\Models\Base\Language::ENGLISH,
            \App\Models\Base\Language::FRENCH,
            \App\Models\Base\Language::GERMAN,
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('languages');
    }
};
