<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Media;
use App\Models\Tour;
use App\Models\Hotel;
use App\Models\Activity;
use App\Models\Location;
use App\Models\TourismZone;
use App\Models\ActivityZone;
use App\Models\Room;
use App\Models\ActivityLists;
use App\Models\Post;
use App\Models\Page;
use App\Models\Setting;
use App\Models\CountryZone;
use App\Models\FileDeleteHistory;
use Illuminate\Http\Request;
use App\DataTables\MediaDataTable;
use Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;

class FileController extends Controller
{


    public function index(MediaDataTable $dataTable)
    {
        $data['media'] = Media::count();
        $data['title'] = 'Media List';
        return $dataTable->render('admin.settings.media-object.index', $data);
    }
    public function loadImages(Request $request)
    {
        $pageNumber = 1;
        if ($request->has('page')) {
            $pageNumber = $request->get('page');
        }

        $mediaQuery = Media::orderBy("created_at", "desc");

        if ($request->has('searchTxt') && !empty($request->get('searchTxt'))) {
            $searchTxt = $request->get('searchTxt');
            $mediaQuery->where('name', 'LIKE', '%' . $searchTxt . '%')->orWhere('file_name', 'LIKE', '%' . $searchTxt . '%');
        }
        // $mediaQuery->get('id')
        //$item->responsive_images = getConversionUrl($item->id,'thumbnail');
        $media_list = $mediaQuery->paginate(20, ['*'], 'page', $pageNumber);
        $media_list->reduce(function ($carry, $item) {
            $item->thumbnail = getConversionUrl($item->id, 'thumbnail');
            return $item;
        });
        return response()->json($media_list);
    }

    public function uploadImages(Request $request)
    {
        $uploadedFile = $request->file('file');
        // TODO: Need to Improve
        $file = new File();

        $file->save();

        $file->addMedia($uploadedFile)
            ->toMediaCollection('images');

        $media = $file->getMedia('images')->first();

        return [
            'url' => $media->getUrl(),
            'id' => $media->id,
            'name' => $media->name,
            'thumbnail' => $file->getFirstMediaUrl('images', 'thumbnail')
        ];
    }

    public function destroy(Request $request, $id)
    {

        $media = Media::find($id);

        if (!$media) {
            abort(404);
        }

        $path  = $media->getPath();

        $file_arr = explode('.', $path);
        if (!empty($media->generated_conversions) && is_array($media->generated_conversions)) {
            foreach ($media->generated_conversions as $key => $generated_conversions) {
                if ($key == 'thumbnail') {
                    $key = "100x100";
                }
                $conversion_file = $file_arr[0] . '-' . $key . '.' . $file_arr[1];
                if (Storage::disk('s3')->exists($conversion_file)) {
                    Storage::disk('s3')->delete($conversion_file);
                }
            }
        }

        if (Storage::disk('s3')->exists($path)) {
            Storage::disk('s3')->delete($path);
        }

        $file_delete_history = new FileDeleteHistory();
        $file_delete_history->name = $media->name;
        $file_delete_history->file_name = $media->file_name;
        $file_delete_history->path = $media->getPath();
        $file_delete_history->created_date = $media->created_at;
        $file_delete_history->mime_type = $media->mime_type;
        $file_delete_history->generated_conversions = $media->generated_conversions;
        $file_delete_history->file_id = $media->model_id;
        $file_delete_history->media_id = $media->id;
        $file_delete_history->disk = $media->disk;
        $file_delete_history->status = 1;
        $file_delete_history->save();
        $file = File::find($media->model_id);
        if ($file) {
          $file->deletePreservingMedia();
        }

        $media->delete();
        Session::flash('success', 'Media Deleted Successfully');
        return back();
    }

    public function media_used_objects($id)
    {

        $data['title'] = 'Used Media';

        $media = Media::find($id);;
        if (!$media) {
            abort(404);
        }

        $data['media'] = Media::find($media->file_name);
        $data['tours'] = $this->getTours($media->file_name);
        $data['hotels'] = $this->getHotels($media->file_name);
        $data['activities'] = $this->getActivities($media->file_name);
        $data['locations'] = $this->getLocations($media->file_name);
        $data['rooms'] = $this->getRooms($media->file_name);
        $data['tourism_zones'] = $this->getTourismZones($media->file_name);
        $data['activity_zones'] = $this->getActivityZones($media->file_name);
        $data['country_zones'] = $this->getCountryZones($media->file_name);
        $data['pages'] = $this->getPages($media->file_name);
        $data['posts'] = $this->getPosts($media->file_name);
        $data['settings'] = $this->getSettings($media->file_name);
        return view('admin.settings.media-object.used_media', $data);
    }


    public function getSettings($id)
    {
        $settingQuery = Setting::query();
        $settingQuery->selectRaw(' settings.*');
        $settingQuery->where('settings.value', 'like', '%' . $id . '%');
        $settings = $settingQuery->groupBy('settings.id')->get();
        return $settings;
    }

    public function getPosts($id)
    {
        $post_columns = Schema::getColumnListing('posts');

        $post_columns_collection = collect($post_columns);
        $post_columns = $post_columns_collection->except([0, 1, 2, 4, 7, 8, 10, 11, 12, 13, 14])->map(function ($item) {
            return 'posts.' . $item;
        })->toArray();
        $post_columns = array_values($post_columns);

        $postQuery = post::query();
        $postQuery->selectRaw(' posts.*');
        foreach ($post_columns as $key => $post_column) {
            $postQuery->orWhere($post_column, 'like', '%' . $id . '%');
        }
        $posts = $postQuery->groupBy('posts.id')->get();
        return $posts;
    }
    public function getPages($id)
    {
        $page_columns = Schema::getColumnListing('pages');


        $page_columns_collection = collect($page_columns);
        $page_columns = $page_columns_collection->except([0, 1, 2, 4, 7, 8, 12, 13, 14, 15, 16])->map(function ($item) {
            return 'pages.' . $item;
        })->toArray();
        $page_columns = array_values($page_columns);


        $pageQuery = Page::query();
        $pageQuery->selectRaw(' pages.*');
        foreach ($page_columns as $key => $page_column) {
            $pageQuery->orWhere($page_column, 'like', '%' . $id . '%');
        }
        $pages = $pageQuery->groupBy('pages.id')->get();
        return $pages;
    }
    public function getCountryZones($id)
    {
        $country_zone_columns = Schema::getColumnListing('country_zones');

        $country_zone_columns_collection = collect($country_zone_columns);
        $country_zone_columns = $country_zone_columns_collection->except([0, 1, 2, 3, 4, 5, 6, 12, 13, 14, 15, 16])->map(function ($item) {
            return 'country_zones.' . $item;
        })->toArray();
        $country_zone_columns = array_values($country_zone_columns);

        $country_zoneQuery = CountryZone::query();
        $country_zoneQuery->selectRaw(' country_zones.*');
        foreach ($country_zone_columns as $key => $country_zone_column) {
            $country_zoneQuery->orWhere($country_zone_column, 'like', '%' . $id . '%');
        }
        $country_zones = $country_zoneQuery->groupBy('country_zones.id')->get();
        return $country_zones;
    }
    public function getActivityZones($id)
    {
        $activity_zone_columns = Schema::getColumnListing('activity_zones');

        $activity_zone_columns_collection = collect($activity_zone_columns);
        $activity_zone_columns = $activity_zone_columns_collection->except([0, 1, 2, 3, 4, 5, 6, 11, 12, 13, 14, 15])->map(function ($item) {
            return 'activity_zones.' . $item;
        })->toArray();
        $activity_zone_columns = array_values($activity_zone_columns);

        $activity_zoneQuery = ActivityZone::query();
        $activity_zoneQuery->selectRaw(' activity_zones.*');
        foreach ($activity_zone_columns as $key => $activity_zone_column) {
            $activity_zoneQuery->orWhere($activity_zone_column, 'like', '%' . $id . '%');
        }
        $activity_zones = $activity_zoneQuery->groupBy('activity_zones.id')->get();
        return $activity_zones;
    }
    public function getTourismZones($id)
    {
        $tourism_zone_columns = Schema::getColumnListing('tourism_zones');

        $tourism_zone_columns_collection = collect($tourism_zone_columns);
        $tourism_zone_columns = $tourism_zone_columns_collection->except([0, 1, 2, 3, 4, 5, 6, 10, 11, 12, 13, 14])->map(function ($item) {
            return 'tourism_zones.' . $item;
        })->toArray();
        $tourism_zone_columns = array_values($tourism_zone_columns);

        $tourism_zoneQuery = TourismZone::query();
        $tourism_zoneQuery->selectRaw(' tourism_zones.*');
        foreach ($tourism_zone_columns as $key => $tourism_zone_column) {
            $tourism_zoneQuery->orWhere($tourism_zone_column, 'like', '%' . $id . '%');
        }
        $tourism_zones = $tourism_zoneQuery->groupBy('tourism_zones.id')->get();
        return $tourism_zones;
    }

    public function getRooms($id)
    {
        $room_columns = Schema::getColumnListing('rooms');
        $room_columns_collection = collect($room_columns);
        $room_columns = $room_columns_collection->except([0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 16, 17, 18, 19, 20, 21])->map(function ($item) {
            return 'rooms.' . $item;
        })->toArray();
        $room_columns = array_values($room_columns);
        $room_detail_columns = Schema::getColumnListing('room_details');
        $room_detail_columns_collection = collect($room_detail_columns);
        $room_detail_columns = $room_detail_columns_collection->except([0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 16, 17, 18, 19, 20, 21, 22, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38])->map(function ($item) {
            return 'room_details.' . $item;
        })->toArray();
        $room_detail_columns = array_values($room_detail_columns);
        $room_columns_merge = array_merge($room_columns, $room_detail_columns);
        $roomQuery = Room::query();

        $roomQuery->leftJoin('room_details', 'room_details.room_id', '=', 'rooms.id');
        foreach ($room_columns_merge as $key => $room_detail_column) {
            $roomQuery->orWhere($room_detail_column, 'like', '%' . $id . '%');
        }
        $rooms = $roomQuery->groupBy('rooms.id')->get();
        return $rooms;
    }
    public function getTours($id)
    {
        $tour_columns = Schema::getColumnListing('tours');

        $tour_columns_collection = collect($tour_columns);
        $tour_columns = $tour_columns_collection->except([0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52])->map(function ($item) {
            return 'tours.' . $item;
        })->toArray();
        $tour_columns = array_values($tour_columns);


        $tour_detail_columns = Schema::getColumnListing('tour_details');
        $tour_detail_columns_collection = collect($tour_detail_columns);

        $tour_detail_columns = $tour_detail_columns_collection->except([0, 1, 2, 3, 4, 5, 6, 7, 8, 12, 13, 14, 17, 18, 19, 20, 21, 22, 23, 26, 27, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 48, 49])->map(function ($item) {
            return 'tour_details.' . $item;
        })->toArray();
        $tour_detail_columns = array_values($tour_detail_columns);
        $tour_columns_merge = array_merge($tour_columns, $tour_detail_columns);
        $tourQuery = Tour::query();
        $tourQuery->selectRaw(' tours.*');
        $tourQuery->leftJoin('tour_details', 'tour_details.tour_id', '=', 'tours.id');
        foreach ($tour_columns_merge as $key => $tour_detail_column) {

            $tourQuery->orWhere($tour_detail_column, 'like', '%' . $id . '%');
        }
        $tours = $tourQuery->groupBy('tours.id')->get();
        return $tours;
    }
    public function getHotels($id)
    {

        $hotel_columns = Schema::getColumnListing('hotels');

        $hotel_columns_collection = collect($hotel_columns);

        $hotel_columns = $hotel_columns_collection->except([0, 1, 2, 3, 4, 5, 7, 11, 12, 17, 18, 19, 20, 23, 24, 25, 26, 27, 29, 30, 31])->map(function ($item) {
            return 'hotels.' . $item;
        })->toArray();
        $hotel_columns = array_values($hotel_columns);
        $hotel_detail_columns = Schema::getColumnListing('hotel_details');

        $hotel_detail_columns_collection = collect($hotel_detail_columns);

        $hotel_detail_columns = $hotel_detail_columns_collection->except([0, 1, 2, 3, 4, 5, 29, 30, 31, 32])->map(function ($item) {
            return 'hotel_details.' . $item;
        })->toArray();
        $hotel_detail_columns = array_values($hotel_detail_columns);
        $hotel_columns_merge = array_merge($hotel_columns, $hotel_detail_columns);
        $hotelQuery = Hotel::query();
        $hotelQuery->selectRaw(' hotels.*');
        $hotelQuery->leftJoin('hotel_details', 'hotel_details.hotel_id', '=', 'hotels.id');
        foreach ($hotel_columns_merge as $key => $hotel_detail_column) {
            $hotelQuery->orWhere($hotel_detail_column, 'like', '%' . $id . '%');
        }
        $hotels = $hotelQuery->groupBy('hotels.id')->get();
        return $hotels;
    }
    public function getActivities($id)
    {

        $activity_columns = Schema::getColumnListing('activities');
        $activity_columns_collection = collect($activity_columns);

        $activity_columns = $activity_columns_collection->except([0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 42, 43, 44, 45, 48])->map(function ($item) {
            return 'activities.' . $item;
        })->toArray();
        $activity_columns = array_values($activity_columns);
        $activity_detail_columns = Schema::getColumnListing('activity_details');

        $activity_detail_columns_collection = collect($activity_detail_columns);

        $activity_detail_columns = $activity_detail_columns_collection->except([0, 1, 2, 3, 4, 5, 6, 9, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 43, 44, 45])->map(function ($item) {
            return 'activity_details.' . $item;
        })->toArray();
        $activity_detail_columns = array_values($activity_detail_columns);
        $activity_columns_merge = array_merge($activity_columns, $activity_detail_columns);
        $activityQuery = activity::query();
        $activityQuery->selectRaw(' activities.*');
        $activityQuery->leftJoin('activity_details', 'activity_details.activity_id', '=', 'activities.id');
        foreach ($activity_columns_merge as $key => $activity_detail_column) {
            $activityQuery->orWhere($activity_detail_column, 'like', '%' . $id . '%');
        }
        $activities = $activityQuery->groupBy('activities.id')->get();
        return $activities;
    }

    public function getLocations($id)
    {
        $location_columns = Schema::getColumnListing('locations');
        $location_columns_collection = collect($location_columns);

        $location_columns = $location_columns_collection->except([0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 18, 19, 20, 21, 22])->map(function ($item) {
            return 'locations.' . $item;
        })->toArray();
        $location_columns = array_values($location_columns);
        $location_meta_columns = Schema::getColumnListing('location_meta');

        $location_meta_columns_collection = collect($location_meta_columns);

        $location_meta_columns = $location_meta_columns_collection->except([0, 1, 2, 36, 37, 38, 39, 40, 41, 42, 43])->map(function ($item) {
            return 'location_meta.' . $item;
        })->toArray();
        $location_meta_columns = array_values($location_meta_columns);

        $location_meta_column_merge = array_merge($location_columns, $location_meta_columns);

        $locationQuery = location::query();
        $locationQuery->selectRaw(' locations.*');

        $locationQuery->leftJoin('location_meta', 'location_meta.location_id', '=', 'locations.id');
        foreach ($location_meta_column_merge as $key => $location_meta_column) {

            $locationQuery->orWhere($location_meta_column, 'like', '%' . $id . '%');
        }
        $locations = $locationQuery->groupBy('locations.id')->get();
        return $locations;
    }
}
