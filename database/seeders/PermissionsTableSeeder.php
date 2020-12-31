<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'product_management_access',
            ],
            [
                'id'    => 18,
                'title' => 'product_category_create',
            ],
            [
                'id'    => 19,
                'title' => 'product_category_edit',
            ],
            [
                'id'    => 20,
                'title' => 'product_category_show',
            ],
            [
                'id'    => 21,
                'title' => 'product_category_delete',
            ],
            [
                'id'    => 22,
                'title' => 'product_category_access',
            ],
            [
                'id'    => 23,
                'title' => 'product_tag_create',
            ],
            [
                'id'    => 24,
                'title' => 'product_tag_edit',
            ],
            [
                'id'    => 25,
                'title' => 'product_tag_show',
            ],
            [
                'id'    => 26,
                'title' => 'product_tag_delete',
            ],
            [
                'id'    => 27,
                'title' => 'product_tag_access',
            ],
            [
                'id'    => 28,
                'title' => 'product_create',
            ],
            [
                'id'    => 29,
                'title' => 'product_edit',
            ],
            [
                'id'    => 30,
                'title' => 'product_show',
            ],
            [
                'id'    => 31,
                'title' => 'product_delete',
            ],
            [
                'id'    => 32,
                'title' => 'product_access',
            ],
            [
                'id'    => 33,
                'title' => 'sub_category_create',
            ],
            [
                'id'    => 34,
                'title' => 'sub_category_edit',
            ],
            [
                'id'    => 35,
                'title' => 'sub_category_show',
            ],
            [
                'id'    => 36,
                'title' => 'sub_category_delete',
            ],
            [
                'id'    => 37,
                'title' => 'sub_category_access',
            ],
            [
                'id'    => 38,
                'title' => 'featured_product_create',
            ],
            [
                'id'    => 39,
                'title' => 'featured_product_edit',
            ],
            [
                'id'    => 40,
                'title' => 'featured_product_show',
            ],
            [
                'id'    => 41,
                'title' => 'featured_product_delete',
            ],
            [
                'id'    => 42,
                'title' => 'featured_product_access',
            ],
            [
                'id'    => 43,
                'title' => 'offer_product_create',
            ],
            [
                'id'    => 44,
                'title' => 'offer_product_edit',
            ],
            [
                'id'    => 45,
                'title' => 'offer_product_show',
            ],
            [
                'id'    => 46,
                'title' => 'offer_product_delete',
            ],
            [
                'id'    => 47,
                'title' => 'offer_product_access',
            ],
            [
                'id'    => 48,
                'title' => 'coupon_access',
            ],
            [
                'id'    => 49,
                'title' => 'manager_coupon_create',
            ],
            [
                'id'    => 50,
                'title' => 'manager_coupon_edit',
            ],
            [
                'id'    => 51,
                'title' => 'manager_coupon_show',
            ],
            [
                'id'    => 52,
                'title' => 'manager_coupon_delete',
            ],
            [
                'id'    => 53,
                'title' => 'manager_coupon_access',
            ],
            [
                'id'    => 54,
                'title' => 'feedback_view_show',
            ],
            [
                'id'    => 55,
                'title' => 'feedback_view_delete',
            ],
            [
                'id'    => 56,
                'title' => 'feedback_view_access',
            ],
            [
                'id'    => 57,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 58,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 59,
                'title' => 'customer_access',
            ],
            [
                'id'    => 60,
                'title' => 'manage_order_create',
            ],
            [
                'id'    => 61,
                'title' => 'manage_order_edit',
            ],
            [
                'id'    => 62,
                'title' => 'manage_order_show',
            ],
            [
                'id'    => 63,
                'title' => 'manage_order_delete',
            ],
            [
                'id'    => 64,
                'title' => 'manage_order_access',
            ],
            [
                'id'    => 65,
                'title' => 'manage_customer_access',
            ],
            [
                'id'    => 66,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
