<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = config('roles');
        foreach($roles as $role_id => $roleConfig) {
            if(isset($roleConfig['default-users']) && is_array($roleConfig['default-users'])) {
                foreach($roleConfig['default-users'] as $email => $defaultUser) {
                    $user = User::firstOrCreate([
                        'email' => $email,
                        'role_id' => $role_id
                    ]);
                    $user->first_name = $defaultUser['first_name'];
                    $user->last_name = $defaultUser['last_name'];
                    $user->password = Hash::make($defaultUser['password']);
                    $user->remember_token = "";
                    $user->is_active = true;
                    $user->save();
                }
            }
        }
    }
}
