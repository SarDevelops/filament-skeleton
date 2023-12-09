<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmailTemplates extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('email_templates', function (Blueprint $table) {
			$table->id();
			$table->string('slug', 100);
			$table->mediumText('name');
			$table->mediumText('subject')->nullable();
			$table->longText('message')->nullable();
			$table->json('placeholders')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->engine = 'InnoDB';
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('email_templates');
	}
}
