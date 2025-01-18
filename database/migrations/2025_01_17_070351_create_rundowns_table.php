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
            $table->time('start_time');
            $table->time('end_time');
            $table->string('discussion_topic');
            $table->text('pic');
            $table->text('decision');
            $table->enum('status', ['not_started', 'ongoing', 'finished'])->default('not_started');
            $table->text('minutes_of_meeting')->nullable();
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
