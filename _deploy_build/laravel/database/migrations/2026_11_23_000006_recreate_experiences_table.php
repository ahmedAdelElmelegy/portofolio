<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop old separate education + experiences tables, replace with unified table
        Schema::dropIfExists('education');
        Schema::dropIfExists('experiences');

        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('title');                           // "Flutter Developer" / "BSc Computer Science"
            $table->string('organization');                    // company or university name
            $table->string('location')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();              // null = "Present" / is_current
            $table->boolean('is_current')->default(false);
            $table->text('description')->nullable();
            $table->string('type', 20)->default('work')->index(); // 'work' | 'education'
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
