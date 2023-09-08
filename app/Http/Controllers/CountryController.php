<?php

namespace App\Http\Controllers;
use App\Interfaces\CountryRepositoryInterface;
use App\Models\Terms\Country;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use Illuminate\Http\Request;
use App\DataTables\CountryDataTable;
class CountryController extends Controller
{

     private CountryRepositoryInterface $countryRepository;

    public function __construct(CountryRepositoryInterface $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CountryDataTable $dataTable)
    {
        // $data['countries'] = $this->countryRepository->getAllCountries();
        $data['countries'] = Country::count();
        $data['title'] = 'Country List';

        return $dataTable->render('admin.terms.countries.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add Country';
        //$data['countries'] = $this->countryRepository->getCountriesByType();
        return view('admin.terms.countries.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCountryRequest $request)
    {
        $countryDetails = [
            'countrycode' => $request->countrycode,
            'countryname' => $request->countryname,
            'code' => $request->code,
        ];
        $this->countryRepository->createCountry($countryDetails);
        Session::flash('success','Country Created Successfully');
        return redirect()->Route('admin.terms.countries.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
         $data['country'] = $country;
        $data['title'] = 'Country';

        if (empty($data['country'])) {
            return back();
        }

        return view('admin.terms.amenities.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        $countryId = $country->id;

        $data['country'] = $country;

        $data['title'] = 'Country Edit';

        if (empty($data['country'])) {
            return back();
        }
        return view('admin.terms.countries.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCountryRequest $request, Country $country)
    {

        $countryId = $country->id;
        $countryDetails = [
            'countrycode' => $request->countrycode,
            'countryname' => $request->countryname,
            'code' => $request->code,
        ];
        $this->countryRepository->updateCountry($countryId,$countryDetails);
        Session::flash('success','Country Created Successfully');
        return redirect()->Route('admin.terms.countries.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
         $countryId = $country->id;
        $this->countryRepository->deleteCountry($countryId);
         Session::flash('success','Country Deleted Successfully');
        return back();
    }

    public function bulk_delete(Request $request)
    {
         if (!empty($request->ids)) {
        
        $countryIds = get_array_mapping(json_decode($request->ids));
        $this->countryRepository->deleteBulkCountry($countryIds);
         Session::flash('success','Country Bulk Deleted Successfully');
        }
        return back();
    }
}
