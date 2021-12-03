<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('created_by')->comment('This is just for tracing who user is created');
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
        $data = [
            ['name' => 'Health Practitioner','created_by' => 1],
            ['name' => 'Distributor (Finished Goods)','created_by' => 1],
            ['name' => 'Retailer','created_by' => 1],
            ['name' => 'Manufacturer','created_by' => 1],
            ['name' => 'Investor','created_by' => 1],
            ['name' => 'Supplier/Raw Ingredient Distributor','created_by' => 1],
            ['name' => 'Food Service','created_by' => 1],
        ];
        \App\Models\BusinessCategory::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_categories');
    }
}
