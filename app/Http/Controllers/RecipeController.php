<?php

namespace App\Http\Controllers;

use App\Models\FoodInfo;
use App\Models\FoodTag;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\RecipeTags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;

class RecipeController extends Controller
{
  public function index()
  {
    $this->data['title'] = 'Recipe List';
    $this->data['recipes'] = Recipe::with('user')
      ->where('user_id', auth()->id())
      ->orderBy('created_at', 'desc')->paginate(20);
    return view('pages.dashboard.recipe.index', $this->data);
  }
  // Query untuk mrengambil data dari tabel recipe
  // SELECT * FROM recipes WHERE user_id = ? ORDER BY created_at DESC LIMIT 20 OFFSET 0;

  public function create()
  {
    $this->data['title'] = 'Create Recipe';
    $this->data['food_tags'] = FoodTag::all();
    $this->data['food_infos'] = FoodInfo::all();
    $this->data['ingredients'] = Ingredient::where('image_url', '!=', null)
      ->orderBy('name')
      ->get();
    return view('pages.dashboard.recipe.create', $this->data);
  }
  // Query untuk menampilkan data unruk form resep
  // SELECT * FROM food_tags;
  // SELECT * FROM food_infos;
  // SELECT * FROM ingredients WHERE image_url IS NOT NULL ORDER BY name ASC;


  public function store(Request $request)
  {
    $validated = $request->validate([
      'title' => 'required|string',
      'description' => 'required|string',
      'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10248',
      'food_tags' => 'required|array',
      'food_infos' => 'required|array',
      'ingredients' => 'required|array',
      'price' => 'required',
      'calories' => 'nullable',
      'cooking_time' => 'required',
      'serving_min' => 'required',
      'serving_max' => 'required',
      'cooking_steps' => 'required|array',
      'ingredient_types' => 'required|array',
    ]);

    $validated['slug'] = Str::slug($validated['title'], '-');

    $validated['user_id'] = auth()->id();

    if ($request->hasFile('image')) {
      $image = $request->file('image');
      $imageName = Uuid::uuid4()->toString() . '.' . $image->getClientOriginalExtension();
      Storage::disk('public')->putFileAs('recipes', $image, $imageName);
      $validated['image'] = '/storage/recipes/' . $imageName;
    } else {
      $validated['image'] = null;
    }

    // insert cooking steps image

    foreach ($validated['cooking_steps'] as $key => $step) {
      if (isset($step['image']) && $step['image'] instanceof \Illuminate\Http\UploadedFile) {
        $image = $step['image'];
        $imageName = Uuid::uuid4()->toString() . '.' . $image->getClientOriginalExtension();
        Storage::disk('public')->putFileAs('cooking_steps', $image, $imageName);
        $validated['cooking_steps'][$key]['image_url'] = '/storage/cooking_steps/' . $imageName;
      } else {
        $validated['cooking_steps'][$key]['image_url'] = null;
      }
    }

    $validated['cooking_step'] = json_encode($validated['cooking_steps']);
    $validated['ingredient_type'] = json_encode($validated['ingredient_types']);
    $recipe = Recipe::create($validated);

    // insert recipe tags
    if ($request->has('food_tags')) {
      $tags = [];
      foreach ($request->input('food_tags') as $tagId) {
        $tags[] = [
          'recipe_id' => $recipe->id,
          'food_tag_id' => $tagId,
        ];
      }
      $recipe->foodTags()->attach($tags);
    }

    // insert recipe ingredients
    if ($request->has('ingredients')) {
      $ingredients = [];
      foreach ($request->input('ingredients') as $ingredientInput) {
        if (is_numeric($ingredientInput)) {
          $ingredientId = $ingredientInput;
        } else {
          // Jika bukan ID, buat ingredient baru (hindari duplikat)
          $existingIngredient = Ingredient::where('name', $ingredientInput)->first();

          if ($existingIngredient) {
            $ingredientId = $existingIngredient->id;
          } else {
            $newIngredient = Ingredient::create([
              'name' => $ingredientInput,
              'slug' => Str::slug($ingredientInput, '-'),
            ]);
            $ingredientId = $newIngredient->id;
          }
        }

        $ingredients[] = [
          'recipe_id' => $recipe->id,
          'ingredient_id' => $ingredientId,
        ];
      }
      $recipe->ingredients()->attach($ingredients);
    }

    // insert recipe food infos
    if ($request->has('food_infos')) {
      $foodInfos = [];
      foreach ($request->input('food_infos') as $foodInfoId) {
        $foodInfos[] = [
          'recipe_id' => $recipe->id,
          'food_info_id' => $foodInfoId,
        ];
      }
      $recipe->foodInfos()->attach($foodInfos);
    }

    return redirect()->route('dashboard.recipe.index')->with('success', 'Recipe created successfully.');
  }
  // Query untuk menyimpan data utama resep 
// INSERT INTO recipes (title, slug, user_id, ..., cooking_step, ingredient_type, ...)
// VALUES ('title', 'slug...', user_id, ..., 'json_step', 'json_type', ...);
// Query untuk isert tags(many-to-many)
// INSERT INTO food_tag_recipe (recipe_id, food_tag_id)
// VALUES (?, ?), (?, ?), ...;
// Query untuk mengecek apakah ingridient udah ada
// SELECT * FROM ingredients WHERE name = '...' LIMIT 1;
// Query untuk memasukkan data ke table ingridient
// INSERT INTO ingredients (name, slug) VALUES ('...', '...');
// INSERT INTO ingredient_recipe (recipe_id, ingredient_id)
// VALUES (?, ?), (?, ?), ...;
// Query untuk memasukkan data ke tabel food_infos ( many-to-many)
// INSERT INTO food_info_recipe (recipe_id, food_info_id)
// VALUES (?, ?), (?, ?), ...;

  public function show($id)
  {
    $this->data['title'] = 'Recipe Detail';
    $this->data['recipe'] = Recipe::with(['foodTags', 'ingredients', 'foodInfos'])->findOrFail($id);
    if ($this->data['recipe']->user_id !== auth()->id()) {
      return redirect()->route('dashboard.recipe.index')->with('error', 
      'You do not have permission to view this recipe.');
    }
    return view('pages.dashboard.recipe.show', $this->data);
  }


  public function edit($id)
  {
    $this->data['title'] = 'Edit Recipe';
    $this->data['recipe'] = Recipe::with(['foodTags', 'ingredients', 'foodInfos'])->findOrFail($id);

    if ($this->data['recipe']->user_id !== auth()->id()) {
      return redirect()->route('dashboard.recipe.index')
        ->with('error', 'You do not have permission to edit this recipe.');
    }

    $this->data['food_tags'] = FoodTag::all();
    $this->data['food_infos'] = FoodInfo::all();

    $usedIngredientIds = $this->data['recipe']->ingredients->pluck('id')->toArray();

    $this->data['ingredients'] = Ingredient::where(function ($query) use ($usedIngredientIds) {
      $query->whereNotNull('image_url')
        ->orWhereIn('id', $usedIngredientIds);
    })
      ->orderBy('name')
      ->get();

    return view('pages.dashboard.recipe.edit', $this->data);
  }

  public function update(Request $request, $id)
  {
    // check if the recipe belongs to the authenticated user
    $recipe = Recipe::findOrFail($id);
    if ($recipe->user_id !== auth()->id()) {
      return redirect()->route('dashboard.recipe.index')->with('error',
       'You do not have permission to edit this recipe.');
    }
    $validated = $request->validate([
      'title' => 'required|string',
      'description' => 'required|string',
      'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10248',
      'food_tags' => 'nullable|array',
      'food_infos' => 'nullable|array',
      'ingredients' => 'nullable|array',
      'price' => 'required',
      'calories' => 'nullable',
      'cooking_time' => 'required',
      'serving_min' => 'required',
      'serving_max' => 'required',
      'cooking_steps' => 'required|array',
      'ingredient_types' => 'required|array',
      'release_date' => now(),
    ]);

    $validated['slug'] = Str::slug($validated['title'], '-');

    // Handle main image
    if ($request->hasFile('image')) {
      if ($recipe->image) {
        Storage::disk('public')->delete(str_replace('/storage/', '', $recipe->image));
      }
      $image = $request->file('image');
      $imageName = Uuid::uuid4()->toString() . '.' . $image->getClientOriginalExtension();
      Storage::disk('public')->putFileAs('recipes', $image, $imageName);
      $validated['image'] = '/storage/recipes/' . $imageName;
    } else {
      $validated['image'] = $recipe->image;
    }

    // Handle cooking steps images
    foreach ($validated['cooking_steps'] as $key => $step) {
      // Case 1: New image is uploaded
      if (isset($step['image']) && $step['image'] instanceof \Illuminate\Http\UploadedFile) {
        // Delete the old image if exists
        if (isset($step['existing_image_url']) && !empty($step['existing_image_url'])) {
          Storage::disk('public')->delete(str_replace('/storage/', '', $step['existing_image_url']));
        }

        // Upload new image
        $image = $step['image'];
        $imageName = Uuid::uuid4()->toString() . '.' . $image->getClientOriginalExtension();
        Storage::disk('public')->putFileAs('cooking_steps', $image, $imageName);
        $validated['cooking_steps'][$key]['image_url'] = '/storage/cooking_steps/' . $imageName;
      }
      // Case 2: No new image but existing image should be preserved
      elseif (isset($step['existing_image_url']) && !empty($step['existing_image_url'])) {
        $validated['cooking_steps'][$key]['image_url'] = $step['existing_image_url'];
      }
      // Case 3: No image at all (neither new nor existing)
      else {
        $validated['cooking_steps'][$key]['image_url'] = null;
      }

      // Remove temporary fields
      if (isset($validated['cooking_steps'][$key]['image'])) {
        unset($validated['cooking_steps'][$key]['image']);
      }
      if (isset($validated['cooking_steps'][$key]['existing_image_url'])) {
        unset($validated['cooking_steps'][$key]['existing_image_url']);
      }
    }

    // Encode JSON fields
    $validated['cooking_step'] = json_encode($validated['cooking_steps']);
    $validated['ingredient_type'] = json_encode($validated['ingredient_types']);

    // Update recipe
    $recipe->update($validated);

    // Sync relationships
    if ($request->has('food_tags')) {
      $recipe->foodTags()->sync($request->input('food_tags'));
    } else {
      $recipe->foodTags()->detach();
    }

    if ($request->has('ingredients')) {
      $ingredientIds = [];

      foreach ($request->input('ingredients') as $input) {
        if (is_numeric($input)) {
          $ingredientIds[] = $input;
        } else {
          $existing = Ingredient::where('name', $input)->first();

          if ($existing) {
            $ingredientIds[] = $existing->id;
          } else {
            $new = Ingredient::create(['name' => $input, 'slug' => Str::slug($input, '-')]);
            $ingredientIds[] = $new->id;
          }
        }
      }

      $recipe->ingredients()->sync($ingredientIds);
    } else {
      $recipe->ingredients()->detach();
    }

    if ($request->has('food_infos')) {
      $recipe->foodInfos()->sync($request->input('food_infos'));
    } else {
      $recipe->foodInfos()->detach();
    }

    return redirect()->route('dashboard.recipe.index')->with('success', 'Recipe updated successfully.');
  }
  // Query yg digunakan untuk menampilkan data yg akan diedit
  // SELECT * FROM recipes WHERE id = ? LIMIT 1;
  // Query untuk mengupdate data
  // UPDATE recipes SET image = '/storage/recipes/uuid.jpg' WHERE id = ?;
  // UPDATE recipes SET cooking_step = '[{...}]', ingredient_type = '[...]' WHERE id = ?;
  // UPDATE recipes SET title = ?, description = ?, ... WHERE id = ?;
  // DELETE FROM food_tag_recipe WHERE recipe_id = ?;
  // INSERT INTO food_tag_recipe (recipe_id, food_tag_id) VALUES (?, ?);
  // SELECT * FROM ingredients WHERE name = ? LIMIT 1;
  // INSERT INTO ingredients (name, slug) VALUES (?, ?);
  // DELETE FROM ingredient_recipe WHERE recipe_id = ?;
  // INSERT INTO ingredient_recipe (recipe_id, ingredient_id) VALUES (?, ?);
  // DELETE FROM food_info_recipe WHERE recipe_id = ?;
  // INSERT INTO food_info_recipe (recipe_id, food_info_id) VALUES (?, ?);


  public function destroy($id)
  {
    $recipe = Recipe::findOrFail($id);
    if ($recipe->user_id !== auth()->id()) {
      return redirect()->route('dashboard.recipe.index')->with(
        'error',
        'You do not have permission to delete this recipe.'
      );
    }
    if ($recipe->image) {
      Storage::disk('public')->delete(str_replace('/storage/', '', $recipe->image));
    }
    $cookingSteps = is_array($recipe->cooking_step) ? $recipe->cooking_step : json_decode(
      $recipe->cooking_step,
      true
    );
    foreach ($cookingSteps as $step) {
      if (isset($step['image_url'])) {
        Storage::disk('public')->delete(str_replace('/storage/', '', $step['image_url']));
      }
    }
    $recipe->foodTags()->detach();
    $recipe->ingredients()->detach();
    $recipe->foodInfos()->detach();

    $recipe->delete();
    return redirect()->route('dashboard.recipe.index')->with('success', 'Recipe deleted successfully.');
  }
  // Query untuk mengambil data -> SELECT * FROM recipes WHERE id = 'id' LIMIT 1;
  // Query untuk menghapus data
  // DELETE FROM food_tag_recipe WHERE recipe_id = ?; -> menghapus data dari table food_tag_recipe
  // DELETE FROM ingredient_recipe WHERE recipe_id = ?; -> menghapus data dari table ingredient_recipe
  // DELETE FROM food_info_recipe WHERE recipe_id = ?; -> menghapus data dari table food_info_recipe

}
