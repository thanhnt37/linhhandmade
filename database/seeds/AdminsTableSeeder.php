<?php

use Illuminate\Database\Seeder;
use App\Admins;
use App\Permission;
class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dev= Admins::create([
          'username' => 'dev',
          'password' => md5('admin'),
           'phone'   => '34234234234',
           'address' => 'E5 Quỳnh Mai Hai Bà Trưng Hà Nội',
            'level'  => 1,
            'status' => 1,
          ]);
         $admin= Admins::create([
          'username' => 'admin',
          'password' => md5('admin'),
           'phone'   => '34234234234',
           'address' => 'E5 Quỳnh Mai Hai Bà Trưng Hà Nội',
            'level'  => 1,
            'status' => 1,
          ]);


         //phan quyen post

         $createpost = Permission::create([
              'name' => 'Đăng bài viết',
              'key'  => str_slug('Đăng bài viết', '_'),
              'username'  => 'Đăng bài viết'
          ]);
         $editpost =  Permission::create([
              'name' => 'Sửa bài viết',
              'key'  => str_slug('Sửa bài viết', '_'),
              'username'  => 'Sửa bài viết'
          ]);
         $savepost =  Permission::create([
              'name' => 'Lưu bài viết',
              'key'  => str_slug('Lưu bài viết', '_'),
              'username'  => 'Lưu bài viết'
          ]);
         $delpost = Permission::create([
              'name' => 'Xóa bài viết',
              'key'  => str_slug('Xóa bài viết', '_'),
              'username'  => 'Xóa bài viết'
          ]);
         $createmenupost =  Permission::create([
              'name' => 'Thêm danh mục bài viết',
              'key'  => str_slug('Thêm danh mục bài viết', '_'),
              'username'  => 'Thêm danh mục'
          ]);
         $editmenupost =  Permission::create([
              'name' => 'Sửa danh mục bài viết',
              'key'  => str_slug('Sửa danh mục bài viết', '_'),
              'username'  => 'Sửa danh mục'
          ]);
         $delmenupost =  Permission::create([
              'name' => 'Xóa danh mục bài viết',
              'key'  => str_slug('Xóa danh mục bài viết', '_'),
              'username'  => 'Xóa danh mục'
          ]);
         $quanlytagbaiviet =  Permission::create([
              'name' => 'Quản lý tags bài viết',
              'key'  => str_slug('Quản lý tags bài viết', '_'),
              'username'  => 'Quản lý tags'
          ]);
         // sản phẩm
        $createproduct =  Permission::create([
              'name' => 'Đăng sản phẩm',
              'key'  => str_slug('Thêm sản phẩm', '_'),
              'username'  => 'Đăng sản phẩm'
          ]);
         $editproduct =  Permission::create([
              'name' => 'Sửa sản phẩm',
              'key'  => str_slug('Sửa sản phẩm', '_'),
              'username'  => 'Sửa sản phẩm'
          ]);
         $saveproduct =  Permission::create([
              'name' => 'Lưu sản phẩm',
              'key'  => str_slug('Lưu sản phẩm', '_'),
              'username'  => 'Lưu sản phẩm'
          ]);
         $delproduct = Permission::create([
              'name' => 'Xóa sản phẩm',
              'key'  => str_slug('Xóa sản phẩm', '_'),
              'username'  => 'Xóa sản phẩm'
          ]);
         $createmenuproduct =  Permission::create([
              'name' => 'Thêm danh mục sản phẩm',
              'key'  => str_slug('Thêm danh mục sản phẩm', '_'),
              'username'  => 'Thêm danh mục'
          ]);
         $editmenuproduct =  Permission::create([
              'name' => 'Sửa danh mục sản phẩm',
              'key'  => str_slug('Sửa danh mục sản phẩm', '_'),
              'username'  => 'Sửa danh mục'
          ]);
         $delmenuproduct =  Permission::create([
              'name' => 'Xóa danh mục sản phẩm',
              'key'  => str_slug('Xóa danh mục sản phẩm', '_'),
              'username'  => 'Xóa danh mục'
          ]);
         $quanlytagbaiviet =  Permission::create([
              'name' => 'Quản lý tags sản phẩm',
              'key'  => str_slug('Quản lý tags sản phẩm', '_'),
              'username'  => 'Quản lý tags'
          ]);

         //slide 

         $createslide =  Permission::create([
              'name' => 'Thêm slide',
              'key'  => str_slug('Thêm slide', '_'),
              'username'  => 'Thêm slide'
          ]);
         $editslide =  Permission::create([
              'name' => 'Sửa slide',
              'key'  => str_slug('Sửa slide', '_'),
              'username'  => 'Sửa slide'
          ]);
         $delslide =  Permission::create([
              'name' => 'Xóa slide',
              'key'  => str_slug('Xóa slide', '_'),
              'username'  => 'Xóa slide'
          ]);
       
         //menu

          $createmenu =  Permission::create([
              'name' => 'Tạo menu',
              'key'  => str_slug('Tạo menu', '_'),
              'username'  => 'Tạo menu'
          ]);
         $editmenu =  Permission::create([
              'name' => 'Sửa menu',
              'key'  => str_slug('Sửa menu', '_'),
              'username'  => 'Sửa menu'
          ]);
         $delmenu =  Permission::create([
              'name' => 'Xóa menu',
              'key'  => str_slug('Xóa menu', '_'),
              'username'  => 'Xóa menu'
          ]);

         //layout
         $createLayout =  Permission::create([
              'name' => 'Thêm layout',
              'key'  => str_slug('Thêm layout', '_'),
              'username'  => 'Thêm layout'
          ]);
         $editlayout =  Permission::create([
              'name' => 'Sửa layout',
              'key'  => str_slug('Sửa layout', '_'),
              'username'  => 'Sửa layout'
          ]);

         // thanh vien
         $createtv =  Permission::create([
              'name' => 'Thêm thành viên',
              'key'  => str_slug('Thêm thành viên', '_'),
              'username'  => 'Thêm thành viên'
          ]);
         $edittv =  Permission::create([
              'name' => 'Sửa thành viên',
              'key'  => str_slug('Sửa thành viên', '_'),
              'username'  => 'Sửa thành viên'
          ]);
         $xoatv =  Permission::create([
              'name' => 'Xóa thành viên',
              'key'  => str_slug('Xóa thành viên', '_'),
              'username'  => 'Xóa thành viên'
          ]);
         $phanquyentv =  Permission::create([
              'name' => 'Phân quyền thành viên',
              'key'  => str_slug('Phân quyền thành viên', '_'),
              'username'  => 'Phân quyền'
          ]);
        // lien hệ
        $xemlienhe =  Permission::create([
              'name' => 'Xem liên hệ',
              'key'  => str_slug('Xem liên hệ', '_'),
              'username'  => 'Xem liên hệ'
          ]);
         $xoalienhe =  Permission::create([
              'name' => 'Xóa liên hệ',
              'key'  => str_slug('Xóa liên hệ', '_'),
              'username'  => 'Xóa liên hệ'
          ]);
       $admin->attachPermissions([ $createpost, $editpost,  $savepost,  $delpost, $createmenupost, $editmenupost, $delmenupost,$quanlytagbaiviet, $createproduct, $editproduct, $saveproduct, $delproduct , $createmenuproduct, $editmenuproduct, $delmenuproduct, $quanlytagbaiviet, $createslide,  $editslide,  $delslide, $createmenu, $editmenu, $delmenu, $createLayout,$editlayout, $createtv, $edittv, $xoatv, $phanquyentv, $xemlienhe, $xoalienhe]);
   }
}
