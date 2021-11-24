<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Super User Seed
        if(!User::find(1)){
            DB::table('users')->insert([
                'first_name' => 'super',
                'last_name' => 'admin',
                'email' => 'superadmin@mail.com',
                'gender' => 'other',
                'status' => 'approved',
                'date_of_birth' => now(),
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ]);
        }
        //Roles Seed
        if(!Role::find(1)){
            DB::table('roles')->insert([
                'name' => 'manager',
                'slug' => 'Manager',
            ]);
            DB::table('roles')->insert([
                'name' => 'company_webmaster',
                'slug' => 'Company WebMaster',
            ]);
            DB::table('roles')->insert([
                'name' => 'company_officer',
                'slug' => 'Company Officer',
            ]);
        }
        //Companies permission
            DB::table('permissions')->insert([
                'name' => 'can_read_company',
                'slug' => 'Can Read Company',
            ]);
            DB::table('permissions')->insert([
                'name' => 'can_create_company',
                'slug' => 'Can Create Company',
            ]);
            DB::table('permissions')->insert([
                'name' => 'can_edit_company',
                'slug' => 'Can Edit Company',
            ]);
            DB::table('permissions')->insert([
                'name' => 'can_delete_company',
                'slug' => 'Can Delete Company',
            ]);
        //Users permission
            DB::table('permissions')->insert([
                'name' => 'can_read_user',
                'slug' => 'Can Read User',
            ]);
            DB::table('permissions')->insert([
                'name' => 'can_create_user',
                'slug' => 'Can Create User',
            ]);
            DB::table('permissions')->insert([
                'name' => 'can_edit_user',
                'slug' => 'Can Edit User',
            ]);
            DB::table('permissions')->insert([
                'name' => 'can_delete_user',
                'slug' => 'Can Delete User',
            ]);
        //Customers permission
            DB::table('permissions')->insert([
                'name' => 'can_read_customer',
                'slug' => 'Can Read Customer',
            ]);
            DB::table('permissions')->insert([
                'name' => 'can_create_customer',
                'slug' => 'Can Create Customer',
            ]);
            DB::table('permissions')->insert([
                'name' => 'can_edit_customer',
                'slug' => 'Can Edit Customer',
            ]);
            DB::table('permissions')->insert([
                'name' => 'can_delete_customer',
                'slug' => 'Can Delete Customer',
            ]);    
        //Products permission
            DB::table('permissions')->insert([
                'name' => 'can_read_product',
                'slug' => 'Can Read Product',
            ]);
            DB::table('permissions')->insert([
                'name' => 'can_create_product',
                'slug' => 'Can Create Product',
            ]);
            DB::table('permissions')->insert([
                'name' => 'can_edit_product',
                'slug' => 'Can Edit Product',
            ]);
            DB::table('permissions')->insert([
                'name' => 'can_delete_product',
                'slug' => 'Can Delete Product',
            ]);
        //Invoices permission
            DB::table('permissions')->insert([
                'name' => 'can_read_invoice',
                'slug' => 'Can Read Invoice',
            ]);
            DB::table('permissions')->insert([
                'name' => 'can_create_invoice',
                'slug' => 'Can Create Invoice',
            ]);
            DB::table('permissions')->insert([
                'name' => 'can_edit_invoice',
                'slug' => 'Can Edit Invoice',
            ]);
            DB::table('permissions')->insert([
                'name' => 'can_delete_invoice',
                'slug' => 'Can Delete Invoice',
            ]);
        //Payments permission
            DB::table('permissions')->insert([
                'name' => 'can_read_payments',
                'slug' => 'Can Read Payment',
            ]);
            DB::table('permissions')->insert([
                'name' => 'can_create_payment',
                'slug' => 'Can Create Payment',
            ]);
            DB::table('permissions')->insert([
                'name' => 'can_edit_payment',
                'slug' => 'Can Edit Payment',
            ]);
            DB::table('permissions')->insert([
                'name' => 'can_delete_payment',
                'slug' => 'Can Delete Payment',
            ]);
        //Role Permission Seed
            DB::table('permission_role')->insert([
                'role_id' => 1,
                'permission_id' => 1,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => 2,
                'permission_id' => 1,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => 1,
                'permission_id' => 2,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => 2,
                'permission_id' => 2,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => 1,
                'permission_id' => 3,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => 2,
                'permission_id' => 3,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => 1,
                'permission_id' => 4,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => 2,
                'permission_id' => 4,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => 2,
                'permission_id' => 9,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => 2,
                'permission_id' => 10,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => 2,
                'permission_id' => 11,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => 2,
                'permission_id' => 12,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => 2,
                'permission_id' => 13,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => 3,
                'permission_id' => 13,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => 2,
                'permission_id' => 14,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => 3,
                'permission_id' => 14,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => 2,
                'permission_id' => 15,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => 3,
                'permission_id' => 15,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => 2,
                'permission_id' => 16,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => 2,
                'permission_id' => 17,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => 3,
                'permission_id' => 17,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => 2,
                'permission_id' => 18,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => 3,
                'permission_id' => 18,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => 2,
                'permission_id' => 19,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => 3,
                'permission_id' => 19,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => 2,
                'permission_id' => 20,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => 3,
                'permission_id' => 20,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => 2,
                'permission_id' => 21,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => 3,
                'permission_id' => 21,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => 2,
                'permission_id' => 22,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => 3,
                'permission_id' => 22,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => 2,
                'permission_id' => 23,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => 3,
                'permission_id' => 23,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => 2,
                'permission_id' => 24,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => 3,
                'permission_id' => 24,
            ]);
        //Categories
            DB::table('categories')->insert([
                'name' => 'Industry',
            ]);
            DB::table('categories')->insert([
                'name' => 'Functionality',
            ]);
            DB::table('categories')->insert([
                'name' => 'Convenience',
            ]);
            DB::table('categories')->insert([
                'name' => 'Quality',
            ]);
        \App\Models\User::factory(5)->create();
        \App\Models\Company::factory(5)->create();
        \App\Models\Customer::factory(10)->create();
        \App\Models\Product::factory(15)->create();
        
    }
}
