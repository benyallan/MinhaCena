<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IllustrateRedaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('illustrate_redactions', function (Blueprint $table) {
            $table->foreignId('redaction_id')->constrained();
            $table->foreignId('illustrator_id')->constrained();
            $table->timestamp('delivered_at')->nullable();
            $table->string('illustration')->nullable();
            $table->primary(['redaction_id','illustrator_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('illustrationRedaction');
    }
}
