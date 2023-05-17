<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Colaborador']);
        $role3 = Role::create(['name' => 'Voluntario']);

        Permission::create(['name' => 'admin.ver.inicio'])->syncRoles([$role1, $role2, $role3]);

        Permission::create(['name' => 'admin.nucleos.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.nucleos.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.nucleos.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.nucleos.destroy'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'admin.caravanas.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.caravanas.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.caravanas.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.caravanas.destroy'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'admin.migrantes.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.migrantes.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.migrantes.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.migrantes.destroy'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'admin.movilidad.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.movilidad.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.movilidad.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.movilidad.destroy'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'admin.enfermos.index'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'admin.enfermos.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.enfermos.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.enfermos.destroy'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'admin.conducta.index'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'admin.conducta.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.conducta.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.conducta.destroy'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'admin.api.index'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.users.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.update'])->syncRoles([$role1]);

    }
}
