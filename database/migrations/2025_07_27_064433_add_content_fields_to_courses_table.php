<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContentFieldsToCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->string('content_type')->nullable()->after('description');
            $table->string('video_path')->nullable()->after('content_type');
            $table->string('video_url')->nullable()->after('video_path');
            $table->string('audio_path')->nullable()->after('video_url');
            $table->string('pdf_path')->nullable()->after('audio_path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn(['content_type', 'video_path', 'video_url', 'audio_path', 'pdf_path']);
        });
    }
}
