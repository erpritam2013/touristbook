<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Terms\TermActivityList;
class TermActivityListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            $wp_terms = array(
  array('name' => 'Hot Air Ballooning','slug' => 'hot-air-ballooning','parent' => 'air-based'),
  array('name' => 'Paragliding','slug' => 'paragliding','parent' => 'air-based'),
  array('name' => 'Para Motoring','slug' => 'para-motoring','parent' => 'air-based'),
  array('name' => 'Parasailing','slug' => 'parasailing','parent' => 'air-based'),
  array('name' => 'Ski Diving','slug' => 'ski-diving','parent' => 'air-based'),
  array('name' => 'Air Safaris','slug' => 'air-safaris','parent' => 'air-based'),
  array('name' => 'Kite Boarding','slug' => 'kite-boarding','parent' => 'air-based'),
  array('name' => 'Helicopter Ride','slug' => 'helicopter-ride','parent' => 'air-based'),
  array('name' => 'Kayaking','slug' => 'kayaking','parent' => 'water-based'),
  array('name' => 'Rafting','slug' => 'rafting','parent' => 'water-based'),
  array('name' => 'River Cruising','slug' => 'river-cruising','parent' => 'water-based'),
  array('name' => 'Scuba Diving','slug' => 'scuba-diving','parent' => 'water-based'),
  array('name' => 'Snorkeling','slug' => 'snorkeling','parent' => 'water-based'),
  array('name' => 'Canoeing','slug' => 'canoeing','parent' => 'water-based'),
  array('name' => 'Windsurfing','slug' => 'windsurfing','parent' => 'water-based'),
  array('name' => 'Boating','slug' => 'boating','parent' => 'water-based'),
  array('name' => 'Bamboo Boating','slug' => 'bamboo-boating','parent' => 'water-based'),
  array('name' => 'Banana Boat Ride','slug' => 'banana-boat-ride','parent' => 'water-based'),
  array('name' => 'Cliff Jumping','slug' => 'cliff-jumping','parent' => 'water-based'),
  array('name' => 'Waterfall Rappelling','slug' => 'waterfall-rappelling','parent' => 'water-based'),
  array('name' => 'Peddle Boarding','slug' => 'peddle-boarding','parent' => 'water-based'),
  array('name' => 'Angling/Fishing','slug' => 'angling-fishing','parent' => 'water-based'),
  array('name' => 'Wildlife Safaris','slug' => 'wildlife-safaris','parent' => 'land-based'),
  array('name' => 'Horse Safaris','slug' => 'horse-safaris','parent' => 'land-based'),
  array('name' => 'Bungee Jumping','slug' => 'bungee-jumping','parent' => 'land-based'),
  array('name' => 'Trekking','slug' => 'trekking','parent' => 'land-based'),
  array('name' => 'Mountain Biking','slug' => 'mountain-biking','parent' => 'land-based'),
  array('name' => 'All-Terrain Vehicle Tours (ATV)','slug' => 'all-terrain-vehicle-tours-atv','parent' => 'land-based'),
  array('name' => 'Cycling Tour','slug' => 'cycling-tour','parent' => 'land-based'),
  array('name' => 'Camel Safaris','slug' => 'camel-safaris','parent' => 'land-based'),
  array('name' => 'Jeep Safaris','slug' => 'jeep-safaris','parent' => 'land-based'),
  array('name' => 'Motorcycle Tours','slug' => 'motorcycle-tours','parent' => 'land-based'),
  array('name' => 'Mountaineering','slug' => 'mountaineering','parent' => 'land-based'),
  array('name' => 'Nature Walks','slug' => 'nature-walks','parent' => 'land-based'),
  array('name' => 'Rock Climbing','slug' => 'rock-climbing','parent' => 'land-based'),
  array('name' => 'Heli Sikiing','slug' => 'heli-sikiing','parent' => 'land-based'),
  array('name' => 'Zip Wires/Flying fox','slug' => 'zip-wires-flying-fox','parent' => 'land-based'),
  array('name' => 'High Ropes Course','slug' => 'high-ropes-course','parent' => 'land-based'),
  array('name' => 'Bulls Chase','slug' => 'bulls-chase','parent' => 'land-based'),
  array('name' => 'Caving','slug' => 'caving','parent' => 'land-based'),
  array('name' => 'Dune Bashing','slug' => 'dune-bashing','parent' => 'land-based'),
  array('name' => 'Snowboarding','slug' => 'snowboarding','parent' => 'land-based'),
  array('name' => 'Forest Camping','slug' => 'forest-camping-camping','parent' => 'land-based'),
  array('name' => 'Hiking','slug' => 'hiking','parent' => 'land-based'),
  array('name' => 'Golfing','slug' => 'golfing','parent' => 'land-based'),
  array('name' => 'Sky Cycling','slug' => 'sky-cycling','parent' => 'land-based'),
  array('name' => 'Paintball','slug' => 'paintball','parent' => 'land-based'),
  array('name' => 'Reveres Bungee Jumping','slug' => 'reveres-bungee-jumping','parent' => 'land-based'),
  array('name' => 'Rope Course','slug' => 'rope-course','parent' => 'land-based'),
  array('name' => 'Giant Swing','slug' => 'giant-swing','parent' => 'land-based'),
  array('name' => 'Rappelling','slug' => 'rappelling','parent' => 'land-based'),
  array('name' => 'Body Surfing','slug' => 'body-surfing','parent' => 'water-based'),
  array('name' => 'Gondola Ride/Cable Car Ride','slug' => 'gondola-ride-cable-car-ride','parent' => 'land-based'),
  array('name' => 'Village Tour','slug' => 'village-tour','parent' => 'land-based'),
  array('name' => 'Yoga &amp; Meditation','slug' => 'yoga-meditation','parent' => 'land-based'),
  array('name' => 'Sea Kayaking','slug' => 'sea-kayaking','parent' => 'water-based'),
  array('name' => 'Hand Gliding','slug' => 'hand-gliding','parent' => 'air-based'),
  array('name' => 'Skiing','slug' => 'skking','parent' => 'land-based'),
  array('name' => 'Snow Boarding','slug' => 'snow-boarding','parent' => 'land-based'),
  array('name' => 'Camping','slug' => 'camping','parent' => 'land-based'),
  array('name' => 'Bird Watching','slug' => 'bird-watching','parent' => 'land-based'),
  array('name' => 'Bowling','slug' => 'bowling','parent' => 'land-based'),
  array('name' => 'Wall Climbing','slug' => 'wall-climbing','parent' => 'land-based'),
  array('name' => 'Trampoline','slug' => 'trampoline','parent' => 'land-based'),
  array('name' => 'Zorbing','slug' => 'zorbing','parent' => 'land-based'),
  array('name' => 'Water Skiing','slug' => 'water-skiing','parent' => 'water-based')
);
  foreach ($wp_terms as $key => $wp_term) {
        TermActivityList::create($wp_term);
  }
    }
}
