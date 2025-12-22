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
        if (!Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
                $table->id(); // bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY
                
                // Внешние ключи
                $table->unsignedBigInteger('hotel_id');
                $table->unsignedBigInteger('dep_id');
                $table->unsignedBigInteger('user_id');
                
                // Основные поля заказа
                $table->date('event_date');
                $table->string('work_start_time'); // Можно было бы использовать time, но в SQL varchar
                $table->string('work_end_time');
                $table->integer('workers_number');
                $table->string('venue_name');
                $table->string('event_start_time');
                $table->string('event_end_time');
                $table->string('position');
                $table->string('duty_content');
                $table->string('guests_number');
                $table->string('comments');
                $table->string('event_style');
                
                // Флаги и статусы
                $table->boolean('is_done')->default(false); // tinyint(1) как boolean
                $table->boolean('is_updated')->default(false);
                
                // Поля для файлов
                $table->string('file_path')->nullable();
                $table->string('file_type')->nullable();
                $table->unsignedBigInteger('file_size')->nullable();
                $table->string('file_name')->nullable();
                
                // Timestamps
                $table->timestamps();
                
                // Индексы для часто используемых полей
                $table->index('hotel_id');
                $table->index('dep_id');
                $table->index('user_id');
                $table->index('event_date');
                $table->index('is_done');
                $table->index(['hotel_id', 'event_date']); // Составной индекс для частых запросов
                $table->index(['dep_id', 'is_done']); // Для поиска заказов отдела по статусу
                
                $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
                $table->foreign('dep_id')->references('id')->on('departments')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
