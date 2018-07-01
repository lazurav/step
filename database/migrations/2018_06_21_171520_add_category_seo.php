<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategorySeo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            //
             if (!Schema::hasColumn('categories', 'seo_title')) {
	             $table->string('seo_title')->after('name');
         	}
         	if (!Schema::hasColumn('categories', 'seo_h1')) {
	             $table->string('seo_h1')->after('seo_title');
         	}
         	if (!Schema::hasColumn('categories', 'meta_description')) {
	             $table->text('meta_description')->after('seo_h1');
         	}
         	if (!Schema::hasColumn('categories', 'meta_keywords')) {
	             $table->text('meta_keywords')->after('meta_description');
         	}
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            //
        });
    }
}
