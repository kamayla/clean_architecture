<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Shop;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string('id')->primary()->comment('ID');
            $table->string('name')->comment('商品名');
            $table->bigInteger('price')->unsigned()->comment('商品価格');
            $table->bigInteger('stock')->unsigned()->comment('在庫数');
            $table->string('shop_id')->comment('リレーション先のShopId');
            $table->timestamps();

            $table->foreign('shop_id')
                ->references('id')
                ->on((new Shop())->getTable())
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
