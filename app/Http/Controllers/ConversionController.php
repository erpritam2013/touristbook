<?php

namespace App\Http\Controllers;

use App\DataTables\ConversionDataTable;
use App\Http\Requests\StoreConversionRequest;
use App\Http\Requests\UpdateConversionRequest;
use App\Interfaces\ConversionRepositoryInterface;
use App\Models\Conversion;
use App\Models\Terms\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ConversionController extends Controller
{
    private ConversionRepositoryInterface $conversionRepository;

    public function __construct(ConversionRepositoryInterface $conversionRepository)
    {
        $this->conversionRepository = $conversionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ConversionDataTable $dataTable)
    {
        $data['title'] = 'Conversion List';

        return $dataTable->render('admin.conversions.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add new conversion';
        $data['currencyList'] = config('currency');
        $data['countryCodes'] = Country::all();
        return view('admin.conversions.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreConversionRequest $request)
    {
        $conversionDetails = $request->except('_token');
        $this->conversionRepository->createConversion($conversionDetails);
        Session::flash('success', 'Conversion Added Successfully');
        return redirect()->Route('admin.conversions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Conversion  $conversion
     * @return \Illuminate\Http\Response
     */
    public function show(Conversion $conversion)
    {
        $data['conversion'] = $conversion;
        $data['title'] = 'Conversion';

        if (empty($data['conversion'])) {
            return back();
        }

        return view('admin.conversions.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Conversion $conversion)
    {
        $conversionId = $conversion->id;

        $data['conversion'] = $conversion;

        $data['title'] = 'Edit Conversion';
        $data['currencyList'] = config('currency');
        $data['countryCodes'] = Country::all();

        if (empty($data['conversion'])) {
            return back();
        }
        return view('admin.conversions.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateConversionRequest $request, Conversion $conversion)
    {
        $conversionId = $conversion->id;
        $conversionDetails = $request->except('_token', '_method');
        $this->conversionRepository->updateConversion($conversionId, $conversionDetails);
        Session::flash('success', 'Conversion Updated Successfully');
        return redirect()->Route('admin.conversions.edit', $conversionId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Conversion  $conversion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conversion $conversion)
    {
        $conversionId = $conversion->id;
        $this->conversionRepository->deleteConversion($conversionId);
        Session::flash('success', 'Conversion Deleted Successfully');
        return back();
    }

    /**
     * Remove the specified all resource from storage.
     *
     * @param  \App\Models\Conversion  $conversion
     * @return \Illuminate\Http\Response
     */
    public function bulk_delete(Request $request)
    {
        if (!empty($request->ids)) {

            $conversionIds = get_array_mapping(json_decode($request->ids));
            $this->conversionRepository->deleteBulkConversions($conversionIds);
            Session::flash('success', 'Conversions Bulk Deleted Successfully');
        }
        return back();
    }


    public function changeStatus() {
        // TODO
    }

}
