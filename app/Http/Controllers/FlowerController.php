<?php

namespace App\Http\Controllers;

use App\Models\Flower;
use App\Models\Region;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;

class FlowerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flowers = Flower::latest()->paginate(8);
        return view('flowers.index', compact('flowers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('flowers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'regions' => 'required|array'
        ]);
    
        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/img');
            $image->move($destinationPath, $name);
        }
    
        $flower = new Flower([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'image_url' => $name
        ]);
        $flower->save();
    
        // Lưu danh sách khu vực phân bố
        $regions = $request->get('regions');
        $regionIds = [];
    
        foreach ($regions as $regionName) {
            $region = new Region([
                'region_name' => $regionName,
                'flower_id' => $flower->id
            ]);
            $region->save();
            $regionIds[] = $region->id;
        }
        // Ngắt mối quan hệ đối với các khu vực không còn thuộc về hoa này
        Region::where('flower_id', $flower->id)
            ->whereNotIn('id', $regionIds)
            ->delete();
        Toastr::success('Thêm mới loài hoa thành công!', 'Success');
        return redirect()->route('flowers.index');
    }
    /**
     * Display the specified resource.
     */
    public function show(Flower $flower)
    {
        $flower = Flower::findOrFail($flower->id);
        $regions = $flower->regions;
        return view('flowers.show', compact('flower', 'regions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Flower $flower)
    {
        return view('flowers.edit', compact('flower'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Flower $flower)
    {
        
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flower $flower)
    {
        $flower->delete();
        Toastr::success('Xóa loài hoa thành công!', 'Success');
        return redirect()->route('flowers.index');

    }
}
