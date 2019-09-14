<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableCategoryProductTagRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_tag', function (Blueprint $table) {
            $table->foreign("product_id")->references("id")->on("products")
                ->onDelete("cascade")->onUpdate("cascade");

            $table->foreign("tag_id")->references("id")->on("tags")
                ->onDelete("cascade")->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_tag', function (Blueprint $table) {
            $table->dropForeign(["product_id"]);
            $table->dropForeign(["tag_id"]);
        });
    }
}
