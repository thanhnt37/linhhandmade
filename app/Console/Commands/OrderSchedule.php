<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use App\Item;
use App\Order;
class OrderSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orderschedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tự động hủy đơn hàng';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       $config = Item::where('key_item','config_time_order_destroy')->first();
       if($config){
          $before_int_time = time() - ( ($config->value) * 60 * 60);
          $before_time = date('Y-m-d H:i:s',$before_int_time);
          $orders  = Order::where('created_at','<',$before_time)->where('status','=',1)->update(array('status'=>2));
          // Gửi mail          
       }
     
       
    }
}
