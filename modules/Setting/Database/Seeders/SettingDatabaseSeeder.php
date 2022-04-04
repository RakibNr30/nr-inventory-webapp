<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Modules\Setting\Entities\Contact;
use Modules\Setting\Entities\Site;

class SettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // get data from json
        $settingData = json_decode(File::get(resource_path('seed/setting/setting.json')), true);

        // site seeding
        $site = $settingData['sites'];
        Site::create([
            "title" => $site['title'],
            "description" => $site['description']
        ]);

        // contact seeding
        $contact = $settingData['contacts'];
        Contact::create([
            "email" => $contact['email'],
            "phone" => $contact['phone'],
            "mobile" => $contact['mobile'],
            "fax" => $contact['fax'],
            "website" => $contact['website'],
            "address" => $contact['address'],
            "google_map" => $contact['google_map'],
            "longitude" => $contact['longitude'],
            "latitude" => $contact['latitude'],
            "facebook" => $contact['facebook'],
            "twitter" => $contact['twitter'],
            "linked_in" => $contact['linked_in'],
            "youtube" => $contact['youtube'],
            "instagram" => $contact['instagram'],
            "skype" => $contact['skype'],
            "whatsapp" => $contact['whatsapp'],
            "working_hours" => $contact['working_hours'],
            "working_days" => $contact['working_days']
        ]);
    }
}
