<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
  
class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
               'name'=>'Admin User',
               'email'=>'admin@gmail.com.com',
               'type'=>1,
               'password'=> bcrypt('Admin@123'),
            ],
            
            [
               'name'=>'User Two',
               'email'=>'User2@gmail.com',
               'type'=>0,
               'password'=> bcrypt('User2@123'),
            ],
        ];
    
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}