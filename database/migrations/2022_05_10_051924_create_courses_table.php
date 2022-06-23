<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('instructor_id')->constrained('instructors')->onDelete('cascade');
            $table->unsignedInteger('admin_id')->nullable();
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('subcategory_id')->nullable();
            $table->string('name')->unique();
            $table->string('slug');
            $table->longText('details');
            $table->text('audience')->nullable();
            $table->text('prerequisite')->nullable();
            $table->text('why_this_course')->nullable();
            $table->text('learning_outcomes')->nullable();
            $table->string('duration');
            $table->text('source_link');
            $table->string('sample_video_link')->nullable();
            $table->string('thumbnil_image');
            $table->unsignedInteger('price');
            $table->unsignedInteger('discount_price')->nullable();
            
            $table->string('provider_logo')->nullable();
            $table->string('provider_name');
            $table->string('provider_signature');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('courses');
    }
}
