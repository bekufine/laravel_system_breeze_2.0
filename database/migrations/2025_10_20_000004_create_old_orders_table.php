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
        if (!Schema::hasTable('old_orders')) {
            Schema::create('old_orders', function (Blueprint $table) {
                $table->id(); 
                $table->unsignedBigInteger('order_id');
                $table->integer('hotel_id'); 
                $table->integer('dep_id');
                $table->integer('user_id');
                $table->date('event_date');
                $table->time('work_start_time');
                $table->time('work_end_time');
                $table->time('event_start_time');
                $table->time('event_end_time');
                $table->string('workers_number'); // varchar вместо int
                $table->string('venue_name');
                $table->string('position');
                $table->text('duty_content'); // text вместо varchar
                $table->string('guests_number');
                $table->text('comments')->nullable(); // text вместо varchar
                $table->string('event_style');
                
                // Флаги и статусы
                $table->boolean('is_done')->default(false);
                
                // Файлы
                $table->string('file_path', 512)->nullable(); // Длиннее чем в новой таблице
                $table->string('file_type')->nullable();
                $table->string('file_size')->nullable(); // varchar вместо bigint
                $table->string('file_name')->nullable();
                
                // Timestamps
                $table->timestamps();
                
                // Индексы
                $table->index('order_id');
                $table->index('hotel_id');
                $table->index('dep_id');
                $table->index('user_id');
                $table->index('event_date');
                $table->index('is_done');
                $table->index(['hotel_id', 'event_date']);
                $table->index(['dep_id', 'event_date']);
                
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('old_orders');
    }
};
