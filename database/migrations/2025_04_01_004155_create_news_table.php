<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('alias', 255);
            $table->text('introtext')->nullable();
            $table->text('fulltext')->nullable();
            $table->string('img', 255);
            $table->dateTime('created');
            $table->dateTime('modified')->nullable();
            $table->tinyInteger('status')->default(1);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
