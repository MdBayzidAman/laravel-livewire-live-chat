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
        Schema::create('wire_chats', function (Blueprint $table) {
            $table->id();
            $table->string('from_id');
            $table->string('to_id');
            $table->string('chats')->nullable();
            $table->string('attachment')->nullable();
            $table->integer('seen')->default(0);
            $table->timestamps();

            // foreign key
            $table->foreign('from_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wire_chats');
    }
};
