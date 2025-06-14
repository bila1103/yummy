<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class IngredientController extends Controller
{
  public function index(Request $request)
  {
    $this->data['title'] = 'Food Ingredients';
    $this->data['ingredients'] = Ingredient::paginate(20);
    return view('pages.dashboard.food-ingredient.index', $this->data);
  }
  // Query untuk menamilkan data pada table ingredient
  // SELECT * FROM ingredients LIMIT 20 OFFSET 0;


  public function create()
  {
    $this->data['title'] = 'Create Food Ingredient';
    return view('pages.dashboard.food-ingredient.create', $this->data);
  }
  

  public function store(Request $request)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255',
      'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10248',
    ]);

    $validated['slug'] = Str::slug($validated['name'], '-');
    $validated['image_url'] = null;

    if ($request->hasFile('image')) {
      $image = $request->file('image');
      $imageName = Uuid::uuid4()->toString() . '.' . $image->getClientOriginalExtension();
      Storage::disk('public')->putFileAs('img/ingredients', $image, $imageName);
      $validated['image_url'] = Storage::url('img/ingredients/' . $imageName);
    }

    Ingredient::create($validated);
    return redirect()->route('dashboard.food-ingredient.index')->with('success', 'Ingredient created successfully.');
  }
// INSERT INTO ingredients (name, slug, image_url, created_at, updated_at)
// VALUES ('nama', 'slug-nama', 'url-gambar', NOW(), NOW());

  public function edit(Ingredient $ingredient)
  {
    $this->data['title'] = 'Edit Food Ingredient';
    $this->data['ingredient'] = $ingredient;
    return view('pages.dashboard.food-ingredient.edit', $this->data);
  }
  // SELECT * FROM ingredients WHERE id = ? LIMIT 1;


  public function update(Request $request, Ingredient $ingredient)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255',
      'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10248',
    ]);

    $validated['slug'] = Str::slug($validated['name'], '-');

    if ($request->hasFile('image')) {
      if ($ingredient->image_url) {
        Storage::disk('public')->delete(str_replace('/storage/', '', $ingredient->image_url));
      }
      $image = $request->file('image');
      $imageName = Uuid::uuid4()->toString() . '.' . $image->getClientOriginalExtension();
      Storage::disk('public')->putFileAs('img/ingredients', $image, $imageName);
      $validated['image_url'] = Storage::url('img/ingredients/' . $imageName);
    } else {
      $validated['image_url'] = $ingredient->image_url;
    }

    $ingredient->update($validated);
    return redirect()->route('dashboard.food-ingredient.index')->with('success', 'Ingredient updated successfully.');
  }
  // UPDATE ingredients SET name = 'name', slug = 'slug', image_url = 'url-gambar', updated_at = NOW() WHERE id = ?;


  public function destroy(Ingredient $ingredient)
  {
    if ($ingredient->image_url) {
      Storage::disk('public')->delete(str_replace('/storage/', '', $ingredient->image_url));
    }
    $ingredient->delete();
    return redirect()->route('dashboard.food-ingredient.index')->with('success', 'Ingredient deleted successfully.');
  }
  //DELETE FROM ingredients WHERE id = ?;

}
