<?php

use App\Models\User;
use App\Models\Order;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // user id chỉ dùng để xác định nó là thằng nào trên hệ thống 
            $table->foreignIdFor(User::class)->constrained();
       

              // lưu lại toàn bộ thông tin người đặt hàng 
            $table->string('user_name');
            $table->string('user_email');
            $table->string('user_phone');
            $table->string('user_address');
            $table->string('user_note')->nullable();


            $table->boolean('is_ship_user_same_user')->default(true);


              // lưu lại toàn bộ thông tin người nhận  hàng 
            $table->string('ship_user_name')->nullable();
            $table->string('ship_user_email')->nullable();
            $table->string('ship_user_phone')->nullable();
            $table->string('ship_user_address')->nullable();
            $table->string('ship_user_note')->nullable();

            //Quản lý
            $table->string('status_oder')->default(Order::STATUS_ORDER_PENDING);
            $table->string('status_payment')->default(Order:: STATUS_ORDER_UNPAID   );


            $table->double('total_price',15,2); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
