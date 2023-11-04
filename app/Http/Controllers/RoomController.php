<?php

namespace App\Http\Controllers;
use App\Interfaces\RoomRepositoryInterface;
use App\Interfaces\FacilityRepositoryInterface;
use App\Interfaces\TypeRepositoryInterface;
use App\Interfaces\HotelRepositoryInterface;
use App\Interfaces\LocationRepositoryInterface;

use App\Models\Room;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\DataTables\RoomDataTable;
use Session;

class RoomController extends Controller
{

    private RoomRepositoryInterface $roomRepository;
    private FacilityRepositoryInterface $facilityRepository;
    private TypeRepositoryInterface $typeRepository;
    private HotelRepositoryInterface $hotelRepository;
    private LocationRepositoryInterface $locationRepository;


    public function __construct( RoomRepositoryInterface $roomRepository,
        FacilityRepositoryInterface $facilityRepository,
        TypeRepositoryInterface $typeRepository,
        HotelRepositoryInterface $hotelRepository,
        LocationRepositoryInterface $locationRepository,
    )
    {
        $this->roomRepository = $roomRepository;
        $this->facilityRepository = $facilityRepository;
        $this->typeRepository = $typeRepository;
        $this->hotelRepository = $hotelRepository;
        $this->locationRepository = $locationRepository;

    }

    private function _prepareBasicData() {


        $data['facilities'] = $this->facilityRepository->getActiveRoomFacilitiesList();
        $data['types'] = $this->typeRepository->getActiveRoomTypesList();
        $data['hotels'] = $this->hotelRepository->getActiveHotelList()->map(function($value, $key){
          return (object)[
            'id' => $value->id,
            'value' => $value->name,
        ]; 
    });

        $data['locations'] = $this->locationRepository->getActiveLocationsList(); 


        return $data;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RoomDataTable $dataTable)
    {
        $data['rooms'] = Room::count();
        $data['title'] = 'Room List';
        return $dataTable->render('admin.rooms.index', $data);
    }


    public function changeStatus(Request $request): JsonResponse
    {
        $roomId = $request->id;
        $roomDetails = [
            'status' => $request->status,
        ];
        $this->roomRepository->updateroom($roomId, $roomDetails);

        return response()->json(['success' => 'Status change successfully.']);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     $data['title'] = 'Room Add';
     $data['room'] = new Room();
     $data = array_merge_recursive($data, $this->_prepareBasicData());

     return view('admin.rooms.create', $data);
 }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoomRequest $request)
    {
   //   if (isset($request->featured_image)) {
         
   //     $request->merge([
   //      'featured_image' => json_decode($request->featured_image,true),
   //  ]);
   // }
   $roomDetails = [

      
      'name' =>$request->name,
      'hotel_id' =>$request->hotel_id,
      'slug' => SlugService::createSlug(room::class, 'slug', $request->name),
      'description' =>$request->description,
      'excerpt' =>$request->excerpt,
      'address' =>$request->address,
      'price' =>$request->price,
      'number_room' =>$request->number_room,
      'adult_number' =>$request->adult_number,
      'children_number' =>$request->children_number,
      'adult_price' =>$request->adult_price,
      'child_price' =>$request->child_price,
      'extra_price' =>$request->extra_price,
      'extra_price_unit' =>$request->extra_price_unit,
      'featured_image' =>$request->featured_image,
          // 'featured_image_id' =>$request->featured_image_id,
          // 'created_by' =>$request->created_by,
      'status' =>$request->status,
      


            // TODO: created_by pending as Authentication is not Yet Completed
  ];


  if ($request->has('st_room_external_booking') && $request->st_room_external_booking == 0) {
      $request->merge([
        'st_room_external_booking_link' => null,
    ]);
  }

  $room = $this->roomRepository->createRoom($roomDetails);

  if ($room) {
            // TODO: Move this to Repository

    $roomMetaData = [

      "st_booking_option_type",
      "gallery",
      "hotel_alone_room_layout",
      "disable_adult_name",
      "disable_children_name",

          // "room_facility_preview_id",
      "room_facility_preview",

      "bed_number",
      "room_footage",
      "st_room_external_booking",
      "st_room_external_booking_link",
      "add_new_facility",
      "room_description",
      "social_links",

  ];

  $room->detail()->create($request->only($roomMetaData));




  $room->facilities()->attach($request->get('facilities'));
  $room->types()->attach($request->get('type'));
  $room->locations()->attach($request->get('location_id'));
  
            // activitiescard
}


        // return $room;
Session::flash('success','Room Created Successfully');
return redirect()->Route('admin.rooms.index');
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
       $room = Room::with([
        'facilities', 'types', 'hotels', 'locations',])->find($room->id);

       if (empty($room)) {
        return back();
    }

    $data['title'] = 'Room Edit';
    $data['room'] = $room;
    $data = array_merge_recursive($data, $this->_prepareBasicData());
    return view('admin.rooms.edit', $data);
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoomRequest  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
     //  if (isset($request->featured_image)) {
       
     //     $request->merge([
     //        'featured_image' => json_decode($request->featured_image,true),
     //    ]);
     // }
     
     $roomDetails = [
      'name' =>$request->name,
      'hotel_id' =>$request->hotel_id,
          //'slug' => SlugService::createSlug(room::class, 'slug', $request->name),
      'description' =>$request->description,
      'excerpt' =>$request->excerpt,
      'address' =>$request->address,
      'price' =>$request->price,
      'number_room' =>$request->number_room,
      'adult_number' =>$request->adult_number,
      'children_number' =>$request->children_number,
      'adult_price' =>$request->adult_price,
      'child_price' =>$request->child_price,
      'extra_price' =>$request->extra_price,
      'extra_price_unit' =>$request->extra_price_unit,
      'featured_image' =>$request->featured_image,
          // 'featured_image_id' =>$request->featured_image_id,
          // 'created_by' =>$request->created_by,
      'status' =>$request->status,
      


            // TODO: created_by pending as Authentication is not Yet Completed
  ];


  if ($request->has('st_room_external_booking') && $request->st_room_external_booking == 0) {
      $request->merge([
        'st_room_external_booking_link' => null,
    ]);
  }

  $this->roomRepository->updateRoom($room->id,$roomDetails);

  if ($room) {
            // TODO: Move this to Repository

    $roomMetaData = [

      "st_booking_option_type",
      "gallery",
      "hotel_alone_room_layout",
      "disable_adult_name",
      "disable_children_name",

          // "room_facility_preview_id",
      "room_facility_preview",

      "bed_number",
      "room_footage",
      "st_room_external_booking",
      "st_room_external_booking_link",
      "add_new_facility",
      "room_description",
      "social_links",

  ];

  $room->detail()->update($request->only($roomMetaData));




  $room->facilities()->sync($request->get('facilities'));
  $room->types()->sync($request->get('type'));
  $room->locations()->sync($request->get('location_id'));
  
            // activitiescard
}


        // return $room;
Session::flash('success','Room Updated Successfully');
return redirect()->Route('admin.rooms.edit',$room->id);
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
      $roomId = $room->id;

      $this->roomRepository->deleteRoom($roomId);
      Session::flash('success','Room Deleted Successfully');
      return back();
  }


  public function bulk_delete(Request $request)
  {
    if (!empty($request->ids)) {

        $roomIds = get_array_mapping(json_decode($request->ids));
        $this->roomRepository->deleteBulkRoom($roomIds);
        Session::flash('success', 'Room Bulk Deleted Successfully');
    }
    return back();
}
}
