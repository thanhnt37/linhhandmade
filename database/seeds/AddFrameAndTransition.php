<?php

use Illuminate\Database\Seeder;
use App\Admins;
use App\Permission;
class AddFrameAndTransition extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pvt = Permission::create([
              'name' => 'Phí vận chuyển sản phẩm',
              'key'  => str_slug('Phí vận chuyển sản phẩm', '_'),
              'username'  => 'Phí vận chuyển'
          ]);
        $td = Permission::create([
              'name' => 'Cấu hình tích điểm sản phẩm',
              'key'  => str_slug('Cấu hình tích điểm sản phẩm', '_'),
              'username'  => 'Tích điểm'
          ]);
        $chemsp = Permission::create([
              'name' => 'Cấu hình email hết hàng sản phẩm',
              'key'  => str_slug('Cấu hình email hết hàng sản phẩm', '_'),
              'username'  => 'Cấu hình email hết hàng'
          ]);
        $chem1 = Permission::create([
              'name' => 'Cấu hình email đơn hàng',
              'key'  => str_slug('Cấu hình email đơn hàng', '_'),
              'username'  => 'Cấu hình email đơn hàng'
          ]);
        $ttkh = Permission::create([
              'name' => 'Thông tin khách hàng',
              'key'  => str_slug('Thông tin khách hàng', '_'),
              'username'  => 'Thông tin khách hàng'
          ]);
        
    }
}
