<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nom_entreprise')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'entrepreneur_en_attente', 'entrepreneur_approuve'])->default('entrepreneur_en_attente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}