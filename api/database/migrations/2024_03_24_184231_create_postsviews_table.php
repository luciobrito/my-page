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
        Schema::create('postsviews', function (Blueprint $table) {
            $table->id();
            $table->string('user_ip');
            $table->foreignId('post_id')->constrained();
            $table->foreignId('user_id')->nullable();
            $table->timestamp('view_date')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postsviews');
    }
};
