<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use App\Item;
class Order extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order';

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
        $Item =  Item::where('key_item','order_log')->first();

        if($Item){
            $Item->value = time();
            $Item->save();    
        }else{
            $Item = new Item;
            $Item->key_item = 'order_log';
            $Item->value = time();
            $Item->save();
        }
    }
}
