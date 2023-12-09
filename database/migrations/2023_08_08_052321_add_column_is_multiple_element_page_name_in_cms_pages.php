<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIsMultipleElementPageNameInCmsPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cms_pages', function (Blueprint $table) {
			$table->tinyInteger('is_multi_element')->default('0')->comment('1=Yes, 0=No Page form element type')->after('is_active');
			$table->string('page')->nullable()->comment('Page flag')->after('is_multi_element');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cms_pages', function (Blueprint $table) {
			$table->dropColumn('is_multi_element');
			$table->dropColumn('page');
            //
        });
    }
}
