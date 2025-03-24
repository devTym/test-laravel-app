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
        Schema::create('lucky_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_link_id')->constrained()->onDelete('cascade');
            $table->integer('random_number');
            $table->enum('result', ['Win', 'Lose']);
            $table->decimal('win_sum', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lucky_results');
    }
};
