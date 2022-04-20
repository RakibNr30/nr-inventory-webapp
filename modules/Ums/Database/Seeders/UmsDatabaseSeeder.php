<?php

namespace Modules\Ums\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Modules\Ums\Entities\Permission;
use Modules\Ums\Entities\Role;
use Modules\Ums\Entities\SocialSite;
use Modules\Ums\Entities\User;

class UmsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // seed social sites
        $this->seedSocialSites();

        // seed roles
        $this->seedRoles();

        // seed permissions
        $this->seedPermissions();

        // seed users
        $this->seedUsers();

        // seed user profiles
        //$this->seedUserProfiles();
    }

    private function seedRoles()
    {
        $data = json_decode(File::get(resource_path('seed/ums/role.json')), true);
        foreach ($data as $datum) {
            Role::create($datum);
        }
    }

    private function seedPermissions()
    {
        $data = json_decode(File::get(resource_path('seed/ums/permission.json')), true);
        foreach ($data as $datum) {
            $roles = $datum['roles'];
            unset($datum['roles']);
            $permission = Permission::create($datum);
            $permission->assignRole($roles);
        }
    }

    private function seedSocialSites()
    {
        $sites= json_decode(File::get(resource_path('seed/ums/social_sites.json')), true);

        foreach ($sites as $site) {
            SocialSite::query()->create($site);
        }
    }

    private function seedUsers()
    {
        // get data from json
        $data = json_decode(File::get(resource_path('seed/ums/users.json')), true);

        // process data
        foreach ($data as $datum) {
            // create users
            $user = User::create([
                "email" => $datum["account_info"]["email"],
                "password" => bcrypt("password"),
                "email_verified_at" => Carbon::now(),
                "profile_grade" => 10,
                "approved_at" => Carbon::now(),
                "approved_by" => 1,
                "is_influencer" => $datum["account_info"]["is_influencer"],
            ]);

            // assign role
            $user->assignRole($datum["account_info"]['roles']);

            // upload image from path
            $image_path = public_path("images/users/{$user->emil}.jpg");
            if (File::exists($image_path)) {
                // remove old file from collection
                if ($user->hasMedia(config('core.media_collection.user.avatar'))) {
                    $user->clearMediaCollection(config('core.media_collection.user.avatar'));
                }
                // upload new file to collection
                $user->addMedia($image_path)
                    ->toMediaCollection(config('core.media_collection.user.avatar'));
            }

            // create additional info
            $datum["additional_info"]["user_id"] = $user->id;
            $user->additionalInfo()->create($datum["additional_info"]);
            // create shipping info
            $user->shippingInfo()->create(['user_id' => $user->id]);

            if (isset($datum["social_account_info"])) {
                $user->socialAccountInfo()->create($datum["social_account_info"]);
            }
        }
    }

    private function seedUserProfiles()
    {
        $users = User::all();
        foreach ($users as $user) {
            factory(\Modules\Ums\Entities\UserAdditionalInfo::class, 1)->create([
                'user_id' => $user->id
            ]);
            factory(\Modules\Ums\Entities\UserShippingInfo::class, 1)->create([
                'user_id' => $user->id
            ]);
        }
    }
}
