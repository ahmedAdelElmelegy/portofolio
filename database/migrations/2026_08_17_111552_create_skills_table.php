<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name');               // "Laravel", "Flutter"
            $table->string('category')->nullable(); // "Backend", "Mobile", "Tools"
            $table->unsignedTinyInteger('level')->default(0); // نسبة من 0-100 لو عايز progress bar
            $table->string('icon')->nullable();   // اسم أيقونة أو path
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};
