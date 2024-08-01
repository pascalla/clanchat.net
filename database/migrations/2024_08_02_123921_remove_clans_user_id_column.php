<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('clan_users', function (Blueprint $table) {
            // Add foreign key constraints
            $table->unsignedBigInteger('user_id')->change();
            $table->unsignedBigInteger('clan_id')->change();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('clan_id')->references('id')->on('clans')->onDelete('cascade');
        });

        // Migrate data from clans.user_id to clan_users
        DB::table('clans')->select('id', 'user_id')->whereNotNull('user_id')->chunkById(100, function ($clans) {
            foreach ($clans as $clan) {
                DB::table('clan_users')->insert([
                    'clan_id' => $clan->id,
                    'user_id' => $clan->user_id,
                ]);
            }
        });

        Schema::table('clans', function (Blueprint $table) {
            // Drop the user_id column
            $table->dropColumn('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clans', function (Blueprint $table) {
            // Add the user_id column back
            $table->bigInteger('user_id')->unsigned()->nullable();
        });

        Schema::table('clan_users', function (Blueprint $table) {
            // Drop foreign key constraints
            $table->dropForeign(['user_id']);
            $table->dropForeign(['clan_id']);
        });
    }
};
