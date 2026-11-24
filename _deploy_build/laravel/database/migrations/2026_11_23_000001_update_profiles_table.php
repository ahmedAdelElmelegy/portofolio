<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            // Add missing columns
            $table->string('role')->nullable()->after('full_name');       // "Flutter Developer"
            $table->string('tagline')->nullable()->after('role');          // typing animation text
            $table->string('github_url')->nullable()->after('cv_file');
            $table->string('linkedin_url')->nullable()->after('github_url');
            $table->string('twitter_url')->nullable()->after('linkedin_url');
            $table->string('whatsapp')->nullable()->after('twitter_url');
            $table->boolean('is_active')->default(true)->after('whatsapp');
        });
    }

    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn(['role', 'tagline', 'github_url', 'linkedin_url', 'twitter_url', 'whatsapp', 'is_active']);
        });
    }
};
