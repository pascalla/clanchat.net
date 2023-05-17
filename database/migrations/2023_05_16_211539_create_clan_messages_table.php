<?php

use App\Models\Clan;
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
        Schema::create('clan_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Clan::class)->constrained();
            $table->text('username')->nullable();
            $table->text('account_type')->nullable();
            $table->text('message_type');
            $table->text('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clan_messages');
    }
};
