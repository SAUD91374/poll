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
        Schema::create('polls', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description')->nullable();
            $table->string('image');
            $table->enum('method',['multiplechoice','imagepoll','rankingpoll']);
            $table->json('options');
            $table->enum('vote_per_ip',['on','off']);
            $table->enum('require_names',['on','off']);
            $table->enum('other_option_vote',['on','off']);
            $table->enum('other_option_results',['on','off']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('polls');
    }
};
