<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. profiles
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('full_name_ar')->nullable()->after('full_name');
            $table->string('role_ar')->nullable()->after('role');
            $table->string('tagline_ar')->nullable()->after('tagline');
            $table->string('title_ar')->nullable()->after('title');
            $table->text('bio_ar')->nullable()->after('bio');
            $table->string('location_ar')->nullable()->after('location');
        });

        // 2. experiences
        Schema::table('experiences', function (Blueprint $table) {
            $table->string('title_ar')->nullable()->after('title');
            $table->string('organization_ar')->nullable()->after('organization');
            $table->string('location_ar')->nullable()->after('location');
            $table->text('description_ar')->nullable()->after('description');
        });

        // 3. skills
        Schema::table('skills', function (Blueprint $table) {
            $table->string('category_ar')->nullable()->after('category');
        });

        // 4. work_processes
        Schema::table('work_processes', function (Blueprint $table) {
            $table->string('title_ar')->nullable()->after('title');
            $table->text('description_ar')->nullable()->after('description');
        });

        // 5. projects
        Schema::table('projects', function (Blueprint $table) {
            $table->string('name_ar')->nullable()->after('name');
            $table->string('short_description_ar')->nullable()->after('short_description');
            $table->text('description_ar')->nullable()->after('description');
        });

        // 6. project_features
        Schema::table('project_features', function (Blueprint $table) {
            $table->text('description_ar')->nullable()->after('description');
        });

        // 7. video_sections & video_content_items
        if (Schema::hasTable('video_sections')) {
            Schema::table('video_sections', function (Blueprint $table) {
                $table->string('badge_ar')->nullable()->after('badge');
                $table->string('title_ar')->nullable()->after('title');
                $table->text('subtitle_ar')->nullable()->after('subtitle');
            });
        }

        if (Schema::hasTable('video_content_items')) {
            Schema::table('video_content_items', function (Blueprint $table) {
                $table->string('title_ar')->nullable()->after('title');
                $table->string('value_ar')->nullable()->after('value');
            });
        }
    }

    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn(['full_name_ar', 'role_ar', 'tagline_ar', 'title_ar', 'bio_ar', 'location_ar']);
        });

        Schema::table('experiences', function (Blueprint $table) {
            $table->dropColumn(['title_ar', 'organization_ar', 'location_ar', 'description_ar']);
        });

        Schema::table('skills', function (Blueprint $table) {
            $table->dropColumn(['category_ar']);
        });

        Schema::table('work_processes', function (Blueprint $table) {
            $table->dropColumn(['title_ar', 'description_ar']);
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['name_ar', 'short_description_ar', 'description_ar']);
        });

        Schema::table('project_features', function (Blueprint $table) {
            $table->dropColumn(['description_ar']);
        });

        if (Schema::hasTable('video_sections')) {
            Schema::table('video_sections', function (Blueprint $table) {
                $table->dropColumn(['badge_ar', 'title_ar', 'subtitle_ar']);
            });
        }

        if (Schema::hasTable('video_content_items')) {
            Schema::table('video_content_items', function (Blueprint $table) {
                $table->dropColumn(['title_ar', 'value_ar']);
            });
        }
    }
};

