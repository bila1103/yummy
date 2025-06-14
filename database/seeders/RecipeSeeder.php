<?php

namespace Database\Seeders;

use App\Models\FoodTag;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class RecipeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function fetchImageAndSave($imageURL, $path)
  {
    $cdnUrl = 'https://cdn.yummy.co.id/';
    $imageURLWithoutQuery = explode('?', $imageURL)[0];
    $imageURL = $cdnUrl . $imageURLWithoutQuery;

    // Use Laravel HTTP client to download the image
    try {
      $response = Http::get($imageURL);
      if ($response->successful()) {
        $imageContents = $response->body();
        $imageName = Uuid::uuid4()->toString();

        // Get Image extension from the URL
        $imageExtension = pathinfo($imageURL, PATHINFO_EXTENSION);

        // Save the image to local storage
        Storage::disk('public')->put($path . '/' . $imageName . '.' . $imageExtension, $imageContents);

        return Storage::url($path . '/' . $imageName . '.' . $imageExtension);
      }
    } catch (\Exception $e) {
      // Handle the exception
      return null;
    }

    return null;
  }

  public function run(): void
  {
    $folderPath = resource_path('json/recipes');
    $files = glob($folderPath . '/*.json');

    $recipes = collect();

    foreach ($files as $file) {
      $json = file_get_contents($file);
      $data = json_decode($json, true)['data'];

      // Get category id from slug
      $categoryId = empty($data['category']['slug'])
        ? null
        : FoodTag::where('slug', $data['category']['slug'])->first()->id;

      // Get User id from username

      // Check if the username exists in the author field
      // If it doesn't exist, set userId to null

      $userId = empty($data['author']['username'])
        ? null
        : User::where('username', $data['author']['username'])->first()->id ?? 1;

      // Get Image and save to local storage
      $imageURL = null;
      if (!empty($data['cover_url'])) {
        $imageURL = $this->fetchImageAndSave($data['cover_url'], 'recipes');
      }

      // Get All Image of Cooking Steps
      $cookingSteps = [];

      if (!empty($data['cooking_step'])) {
        foreach ($data['cooking_step'] as $step) {
          $cookingSteps[] = [
            'title'     => $step['title'],
            'text'      => $step['text'],
            'image_url' => $this->fetchImageAndSave($step['original_image'], 'cooking_steps'),
            'order'     => $step['order'],
          ];
        }
      }

      Recipe::create([
        'title'             => $data['title'],
        'slug'              => $data['slug'],
        'image'             => $imageURL,
        'description'       => empty($data['description']) ? null : $data['description'],
        'rating'            => $data['rating'] ?? 0,
        'video_url'         => null,
        'price'             => $data['price'] ?? 0,
        'price_premium'     => $data['price_premium'] ?? 0,
        'calories'          => empty($data['calories']) ? null : $data['calories'],
        'is_cvc'            => $data['is_cvc'],
        'cooking_time'      => $data['cooking_time'] ?? 0,
        'serving_min'       => $data['serving_min'] ?? 0,
        'serving_max'       => $data['serving_max'] ?? 0,

        // convert int to timestamp
        'release_date'      => date('Y-m-d H:i:s', $data['release_date']),
        'updated_date'      => date('Y-m-d H:i:s', $data['updated_date']),

        'is_bookmark'       => $data['is_bookmark'],
        'is_editorial'      => $data['is_editorial'],
        'rating_user'       => $data['rating_user'] ?? 0,
        'is_video'          => false,
        'premium_content'   => $data['premium_content'],
        'brand_slug'        => empty($data['brand_slug']) ? null : $data['brand_slug'],
        'meta_title'        => empty($data['meta_title']) ? null : $data['meta_title'],
        'meta_description'  => empty($data['meta_description']) ? null : $data['meta_description'],
        'og_caption'        => empty($data['og_caption']) ? null : $data['og_caption'],
        'og_title'          => empty($data['og_title']) ? null : $data['og_title'],
        'og_description'    => empty($data['og_description']) ? null : $data['og_description'],
        'og_media'          => empty($data['og_media']) ? null : $data['og_media'],
        'cooking_step'      => json_encode($cookingSteps),
        'ingredient_type'   => json_encode($data['ingredient_type']),
        'category_id' => $categoryId,
        'user_id'     => $userId,
      ]);
    }
  }
}
