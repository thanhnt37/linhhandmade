<?php
use Illuminate\Database\Seeder;
use App\Admins;
use App\Permission;

class AddDataPermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $themtt = Permission::create([
              'name' => 'Thêm Thuộc Tính',
              'key'  => str_slug('Thêm Thuộc Tính', '_'),
              'username'  => 'Thêm Thuộc Tính'
          ]);
        $suatt = Permission::create([
              'name' => 'Sửa Thuộc Tính',
              'key'  => str_slug('Sửa Thuộc Tính', '_'),
              'username'  => 'Sửa Thuộc Tính'
          ]);
        $xoatt = Permission::create([
              'name' => 'Xóa Thuộc Tính',
              'key'  => str_slug('Xóa Thuộc Tính', '_'),
              'username'  => 'Xóa Thuộc Tính'
          ]);
        
    }
}
