<?php

namespace Modules\Cms\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Modules\Cms\Entities\Faq;
use Modules\Cms\Entities\Page;
use Modules\Cms\Entities\PageCategory;
use Modules\Cms\Entities\Slider;
use Modules\Cms\Entities\Testimonial;

class CmsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $pageData = json_decode(File::get(resource_path('seed/page.json')));
        foreach ($pageData as $pageCategory) {
            $pCategory = PageCategory::create([
                'title' => $pageCategory->title
            ]);
            foreach ($pageCategory->pages as $page) {
                Page::create([
                    'title' => $page->title,
                    'description' => $page->description,
                    'page_category_id' => $pCategory->id,
                ]);
            }
        }

        // cms data
        $cmsData = json_decode(File::get(resource_path('seed/cms/cms.json')));

        // sliders seeding
        $sliderList = $cmsData->sliders;
        foreach ($sliderList as $slider) {
            $new_slider = Slider::create([
                'title' => $slider->title,
                'slug' => $slider->slug,
                'description' => $slider->description,
                'link' => $slider->link
            ]);

            // upload image from path
            $image_path = public_path("images/sliders/{$slider->title}.jpg");
            if (File::exists($image_path)) {
                // remove old file from collection
                if ($new_slider->hasMedia(config('core.media_collection.slider.image'))) {
                    $new_slider->clearMediaCollection(config('core.media_collection.slider.image'));
                }
                // upload new file to collection
                $new_slider->addMedia($image_path)
                    ->toMediaCollection(config('core.media_collection.slider.image'));
            }
        }

        // faqs seeding
        $faqList = $cmsData->faqs;
        foreach ($faqList as $faq) {
            Faq::create([
                'question' => $faq->question,
                'answer' => $faq->answer
            ]);
        }

        // testimonials seeding
        $testimonialList = $cmsData->testimonials;
        foreach ($testimonialList as $testimonial) {
            Testimonial::create([
                'name' => $testimonial->name,
                'designation' => $testimonial->designation,
                'message' => $testimonial->message
            ]);
        }
    }
}
