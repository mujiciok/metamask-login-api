<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetadataAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metadata_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('metadata_id');
            $table->unsignedTinyInteger('type');
            $table->string('trait_type')->nullable();
            $table->string('value');
            $table->string('display_type')->nullable();
            $table->timestamps();

            $table->foreign('metadata_id')
                ->references('id')->on('metadatas')
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
        Schema::dropIfExists('metadata_attributes');
    }
}
