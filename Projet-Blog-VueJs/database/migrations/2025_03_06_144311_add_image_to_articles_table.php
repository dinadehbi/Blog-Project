<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('articles', function (Blueprint $table) {
        $table->string('image')->nullable(); // Zid l-column jdida
    });
}

    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('image'); // Ila bghiti tms7ha mn database f rollback
        });
    }

};
