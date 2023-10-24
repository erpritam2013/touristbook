<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
    public function destroy(User $user)
    {
        $userId = $user->id;
        $this->userRepository->deleteUser($userId);
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
}
