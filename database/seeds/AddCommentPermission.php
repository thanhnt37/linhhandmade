<?php
use Illuminate\Database\Seeder;
use App\Admins;
use App\Permission;

class AddCommentPermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $themblbv = Permission::create([
              'name' => 'Quản lý bình luận bài viết',
              'key'  => str_slug('Quản lý bình luận bài viết', '_'),
              'username'  => 'Quản lý comment'
         ]);
        $themblsp = Permission::create([
              'name' => 'Quản lý bình luận sản phẩm',
              'key'  => str_slug('Quản lý bình luận sản phẩm', '_'),
              'username'  => 'Quản lý comment'
        ]);
       
    }
}
