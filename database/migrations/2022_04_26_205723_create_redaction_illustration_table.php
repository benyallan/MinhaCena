<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRedactionIllustrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redaction_illustration', function (Blueprint $table) {
            $table->id();
            $table->foreignId('redaction_id');
            $table->foreignId('illustrator_id');
            $table->date('delivered_at');
            $table->string('illustration');
            $table->date('unlocked_at');
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
        Schema::dropIfExists('redaction_illustration');
    }
}
