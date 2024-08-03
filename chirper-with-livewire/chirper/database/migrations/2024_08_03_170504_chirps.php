<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('chirps', function (Blueprint $table) {
            $table->id();
            $table->string('message');
            $table->timestamps();

            // Add foreign key constraint
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chirps');
    }
};
