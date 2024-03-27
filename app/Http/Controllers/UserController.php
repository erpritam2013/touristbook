<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Auth;
use DB;
use Illuminate\Support\Facades\Schema;


class UserController extends Controller
{


    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
    {
        // $data['users'] = User::count();
        $data['title'] = 'User List';

        return $dataTable->render('admin.users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add User';
        return view('admin.users.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $userDetails = $request->except('_token');
        $this->userRepository->createUser($userDetails);
        Session::flash('success','User Created Successfully');
        return redirect()->Route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $data['user'] = $user;
        $data['title'] = 'User';

        if (empty($data['user'])) {
            return back();
        }

        return view('admin.users.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $userId = $user->id;

        $data['user'] = $user;

        $data['title'] = 'User Edit';

        if (empty($data['user'])) {
            return back();
        }
        // $data['users'] = $this->userRepository->getFacilitiesByType($data['facility']->facility_type,$facilityId);
        return view('admin.users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $userId = $user->id;
        $userDetails = $request->except('_token', '_method');
        $this->userRepository->updateUser($userId, $userDetails);
        Session::flash('success','User Updated Successfully');
        return redirect()->Route('admin.users.edit',$userId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */

    public function check_user_id_used($user_id)
    {
                // dd(\Roundtable::where('created_by',Auth::user()->id)->get());
        // dd(DB::table('*')->where('created_by',Auth::user()->id)->get());
        $tables = DB::select('SHOW TABLES'); 
        $existed_tables = [];

        foreach($tables as $table) { 
            $table_n = 'Tables_in_'.env('DB_DATABASE','atestimc_touristbook');
            $tableName = $table->{$table_n};
            if ($tableName == 'media') {
                $data = DB::table($tableName)->where('custom_properties->created_by',$user_id)->count(); 
                if (isset($data) && $data > 0) {
                    $existed_tables[] = $tableName;
                }     
            }else{
                if (Schema::hasColumn($tableName,'created_by')){
                    $data = DB::table($tableName)->where('created_by',$user_id)->count();
                    if (isset($data) && $data > 0) {
                        if ($tableName != 'comments') {
                        $existed_tables[] = $tableName;
                        }
                    }
                }
                if (Schema::hasColumn($tableName,'user_id')){
                    $data = DB::table($tableName)->where('user_id',$user_id)->count();
                    if (isset($data) && $data > 0) {
                        if ($tableName != 'comments') {
                        $existed_tables[] = $tableName;
                        }
                    }
                }
            } 
        } 

        return $existed_tables;

    }

    public function userAsgin(Request $request)
    {
           

        if ($request->has('tables') && $request->has('admin') && $request->has('user_id')) {
          if(isJson($request->get('tables'))){
           $tables = json_decode($request->get('tables'),true);
          }else{
           $tables = $request->get('tables');
          }
           foreach ($tables as $table) {
            if ($table != 'media') {
                if ($table != 'comments') {     
           if (Schema::hasColumn($table,'created_by')) {
            DB::table($table)->where('created_by',$request->get('user_id'))->update(['created_by'=>$request->get('admin')]);
           }else if(Schema::hasColumn($table,'user_id')){
             DB::table($table)->where('user_id',$request->get('user_id'))->update(['user_id'=>$request->get('admin')]);
           }
                }
            }else{
              DB::table($table)->where('custom_properties->created_by',$request->get('user_id'))->update(['custom_properties'=>json_encode(['created_by'=>$request->get('admin')])]);
           }
           }
        if ($request->has('user_delete') && $request->get('user_delete') == 'true') {
            $this->userRepository->deleteUser($request->get('user_id'));
        Session::flash('success','User Asgined And Deleted Successfully');
        return redirect()->Route('admin.users.index');
        }
        Session::flash('success','User Asgined Data Successfully');
        return redirect()->Route('admin.users.index');
        }
       Session::flash('error','User Not Asgined!');
       return redirect()->Route('admin.users.index');
    }

    public function userAsginShow($id)
    {
        $user = User::find($id);
        $check_user_id_used = $this->check_user_id_used($id);
        if (count($check_user_id_used)) {
           return $this->showAsginedUserTables($id,$check_user_id_used,true);
        }else{
            Session::flash('error','No Data Record By This User ('.$user->email.')');
            return back();
        }
        return back();
    }

    public function showAsginedUserTables($userId,$check_user_id_used,$asign_only=false)
    {
            $data['title'] = "User Asgined List";
            $data['check_user_id_used'] = $check_user_id_used;
            $data['asign_only'] = $asign_only;
            $data['user_id'] = $userId;
            $data['users'] = User::whereIn('role',['admin','editor'])->whereNot('id',$userId)->get(['id','name','email','role']);
           return view('admin.users.userAsgin',$data);
    }
    public function destroy(User $user)
    {
        $userId = $user->id;
        $check_user_id_used = $this->check_user_id_used($userId);
        if (count($check_user_id_used)) {
           return $this->showAsginedUserTables($userId,$check_user_id_used);
        }
    //dd('hrer');
        //$this->userRepository->deleteUser($userId);
        Session::flash('success','User Deleted Successfully');
        return back();
    }

    /**
     * Remove the specified all resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function bulk_delete(Request $request)
    {
       if (!empty($request->ids)) {

        $userIds = get_array_mapping(json_decode($request->ids));
        $this->userRepository->deleteBulkUser($userIds);
        Session::flash('success','User Bulk Deleted Successfully');
    }
    return back();
}

public function wishlist_add(Request $request)
{

    if (Auth::check()) {

        $user_id = Auth::id();
        $user = User::find($user_id);
        $NamespacedModel = 'App\\Models\\' . $request->model_type;
        $model_data = $NamespacedModel::findOrFail($request->model_id);
        if ($request->status == 0) {
           $user->wish($model_data, $request->model_type);
       }else{
           $user->unwish($model_data,$request->model_type);
       }
       if (wishlist_model($request->model_type,$request->model_id)) {

        return response()->json([
            'auth' => true,
            'wishlist' => true
        ]);
    }else{
       return response()->json([
        'auth' => true,
        'wishlist' => false
    ]);
   }
}else{
   return response()->json([
    'auth' => false,
]);
}

}

public function wishlist_remove(Request $request)
{
    if (Auth::check()) {

        $user_id = Auth::id();
        $user = User::find($user_id);
        $NamespacedModel = 'App\\Models\\' . $request->model_type;
        $model_data = $NamespacedModel::findOrFail($request->model_id);
        if ($request->status == 1) {
           $user->unwish($model_data,$request->model_type);
       }
       if (!wishlist_model($request->model_type,$request->model_id)) {

        return response()->json([
            'auth' => true,
            'wishlist_remove' => true
        ]);
    }
}else{
   return response()->json([
    'auth' => false,
]);
}
}

}
