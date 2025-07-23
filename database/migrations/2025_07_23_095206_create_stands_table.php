<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStandsTable extends Migration
{
    public function up(): void
    {
        Schema::create('stands', function (Blueprint $table) {
            $table->id();
            $table->string('nom_stand');
            $table->text('description')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stands');
    }
}