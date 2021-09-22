<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPlacementDetailsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedInteger('amount_of_matches')->nullable();
            $table->unsignedBigInteger('placement_detail_id')->nullable();
            $table->foreign('placement_detail_id')->references('id')->on('placement_details')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('amount_of_matches');
            $table->dropColumn('placement_detail_id');
            $table->dropForeign('placement_detail_id');
        });
    }
}
