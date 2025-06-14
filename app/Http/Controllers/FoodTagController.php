<?php

namespace App\Http\Controllers;

use App\Models\FoodTag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FoodTagController extends Controller
{
  public function index()
  {
    $this->data['title'] = 'Food Tag';
    $this->data['foodTags'] = FoodTag::paginate(20);
    return view('pages.dashboard.food-tag.index', $this->data);
  }
  // Query untuk menamilkan data pada table_foode tag
  // SELECT * FROM food_tags LIMIT 20 OFFSET 0;


  public function create()
  {
    $this->data['title'] = 'Create Food Tag';
    return view('pages.dashboard.food-tag.create', $this->data);
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255',
      'description' => 'nullable|string',
    ]);

    $validated['slug'] = Str::slug($validated['name'], '-');

    FoodTag::create($validated);
    return redirect()->route('dashboard.food-tag.index')->with('success', 'Food tag created successfully.');
  }
  // Query untuk menyimpan data tag makanan baru 
  // INSERT INTO food_tags (name, description, slug, created_at, updated_at)
  // VALUES ('nama_tag', 'deskripsi_tag', 'nama-tag', NOW(), NOW());


  public function edit(FoodTag $foodTag)
  {
    $this->data['title'] = 'Edit Food Tag';
    $this->data['foodTag'] = $foodTag;
    return view('pages.dashboard.food-tag.edit', $this->data);
  }
  // Query untuk menampilkan data pada table food_tag berdasarkan id
  // SELECT * FROM food_tags WHERE id = ? LIMIT 1;


  public function update(Request $request, FoodTag $foodTag)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255',
      'description' => 'nullable|string',
    ]);

    $validated['slug'] = Str::slug($validated['name'], '-');

    $foodTag->update($validated);
    return redirect()->route('dashboard.food-tag.index')->with('success', 'Food tag updated successfully.');
  }
  // Query untuk menyuimpan perubahan pada table food_tag 
  // UPDATE food_tags SET name = 'nama_baru', description = 'deskripsi_baru', slug = 'slug-baru', updated_at = NOW() WHERE id = ?;
 

  public function destroy(FoodTag $foodTag)
  {
    $foodTag->delete();
    return redirect()->route('dashboard.food-tag.index')->with('success', 'Food tag deleted successfully.');
  }
  // Query untuk menghapus data pada table food_tag
  // DELETE FROM food_tags WHERE id = ?;
}
