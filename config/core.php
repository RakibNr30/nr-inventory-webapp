<?php

return [
    // admin menu
    'admin_menu' => [
        [
            "name" => "Dashboard",
            "id" => "dashboard",
            "icon" => "fa-circle",
            "url" => "/backend/dashboard",
            "permission" => "Dashboard",
            "children" => []
        ],
        [
            "name" => "Influencer",
            "id" => "influencer",
            "icon" => "fa-circle",
            "url" => "/backend/influencer",
            "permission" => "Influencer",
            "children" => []
        ],
        [
            "name" => "Campaigns",
            "id" => "campaigns",
            "icon" => "fa-circle",
            "url" => "/backend/campaign",
            "permission" => "Campaigns",
            "children" => []
        ],
        [
            "name" => "Brands",
            "id" => "brands",
            "icon" => "fa-circle",
            "url" => "/backend/brand",
            "permission" => "Brands",
            "children" => []
        ],
        [
            "name" => "Products",
            "id" => "products",
            "icon" => "fa-circle",
            "url" => "/backend/product",
            "permission" => "Products",
            "children" => []
        ],
        [
            "name" => "Logistics",
            "id" => "logistics",
            "icon" => "fa-circle",
            "url" => "/backend/logistic",
            "permission" => "Logistics",
            "children" => []
        ],
        [
            "name" => "Settings",
            "id" => "settings",
            "icon" => "fa-circle",
            "url" => "",
            "permission" => "Settings",
            "children" => [
                [
                    "name" => "Cms",
                    "id" => "cms",
                    "icon" => "fa-dot-circle",
                    "url" => "",
                    "permission" => "Cms",
                    "children" => [
                        [
                            "name" => "Page",
                            "id" => "page",
                            "icon" => "fa-arrow-right",
                            "url" => "/backend/page",
                            "permission" => "Page",
                        ],
                        [
                            "name" => "Faq",
                            "id" => "faq",
                            "icon" => "fa-arrow-right",
                            "url" => "/backend/faq",
                            "permission" => "Faq",
                        ],
                        [
                            "name" => "Testimonial",
                            "id" => "testimonial",
                            "icon" => "fa-arrow-right",
                            "url" => "/backend/testimonial",
                            "permission" => "Testimonial",
                        ]
                    ]
                ],
                [
                    "name" => "Access Controls",
                    "id" => "access_controls",
                    "icon" => "fa-dot-circle",
                    "url" => "",
                    "permission" => "Access Controls",
                    "children" => [
                        [
                            "name" => "Role",
                            "id" => "role",
                            "icon" => "fa-arrow-right",
                            "url" => "/backend/role",
                            "permission" => "Role",
                        ],
                        [
                            "name" => "User",
                            "id" => "user",
                            "icon" => "fa-arrow-right",
                            "url" => "/backend/user",
                            "permission" => "User",
                        ]
                    ]
                ],
                [
                    "name" => "Common Settings",
                    "id" => "common_settings",
                    "icon" => "fa-dot-circle",
                    "url" => "",
                    "permission" => "Common Settings",
                    "children" => [
                        [
                            "name" => "Page Category",
                            "id" => "page_category",
                            "icon" => "fa-arrow-right",
                            "url" => "/backend/page-category",
                            "permission" => "Page Category",
                        ],
                        [
                            "name" => "Influencer Category",
                            "id" => "influencer_category",
                            "icon" => "fa-arrow-right",
                            "url" => "/backend/influencer-category",
                            "permission" => "Influencer Category",
                        ],
                    ]
                ],
                [
                    "name" => "App Settings",
                    "id" => "app_settings",
                    "icon" => "fa-dot-circle",
                    "url" => "",
                    "permission" => "App Settings",
                    "children" => [
                        [
                            "name" => "Site",
                            "id" => "site",
                            "icon" => "fa-arrow-right",
                            "url" => "/backend/site",
                            "permission" => "Site",
                        ],
                        [
                            "name" => "Contact",
                            "id" => "contact",
                            "icon" => "fa-arrow-right",
                            "url" => "/backend/contact",
                            "permission" => "Contact",
                        ],
                        [
                            "name" => "Seo",
                            "id" => "seo",
                            "icon" => "fa-arrow-right",
                            "url" => "/backend/seo",
                            "permission" => "Seo",
                        ],
                        [
                            "name" => "Socialite",
                            "id" => "socialite",
                            "icon" => "fa-arrow-right",
                            "url" => "/backend/socialite",
                            "permission" => "Socialite",
                        ]
                    ]
                ],
            ]
        ],
        [
            "name" => "Sign Out",
            "id" => "sign_out",
            "icon" => "fa-circle",
            "url" => "logout",
            "permission" => "Sign Out",
            "children" => []
        ],
    ],

    // profile menu
    'profile_menu' => [
        [
            "name" => "Social Account Info",
            "id" => "social_account_info",
            "icon" => "fa-user",
            "url" => "/backend/profile/social-account-info",
            "permission" => "social_account_info",
            "children" => []
        ],
        [
            "name" => "Shipping Info",
            "id" => "shipping_info",
            "icon" => "fa-user",
            "url" => "/backend/profile/shipping-info",
            "permission" => "shipping_info",
            "children" => []
        ],
        [
            "name" => "Additional Info",
            "id" => "additional_info",
            "icon" => "fa-user",
            "url" => "/backend/profile/additional-info",
            "permission" => "additional_info",
            "children" => []
        ],
       /* [
            "name" => "Language",
            "id" => "language",
            "icon" => "fa-user",
            "url" => "/backend/profile/language",
            "permission" => "language",
            "children" => []
        ],*/
        [
            "name" => "Account Info",
            "id" => "account_info",
            "icon" => "fa-user",
            "url" => "/backend/profile/account-info",
            "permission" => "account_info",
            "children" => []
        ],
        [
            "name" => "Password Change",
            "id" => "password_change",
            "icon" => "fa-user",
            "url" => "/backend/profile/password-change",
            "permission" => "password_change",
            "children" => []
        ]
    ],
    "blood_groups" => [
        "A+" => "A+",
        "A-" => "A-",
        "B+" => "B+",
        "B-" => "B-",
        "O+" => "O+",
        "O-" => "O-",
        "AB+" => "AB+",
        "AB-" => "AB-",
    ],
    "genders" => [
        "1" => "Male",
        "2" => "Female",
        "3" => "Others"
    ],
    "language_proficiency" => [
        "1" => "Elementary Proficiency",
        "2" => "Limited Working Proficiency",
        "3" => "Professional Working Proficiency",
        "4" => "Full Professional Proficiency",
        "5" => "Native / Bilingual Proficiency",
    ],
    "profile_grades" => [
        "1" => "Grade 1",
        "2" => "Grade 2",
        "3" => "Grade 3",
        "4" => "Grade 4",
        "5" => "Grade 5",
    ],
    "campaign_goals" => [
        "Branding" => "Branding",
        "Content Creation" => "Content Creation",
        "Online-Store-Sales" => "Online-Store-Sales",
        "Offline-Store-Sales" => "Offline-Store-Sales",
        "Link-Clicks" => "Link-Clicks",
        "Follower Generation" => "Follower Generation",
        "App Download" => "App Download",
        "Lead Generation" => "Lead Generation",
    ],
    "content_types" => [
        "Instagram Story" => "Instagram Story",
        "Instagram Feed" => "Instagram Feed",
        "Instagram Reel" => "Instagram Reel",
        "Instagram IGTV" => "Instagram IGTV",
        "TikTok Video" => "TikTok Video"
    ],
    "social_sites" => [
        "Facebook" => "Facebook",
        "Twitter" => "Twitter",
        "Youtube" => "Youtube",
        "Google+" => "Google+",
        "Linkedin" => "Linkedin",
        "Orcid" => "Orcid",
        "ResearchGate" => "ResearchGate",
        "Google Scholar" => "Google Scholar",
        "Github" => "Github",
        "Instagram" => "Instagram",
    ],
    // media collection
    'media_collection' => [
        'slider' => [
            'image' => 'slider_image',
        ],
        'page' => [
            'image' => 'page_feature_image',
        ],
        'testimonial' => [
            'avatar' => 'testimonial_avatar',
        ],
        'user' => [
            'avatar' => 'user_avatar',
        ],
        'user_additional_info' => [
            'image' => 'user_additional_info_image'
        ],
        'campaign' => [
            'logo' => 'campaign_logo',
        ],
        'brand' => [
            'logo' => 'brand_logo',
        ],
        'product' => [
            'image' => 'product_image',
        ],
        'setting_site' => [
            'logo' => 'setting_site_logo',
            'logo_secondary' => 'setting_site_logo_secondary',
            'favicon' => 'setting_site_favicon',
            'banner_image' => 'setting_site_banner_image',
            'breadcrumb_image' => 'setting_site_breadcrumb_image',
            'parallax_image_1' => 'setting_site_parallax_image_1',
            'parallax_image_2' => 'setting_site_parallax_image_2',
            'parallax_image_3' => 'setting_site_parallax_image_3',
            'footer_image' => 'setting_site_footer_image'
        ],
        'attachment' => [
            'attachment' => 'attachment_data'
        ]
    ],
    'image' => [
        'default' => [
            'logo' => '/admin/images/default/logo.png',
            'logo_second' => '/admin/images/default/logo-second.png',
            'logo_preview' => '/admin/images/default/logo-preview.png',
            'favicon' => '/admin/images/default/favicon.png',
            'avatar_male' => '/admin/images/default/avatar-male.jpeg',
            'avatar_female' => '/admin/images/default/avatar-female.png',
            'preview_image' => '/admin/images/default/preview.png',
            'banner_image' => '/admin/images/default/banner.png',
            'breadcrumb_image' => '/admin/images/default/breadcrumb.jpg',
            'parallax_image_1' => '/admin/images/default/parallax-1.jpg',
            'parallax_image_2' => '/admin/images/default/parallax-2.jpg',
            'parallax_image_3' => '/admin/images/default/parallax-3.jpg',
            'footer_image' => '/admin/images/default/footer.jpg',
            'slider_image' => '/admin/images/default/slider.jpg'
        ]
    ]
];
