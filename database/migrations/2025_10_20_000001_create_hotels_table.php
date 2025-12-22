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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id(); 
            $table->string('hotel_name'); 
            $table->enum('city', [
                '北海道', '東京', '神奈川', '千葉', '茨城', '群馬', '栃木', 
                '愛知', '静岡', '新潟', '福井', '大阪', '兵庫', '京都', 
                '滋賀', '奈良', '三重', '広島', '岡山', '福岡', '熊本', 
                '大分', '佐賀', '鹿児島', '沖縄'
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
