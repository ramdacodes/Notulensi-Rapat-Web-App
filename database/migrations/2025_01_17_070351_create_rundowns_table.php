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
        Schema::create('rundowns', function (Blueprint $table) {
            $table->id('rundown_id');
            $table->foreignId('agenda_id')
                ->constrained('agendas', 'agenda_id')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('discussion');
            $table->time('start_time');
            $table->time('end_time');
            $table->json('pics');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rundowns');
    }
};
