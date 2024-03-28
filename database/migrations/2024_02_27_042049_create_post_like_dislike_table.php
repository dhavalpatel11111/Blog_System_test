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
        Schema::create('post_like_dislike', function (Blueprint $table) {
            $table->id();
            $table->integer("postid");
            $table->string("like_dislike_status");
            // 0 == like , /// 1 == dislike
            $table->string('userid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_like_dislike');
    }
};
