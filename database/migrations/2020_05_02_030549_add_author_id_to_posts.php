<?php

use App\Post;
use App\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAuthorIdToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->foreignId('author_id')
                ->nullable()
                ->after('author')
                ->constrained('users')
                ->onUpdate('restrict')
                ->onDelete('restrict');
        });

        $user = User::orderBy('id')->first();
        $posts = Post::all();
        foreach ($posts as $post) {
            $post->author_id =  $user->id;
            $post->save();
        }

        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('author_id')->nullable(false)->change();
            $table->dropColumn('author');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('author_new')->after('title');
        });

        $posts = Post::all();
        foreach ($posts as $post) {
            $post->author_new = $post->author->name;
            $post->save();
        }

        Schema::table('posts', function (Blueprint $table) {
            $table->renameColumn('author_new', 'author');
            $table->dropForeign(['author_id']);
            $table->dropColumn('author_id');
        });
    }
}
