<?php
return [

    'policies' => [
            "fields" => [
                "policies-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "policies-policy_description" => [
                    'label' => "Policy Description",
                    'control' => 'textarea'
                ],
                "policies-policy_parent" => [
                    'label' => "Policy Parent Important Note Title",
                    'control' => 'text'
                ]
            ]

        ],
    'notices' => [
            "fields" => [
                "notices-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "notices-description" => [
                    'label' => "Description",
                    'control' => 'textarea',
                    'class' => 'tourist-editor'
                ]
            ]

        ],
    'highlights' => [
            "fields" => [
                "highlights-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "highlights-url_link" => [
                    'label' => "URL Link",
                    'control' => 'text'
                ],
                "highlights-file" => [
                    'label' => "File Upload",
                    'control' => 'media'
                ]
            ]

        ],
    'facilityAmenities' => [
            "fields" => [
                "facilityAmenities-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "facilityAmenities-description" => [
                    'label' => "Description",
                    'control' => 'textarea',
                ]
            ]

        ],
    'about_info' => [
            "fields" => [
                "about_info-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "about_info-description" => [
                    'label' => "Description",
                    'control' => 'textarea',
                    'class' => 'tourist-editor'
                ]
            ]

        ],
    'about_team' => [
            "fields" => [
                "about_team-name" => [
                    'label' => "Name",
                    'control' => 'text'
                ],
                "about_team-position" => [
                    'label' => "Position",
                    'control' => 'text'
                ],
                "about_team-image" => [
                    'label' => "Image",
                    'control' => 'media'
                ],
                "about_team-facebook" => [
                    'label' => "Facebook Link",
                    'control' => 'url'
                ],
                "about_team-twitter" => [
                    'label' => "Twitter Link",
                    'control' => 'url'
                ],
                "about_team-instagram" => [
                    'label' => "Instagram Link",
                    'control' => 'url'
                ],
                "about_team-youtube" => [
                    'label' => "Youtube Link",
                    'control' => 'url'
                ],
            ]

        ],
    'foods' => [
            "fields" => [
                "foods-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "foods-icon" => [
                    'label' => "Icon",
                    'control' => 'text'
                ]
            ]

        ],
    'drinks' => [
            "fields" => [
                "drinks-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "drinks-icon" => [
                    'label' => "Icon",
                    'control' => 'text'
                ]
            ]

        ],
    'complimentary' => [
            "fields" => [
                "complimentary-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "complimentary-icon" => [
                    'label' => "Icon",
                    'control' => 'text'
                ]
            ]

        ],
    'helpfulfacts' => [
            "fields" => [
                "helpfulfacts-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "helpfulfacts-description" => [
                    'label' => "Description",
                    'control' => 'textarea'
                ],
                "helpfulfacts-description" => [
                    'label' => "Short Description",
                    'control' => 'textarea'
                ]
            ]

        ],
    'tour_helpful_facts' => [
            "fields" => [
                "tour_helpful_facts-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "tour_helpful_facts-description" => [
                    'label' => "Description",
                    'control' => 'textarea'
                ],
                "tour_helpful_facts-description" => [
                    'label' => "Short Description",
                    'control' => 'textarea'
                ]
            ]

        ],
    'pocketPDF' => [
            "fields" => [
                "pocketPDF-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "pocketPDF-description" => [
                    'label' => "Description",
                    'control' => 'textarea',
                    'class' => 'tourist-editor'
                ]
            ]

        ],
    'landmark' => [
            "fields" => [
                "landmark-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "landmark-description" => [
                    'label' => "Description",
                    'control' => 'textarea'
                ],
                "landmark-short-description" => [
                    'label' => "Short Description",
                    'control' => 'textarea'
                ]
            ]

        ],
    'add_new_facility' => [
            "fields" => [
                "add_new_facility-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "add_new_facility-value" => [
                    'label' => "Value",
                    'control' => 'text'
                ],
                "add_new_facility-icon" => [
                    'label' => "Icon",
                    'control' => 'text',
                    'desc' => 'Support: fonticon (eg: fa-facebook)'
                ]
            ]

        ],
    'todo' => [
            "fields" => [
                "todo-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "todo-icon" => [
                    'label' => "Icon",
                    'control' => 'text'
                ]
            ]

        ],
    'offers' => [
            "fields" => [
                "offers-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "offers-description" => [
                    'label' => "Description",
                    'control' => 'textarea'
                ]
            ]

        ],
    'todovideo' => [
            "fields" => [
                "todovideo-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "todovideo-file" => [
                    'label' => "Thumbnail image",
                    'control' => 'media'
                ],
                "todovideo-url" => [
                    'label' => "Video Link",
                    'control' => 'text'
                ]
            ]

        ],
    'eventmeeting' => [
            "fields" => [
                "eventmeeting-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "eventmeeting-description" => [
                    'label' => "Description",
                    'control' => 'textarea'
                ],
                "eventmeeting-file" => [
                    'label' => "Thumbnail image",
                    'control' => 'media'
                ],
                "eventmeeting-url" => [
                    'label' => "Video Link",
                    'control' => 'text'
                ]
            ]

        ],
    'country_zone_section' => [
            "fields" => [
                "country_zone_section-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "country_zone_section-description" => [
                    'label' => "Description",
                    'control' => 'textarea',
                    'class' => 'tourist-editor'
                ],
                "country_zone_section-url" => [
                    'label' => "Video Link",
                    'control' => 'text'
                ]
            ]

        ],
    'activity_zone_section' => [
            "fields" => [
                "activity_zone_section-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "activity_zone_section-parent" => [
                    'label' => "Parent Tab",
                    'control' => 'text'
                ],
                "activity_zone_section-description" => [
                    'label' => "Description",
                    'control' => 'textarea',
                    'class' => 'tourist-editor'
                ],
                "activity_zone_section-url" => [
                    'label' => "Video Link",
                    'control' => 'text'
                ]
            ]

        ],
    'tourism_zone' => [
            "fields" => [
                "tourism_zone-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],

                "tourism_zone-parent" => [
                    'label' => "Parent Tab",
                    'control' => 'text'
                ],
                "tourism_zone-description" => [
                    'label' => "Description",
                    'control' => 'textarea',
                    'class' => 'tourist-editor'
                ],
                "tourism_zone-url" => [
                    'label' => "Video Link",
                    'control' => 'url'
                ]
            ]

        ],
    'location_for_filter' => [
            "fields" => [
                "location_for_filter-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "location_for_filter-icon" => [
                    'label' => "Icon",
                    'control' => 'text'
                ],
            ]

        ],

    'tourismzonepdf' => [
            "fields" => [
                "tourismzonepdf-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "tourismzonepdf-description" => [
                    'label' => "Description",
                    'control' => 'textarea'
                ],
                "todovideo-url" => [
                    'label' => "Youtube Link",
                    'control' => 'text'
                ]
            ]

        ],
    'activities' => [
            "fields" => [
                "activities-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "activities-description" => [
                    'label' => "Description",
                    'control' => 'textarea'
                ]
            ]

        ],
    'transport' => [
            "fields" => [
                "transport-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "transport-description" => [
                    'label' => "Description",
                    'control' => 'textarea',
                    'class' => 'tourist-editor'
                ]
            ]

        ],
    'emergencyLinks' => [
            "fields" => [
                "emergencyLinks-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "emergencyLinks-description" => [
                    'label' => "Description",
                    'control' => 'textarea',
                    'class' => 'tourist-editor'
                ],
                "emergencyLinks-link" => [
                    'label' => "Link",
                    'control' => 'text'
                ]
            ]

        ],
    'place_to_visit' => [
            "fields" => [
                "place_to_visit-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "place_to_visit-description" => [
                    'label' => "Description",
                    'control' => 'textarea',
                    'class'   => 'tourist-editor'
                ],
                "place_to_visit-image" => [
                    'label' => "Image",
                    'control' => 'media'
                ],
            ]

        ],
    'activity_program' => [
            "fields" => [
                "activity_program-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "activity_program-image" => [
                    'label' => "Image",
                    'control' => 'media'
                ],
                "activity_program-description" => [
                    'label' => "Description",
                    'control' => 'textarea'
                ],
            ]

        ],
    'activity_program_bgr' => [
            "fields" => [
                "activity_program_bgr-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                    
                "activity_program_bgr-time" => [
                    'label' => "Sub Title",
                    'control' => 'text'
                ],
                "activity_program_bgr-image" => [
                    'label' => "Image",
                    'control' => 'media'
                ],
                "activity_program_bgr-description" => [
                    'label' => "Description",
                    'control' => 'textarea'
                ],
            ]

        ],
    'tours_program' => [
            "fields" => [
                "tours_program-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "tours_program-image" => [
                    'label' => "Image",
                    'control' => 'media'
                ],
                "tours_program-desc" => [
                    'label' => "Description",
                    'control' => 'textarea'
                ],
            ]

        ],
    'tours_program_bgr' => [
            "fields" => [
                "tours_program_bgr-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                    
                "tours_program_bgr-time" => [
                    'label' => "Sub Title",
                    'control' => 'text'
                ],
                "tours_program_bgr-image" => [
                    'label' => "Image",
                    'control' => 'media'
                ],
                "tours_program_bgr-description" => [
                    'label' => "Description",
                    'control' => 'textarea'
                ],
            ]

        ],
    'tours_program_style4' => [
            "fields" => [
                "tours_program_style4-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                    
                "tours_program_style4-time" => [
                    'label' => "Sub Title",
                    'control' => 'text'
                ],
                "tours_program_style4-image" => [
                    'label' => "Image",
                    'control' => 'media'
                ],
                "tours_program_style4-description" => [
                    'label' => "Description",
                    'control' => 'textarea'
                ],
            ]

        ],
    'package_route' => [
            "fields" => [
                "package_route-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
            ]

        ],
    'activity_faq' => [
            "fields" => [
                "activity_faq-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "activity_faq-description" => [
                    'label' => "Description",
                    'control' => 'textarea'
                ],
            ]

        ],
    'tours_faq' => [
            "fields" => [
                "tours_faq-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "tours_faq-description" => [
                    'label' => "Description",
                    'control' => 'textarea'
                ],
            ]

        ],
    'activity_zones' => [
            "fields" => [
                "activity_zones-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "activity_zones-url_link_status" => [
                    'label' => "Select Url Options",
                    'control' => 'select',
                    'class'=> 'activity_zones-url_link_status',
                    'options' => [
                                [
                                    'id'=>'slug',
                                    'value'=>'Slug',
                                ],
                                [
                                    'id'=>'web-link',
                                    'value'=>'Website Link',
                                ],
                                [
                                    'id'=>'file',
                                    'value'=>'File',
                                ],

                                ]
                ],
                "activity_zones-slug" => [
                    'label' => "Slug Name",
                    'desc' => "if you have custom slug name like this(abs-bsd) to add here",
                    'control' => 'select',
                    'hide'=> 'd-none',
                    'class'=> 'activity_zones-slug',
                    'options' => [
                                [
                                    'id'=>'tourism-zone',
                                    'value'=>'Tourism Zone',
                                ],
                                [
                                    'id'=>'activity-zone',
                                    'value'=>'Activity Zone',
                                ],

                                ]
                ],
                "activity_zones-file" => [
                    'label' => "File",
                    'control' => 'media',
                    'hide'=> 'd-none',
                    'class'=> 'activity_zones-file',

                ],
                "activity_zones-web_link" => [
                    'label' => "Website LINK",
                    'desc' => "if you have website url to add here",
                    'control' => 'url',
                    'hide'=> 'd-none',
                    'class'=> 'activity_zones-web_link',
                ],
            ]

        ],
    'best_time_to_visit' => [
            "fields" => [
                "best_time_to_visit-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "best_time_to_visit-travel_seasons" => [
                    'label' => "Travel Seasons",
                    'control' => 'text',
                    'desc' => 'Travel Seasons'
                ],
                "best_time_to_visit-min_max_temperature" => [
                    'label' => "Min/Max Temperature",
                    'control' => 'text',
                    'desc' => 'Min/Max Temperature'
                ],
                "best_time_to_visit-season" => [
                    'label' => "Season",
                    'control' => 'text',
                    'desc' => 'Season'
                ]

            ]

        ],
        'how_to_reach' => [
            "fields" => [
                "how_to_reach-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "how_to_reach-description" => [
                    'label' => "Description",
                    'control' => 'textarea',
                    'class'   => 'tourist-editor'
                ],
                "how_to_reach-link" => [
                    'label' => "Link",
                    'control' => 'text'
                ],
            ]

        ],
        'fair_and_festivals' => [
            "fields" => [
                "fair_and_festivals-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "fair_and_festivals-description" => [
                    'label' => "Description",
                    'control' => 'textarea',
                    // 'class'   => 'tourist-editor'
                ],
                "fair_and_festivals-image" => [
                    'label' => "Image",
                    'control' => 'media'
                ],

                "fair_and_festivals-is_description" => [
                    'label' => "Set this only description",
                    'control' => 'radio',
                    'desc'=>'Set this only description'
                ],
            ]

        ],
        'tours_destinations' => [
            "fields" => [
                "tours_destinations-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "tours_destinations-titel_link" => [
                    'label' => "Title Link",
                    'control' => 'text',
                    // 'class'   => 'tourist-editor'
                ],
                "tours_destinations-video_thumbnail" => [
                    'label' => "Video Thumbnail Image",
                    'control' => 'media'
                ],

                "tours_destinations-youtube_link" => [
                    'label' => "You Tube Video Link",
                    'control' => 'url'
                ],
            ]

        ],
        'tour_sponsored_by' => [
            "fields" => [
                "tour_sponsored_by-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "tour_sponsored_by-sponsor_heading" => [
                    'label' => "Sponsored Heading",
                    'control' => 'text'
                ],
                "tour_sponsored_by-description" => [
                    'label' => "Description",
                    'control' => 'textarea',
                    // 'class'   => 'tourist-editor'
                ],
            ]

        ],
        'culinary_retreat' => [
            "fields" => [
                "culinary_retreat-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "culinary_retreat-description" => [
                    'label' => "Description",
                    'control' => 'textarea',
                    // 'class'   => 'tourist-editor'
                ],
                "culinary_retreat-image" => [
                    'label' => "Image",
                    'control' => 'media'
                ]
            ]

        ],
        'shopaholics_anonymous' => [
            "fields" => [
                "shopaholics_anonymous-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "shopaholics_anonymous-description" => [
                    'label' => "Description",
                    'control' => 'textarea',
                    // 'class'   => 'tourist-editor'
                ],
                "shopaholics_anonymous-image" => [
                    'label' => "Image",
                    'control' => 'media'
                ]
            ]

        ],

        'hotel_activities' => [
            "fields" => [
                "hotel_activities-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "hotel_activities-description" => [
                    'label' => "Description",
                    'control' => 'textarea',
                    // 'class'   => 'tourist-editor'
                ],
                "hotel_activities-image" => [
                    'label' => "Image",
                    'control' => 'media'
                ]
            ]

        ],

        'by_aggregators' => [
            "fields" => [
                "by_aggregators-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "by_aggregators-description" => [
                    'label' => "Description",
                    'control' => 'textarea',
                    'class'   => 'tourist-editor'
                ],
                "by_aggregators-image" => [
                    'label' => "Image",
                    'control' => 'media'
                ]
            ]

        ],

        'b_govt_subsidiaries' => [
            "fields" => [
                "b_govt_subsidiaries-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "b_govt_subsidiaries-description" => [
                    'label' => "Description",
                    'control' => 'textarea',
                    'class'   => 'tourist-editor'
                ],
                "b_govt_subsidiaries-image" => [
                    'label' => "Image",
                    'control' => 'media'
                ]
            ]

        ],

        'by_hotels' => [
            "fields" => [
                "by_hotels-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "by_hotels-description" => [
                    'label' => "Description",
                    'control' => 'textarea',
                    'class'   => 'tourist-editor'
                ],
                "by_hotels-image" => [
                    'label' => "Image",
                    'control' => 'media'
                ]
            ]

        ],

        'weather' => [
            "fields" => [
                "weather-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "weather-description" => [
                    'label' => "Description",
                    'control' => 'textarea',
                    // 'class'   => 'tourist-editor'
                ],
                "weather-link" => [
                    'label' => "Link",
                    'control' => 'text'
                ],
            ]

        ],

        'location_map' => [
            "fields" => [
                "location_map-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "location_map-link" => [
                    'label' => "Google Link",
                    'control' => 'text'
                ],
            ]

        ],

           'get_to_know' => [
            "fields" => [
                "get_to_know-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "get_to_know-description" => [
                    'label' => "Description",
                    'control' => 'textarea',
                     'class'   => 'tourist-editor'
                ]
            ]

        ],

             'what_to_do' => [
            "fields" => [
                "what_to_do-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "what_to_do-description" => [
                    'label' => "Description",
                    'control' => 'textarea',
                    'class'   => 'tourist-editor'
                ],
                "what_to_do-image" => [
                    'label' => "Image",
                    'control' => 'media'
                ]
            ]

        ],

           'save_your_pocket' => [
            "fields" => [
                "save_your_pocket-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "save_your_pocket-description" => [
                    'label' => "Description",
                    'control' => 'textarea',
                    'class'   => 'tourist-editor'
                ]
            ]

        ],

           'save_your_environment' => [
            "fields" => [
                "save_your_environment-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "save_your_environment-description" => [
                    'label' => "Description",
                    'control' => 'textarea',
                    'class'   => 'tourist-editor'
                ]
            ]

        ],

           'faqs' => [
            "fields" => [
                "faqs-title" => [
                    'label' => "Title",
                    'control' => 'text'
                ],
                "faqs-description" => [
                    'label' => "Description",
                    'control' => 'textarea',
                    'class'   => 'tourist-editor'
                ]
            ]

        ],

];
