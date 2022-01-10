<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetadataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metadatas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nft_id');
            $table->string('name');
            $table->string('image');
            $table->text('description')->nullable();
            $table->string('background_color', 6)->nullable();
            $table->string('external_url')->nullable();
            $table->string('animation_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->timestamps();

            $table->foreign('nft_id')
                ->references('id')->on('nfts')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('metadatas');
    }
}
