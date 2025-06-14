<?php

namespace App\Http\Controllers;

use App\Models\FoodInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FoodInfoController extends Controller
{
  public function index()
  {
    $this->data['title'] = 'Food Information';
    $this->data['foodInfos'] = FoodInfo::paginate(20);
    return view('pages.dashboard.food-info.index', $this->data);
  }
  // Query untuk menampilkan data di tabel food_info SELECT * FROM food_infos LIMIT 20 OFFSET 0;
  public function create()
  {
    $this->data['title'] = 'Create Food Information';
    return view('pages.dashboard.food-info.create', $this->data);
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255',
      'description' => 'nullable|string',
    ]);

    $validated['slug'] = Str::slug($validated['name'], '-');

    FoodInfo::create($validated);
    return redirect()->route('dashboard.food-info.index')->with('success', 'Food information created successfully.');
  }
// Query untuk menambahkan data ke table food_info -> INSERT INTO food_infos (name, description, slug, created_at, updated_at)
// VALUES ('name', 'description', 'slug', NOW(), NOW());


  public function edit(FoodInfo $foodInfo)
  {
    $this->data['title'] = 'Edit Food Information';
    $this->data['foodInfo'] = $foodInfo;
    return view('pages.dashboard.food-info.edit', $this->data);
  }
// Query untuk menampilkan data pada tabel food_info sesuai dengan id yg dipilih 
// SELECT * FROM food_infos WHERE id = {id} LIMIT 1;
  public function update(Request $request, FoodInfo $foodInfo)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255',
      'description' => 'nullable|string',
    ]);

    $validated['slug'] = Str::slug($validated['name'], '-');

    $foodInfo->update($validated);
    return redirect()->route('dashboard.food-info.index')->with('success', 'Food information updated successfully.');
  }
  // Query untuk mengupdate data -> UPDATE food_infos SET name = 'Name', description = 'Description', slug = 'slug-baru', 
  // updated_at = NOW() WHERE id = {id};


  public function destroy(FoodInfo $foodInfo)
  {
    $foodInfo->delete();
    return redirect()->route('dashboard.food-info.index')->with('success', 'Food information deleted successfully.');
  }
  // Qery untuk menghapus data berdasarkan id -> DELETE FROM food_infos WHERE id = {id};

}
