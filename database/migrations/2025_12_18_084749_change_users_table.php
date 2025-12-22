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
        Schema::table('users', function (Blueprint $table) { 
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['user', 'coordinator', 'admin', 'area_manager'])
                      ->default('user')
                      ->after('email');
            }
            
            if (!Schema::hasColumn('users', 'hotel_id')) {
                $table->unsignedBigInteger('hotel_id')->nullable()->after('role');
            }
            
            if (!Schema::hasColumn('users', 'dep_id')) {
                $table->unsignedBigInteger('dep_id')->nullable()->after('hotel_id');
            }
            
            if (!Schema::hasColumn('users', 'user_logid')) {
                $table->string('user_logid')->after('dep_id');
            }
            
            if (!Schema::hasColumn('users', 'city')) {
                $table->enum('city', [
                    '北海道', '東京', '神奈川', '千葉', '茨城', '群馬', '栃木', 
                    '愛知', '静岡', '新潟', '福井', '大阪', '兵庫', '京都', 
                    '滋賀', '奈良', '三重', '広島', '岡山', '福岡', '熊本', 
                    '大分', '佐賀', '鹿児島', '沖縄'
                ])->nullable()->after('user_logid');
            }
            
            // Индексы для новых полей
            $table->index('role');
            $table->index('hotel_id');
            $table->index('dep_id');
            $table->index('user_logid');
            $table->index('city');
            
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
            $table->foreign('dep_id')->references('id')->on('departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'hotel_id', 'dep_id', 'user_logid', 'city']);
        });
    }
};
