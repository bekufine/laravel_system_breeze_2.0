<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table("users" , function (Blueprint $table){
           $table->enum("role",["user", "coordinator", "admin"])->default("user")->change(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // здесь укажите старый набор значений
            $table->enum('role', ['user', 'coordinator'])->change();
        });
    }
};
