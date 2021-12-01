<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

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
        //Super Admin Seed
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
                'name' => 'can_create_one_company',
                'slug' => 'Can Create One Company',
            ]);
            DB::table('permissions')->insert([
                'name' => 'can_edit_own_company',
                'slug' => 'Can Edit Own Company',
            ]);
            DB::table('permissions')->insert([
                'name' => 'can_edit_assigned_company',
                'slug' => 'Can Edit Assigned Company',
            ]);
            DB::table('permissions')->insert([
                'name' => 'can_edit_all_company',
                'slug' => 'Can Edit All Company',
            ]);
            DB::table('permissions')->insert([
                'name' => 'can_delete_own_company',
                'slug' => 'Can Delete Own Company',
            ]);
            DB::table('permissions')->insert([
                'name' => 'can_delete_assigned_company',
                'slug' => 'Can Delete Assigned Company',
            ]);
            DB::table('permissions')->insert([
                'name' => 'can_delete_all_company',
                'slug' => 'Can Delete All Company',
            ]);
        //Users permission     CANCELLED
            // DB::table('permissions')->insert([
            //     'name' => 'can_read_user',
            //     'slug' => 'Can Read User',
            // ]);
            // DB::table('permissions')->insert([
            //     'name' => 'can_create_user',
            //     'slug' => 'Can Create User',
            // ]);
            // DB::table('permissions')->insert([
            //     'name' => 'can_edit_user',
            //     'slug' => 'Can Edit User',
            // ]);
            // DB::table('permissions')->insert([
            //     'name' => 'can_delete_user',
            //     'slug' => 'Can Delete User',
            // ]);
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
                'name' => 'can_edit_assigned_customer',
                'slug' => 'Can Edit Assigned Customer',
            ]);
            DB::table('permissions')->insert([
                'name' => 'can_edit_all_customer',
                'slug' => 'Can Edit All Customer',
            ]);
            DB::table('permissions')->insert([
                'name' => 'can_delete_assigned_customer',
                'slug' => 'Can Delete Assigned Customer',
            ]);
            DB::table('permissions')->insert([
                'name' => 'can_delete_all_customer',
                'slug' => 'Can Delete All Customer',
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
                'name' => 'can_edit_assigned_product',
                'slug' => 'Can Edit Assigned Product',
            ]);
            DB::table('permissions')->insert([
                'name' => 'can_edit_all_product',
                'slug' => 'Can Edit All Product',
            ]);
            DB::table('permissions')->insert([
                'name' => 'can_delete_assigned_product',
                'slug' => 'Can Delete Assigned Product',
            ]);
            DB::table('permissions')->insert([
                'name' => 'can_delete_all_product',
                'slug' => 'Can Delete All Product',
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
                'name' => 'can_edit_assigned_invoice',
                'slug' => 'Can Edit Assigned Invoice',
            ]);
            DB::table('permissions')->insert([
                'name' => 'can_edit_all_invoice',
                'slug' => 'Can Edit All Invoice',
            ]);
            DB::table('permissions')->insert([
                'name' => 'can_delete_assigned_invoice',
                'slug' => 'Can Delete Assigned Invoice',
            ]);
            DB::table('permissions')->insert([
                'name' => 'can_delete_all_invoice',
                'slug' => 'Can Delete All Invoice',
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
                'name' => 'can_edit_assigend_payment',
                'slug' => 'Can Edit Assigned Payment',
            ]);
            DB::table('permissions')->insert([
                'name' => 'can_edit_all_payment',
                'slug' => 'Can Edit All Payment',
            ]);
            DB::table('permissions')->insert([
                'name' => 'can_delete_assigend_payment',
                'slug' => 'Can Delete Assigned Payment',
            ]);
            DB::table('permissions')->insert([
                'name' => 'can_delete_all_payment',
                'slug' => 'Can Delete All Payment',
            ]);
        //Role Permission Seed
            //Manager
            DB::table('permission_role')->insert([
                'role_id' => Role::MANAGER,
                'permission_id' => Permission::CAN_READ_COMPANY,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => Role::MANAGER,
                'permission_id' => Permission::CAN_EDIT_ALL_COMPANY,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => Role::MANAGER,
                'permission_id' => Permission::CAN_DELETE_ALL_COMPANY,
            ]);
            //Webmaster
            DB::table('permission_role')->insert([
                'role_id' => Role::COMPANY_WEBMASTER,
                'permission_id' => Permission::CAN_READ_COMPANY,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => Role::COMPANY_WEBMASTER,
                'permission_id' => Permission::CAN_CREATE_ONE_COMPANY,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => Role::COMPANY_WEBMASTER,
                'permission_id' => Permission::CAN_EDIT_OWN_COMPANY,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => Role::COMPANY_WEBMASTER,
                'permission_id' => Permission::CAN_DELETE_OWN_COMPANY,
            ]);
            //Officer
            DB::table('permission_role')->insert([
                'role_id' => Role::COMPANY_OFFICER,
                'permission_id' => Permission::CAN_READ_COMPANY,
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

        //USERS WITH ROLES SEED
        DB::table('users')->insert([
            'first_name' => 'manager',
            'last_name' => '(companies)',
            'email' => 'manager@mail.com',
            'gender' => 'other',
            'status' => 'approved',
            'role_id'=> 1,
            'date_of_birth' => now(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        DB::table('users')->insert([
            'first_name' => 'company',
            'last_name' => 'webmaster',
            'email' => 'webmaster@mail.com',
            'gender' => 'other',
            'status' => 'approved',
            'role_id'=> 2,
            'date_of_birth' => now(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        DB::table('users')->insert([
            'first_name' => 'company',
            'last_name' => 'officer',
            'email' => 'officer@mail.com',
            'gender' => 'other',
            'status' => 'approved',
            'role_id'=> 3,
            'date_of_birth' => now(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        
    }
}
