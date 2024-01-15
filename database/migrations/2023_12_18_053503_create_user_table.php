<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // personal info
            $table->string('firstName');
            $table->string('middleName');
            $table->string('lastName');
            $table->string('phone');
            $table->string('Province');
            $table->string('Municipality');
            $table->string('Barangay');
            $table->foreignId('F_MID')->constrained(
                table: 'meter',
                indexName: 'MID',
            )->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->enum('role',['admin','user'])->default('user');
            $table->enum('status',['active','inactive'])->default('active');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('email_verified_at')->nullable();
            $table->index('username');
            $table->index('id');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
