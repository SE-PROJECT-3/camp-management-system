<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // 1. مسح كاش الصلاحيات
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. إنشاء الصلاحيات باستخدام firstOrCreate لتجنب التكرار
        $p1 = Permission::firstOrCreate(['name' => 'view families']);
        $p2 = Permission::firstOrCreate(['name' => 'manage camps']);

        // 3. إنشاء الأدوار
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // 4. ربط الصلاحيات بالأدوار
        $adminRole->givePermissionTo(Permission::all());
        $userRole->syncPermissions([$p1]); // sync تضمن الربط الصحيح بدون تكرار

        // 5. تعيين الرتبة للمستخدم رقم 1
        $user = User::find(1);
        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}