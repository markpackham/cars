<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
// use App\Models\Product;
use App\Rules\Uppercase;
use App\Http\Requests\CreateValidationRequest;

class CarsController extends Controller
{

    // Redirect anyone who visits the root to the cars homepage
    public function homeRedirect()
    {
        return redirect('/cars');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // simular to SELECT * FROM cars
        $cars = Car::all()->toJson();
        $cars = json_decode($cars);

        // print_r($cars->count());

        return view('cars.index', [
            'cars' => $cars
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateValidationRequest $request)
    {

        // Methods we can use on the request for images
        // show us the extention eg "jpg"
        // guessExtension()
        // eg "image/jpeg"
        // getMimeType()
        // getClientMimeType()
        // store()
        // asStore()
        // storePublicly()
        // move()
        // getClientOriginalName()
        // get filename without the . so just "jpg"
        // guessClientExtention()
        // get size of image in kilobytes
        // getSize()
        // getError()
        // isValid()

        $request->validated();

        // avoid duplicate image names uploaded
        $newImageName = time() . '-' . $request->name . '.' . $request->image->extension();

        $request->image->move(public_path('images'), $newImageName);

        // $request->validate([
        //     'name' => 'required|unique:cars',
        //     'name' => new Uppercase,
        //     'founded' => 'required|integer|min:0|max:2022',
        //     'description' => 'required',
        // ]);

        // ::make could be used instead of 
        // ::create however you'd need to use $car->save() at the end
        $car = Car::create([
            'name' => $request->input('name'),
            'founded' => $request->input('founded'),
            'description' => $request->input('description'),
            'image_path' => $newImageName,
        ]);

        return redirect('/cars');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = Car::find($id);

        // $products = Product::find($id);
        return view('cars.show')->with('car', $car);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car = Car::where('id', $id)->first();

        return view('cars.edit')->with('car', $car);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateValidationRequest $request, $id)
    {

        $request->validated();

        $car = Car::where('id', $id)->update([
            'name' => $request->input('name'),
            'founded' => $request->input('founded'),
            'description' => $request->input('description'),
            'image_path' => $request->input('image'),
        ]);

        return redirect('/cars');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect('/cars');
    }
}
