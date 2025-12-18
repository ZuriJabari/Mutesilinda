<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('library_activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('book_id')->nullable()->constrained('books')->nullOnDelete();
            $table->foreignId('podcast_id')->nullable()->constrained('podcasts')->nullOnDelete();
            $table->string('action');
            $table->json('meta')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'created_at']);
            $table->index(['book_id', 'created_at']);
            $table->index(['podcast_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('library_activity_logs');
    }
};
