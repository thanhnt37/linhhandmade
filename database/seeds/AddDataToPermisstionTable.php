<?php
use Illuminate\Database\Seeder;
use App\Admins;
use App\Permission;

class AddDataToPermisstionTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $themdh = Permission::create([
              'name' => 'Thêm Đơn Hàng',
              'key'  => str_slug('Thêm Đơn Hàng', '_'),
               'username'  => 'Thêm Đơn Hàng'
          ]);
        $xoadh = Permission::create([
              'name' => 'Xóa Đơn Hàng',
              'key'  => str_slug('Xóa Đơn Hàng', '_'),
              'username'  => 'Xóa Đơn Hàng'
          ]);
        $xemdh = Permission::create([
              'name' => 'Xem Đơn Hàng',
              'key'  => str_slug('Xem Đơn Hàng', '_'),
              'username'  => 'Xem Đơn Hàng'
          ]);
        $xukidh = Permission::create([
              'name' => 'Xử Lí Đơn Hàng',
              'key'  => str_slug('Xử Lí Đơn Hàng', '_'),
              'username'  => 'Xử Lí Đơn Hàng'
          ]);
        
    }
}
