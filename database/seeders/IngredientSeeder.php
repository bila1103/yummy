<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class IngredientSeeder extends Seeder
{
  public function run(): void
  {
    // URL Detail: https://www.yummy.co.id/api/recipe/ingredient/{slug}?page=1&limit=1

    $filePath = resource_path('json/ingredients.json');
    $ingredients = json_decode(file_get_contents($filePath), true)['data']['ingredient_list'];

    $cdnUrl = 'https://cdn.yummy.co.id/';

    foreach ($ingredients as $ingredient) {

      $URL = null;

      // Check if the image URL is not empty
      if (!empty($ingredient['image_url'])) {
        // Get the image URL from the CDN
        $imageURLWithoutQuery = explode('?', $ingredient['image_url'])[0];
        $imageURL = $cdnUrl . $imageURLWithoutQuery;

        // Use Laravel HTTP client to download the image
        try {
          $response = Http::get($imageURL);
          if ($response->successful()) {
            $imageContents = $response->body();
            $imageName = Uuid::uuid4()->toString();

            // Get Image extension from the URL
            $imageExtension = pathinfo($imageURL, PATHINFO_EXTENSION);
            if (empty($imageExtension)) {
              $contentType = $response->header('Content-Type');
              switch ($contentType) {
                case 'image/jpeg':
                case 'image/jpg':
                  $imageExtension = 'jpg';
                  break;
                case 'image/png':
                  $imageExtension = 'png';
                  break;
                case 'image/gif':
                  $imageExtension = 'gif';
                  break;
                case 'image/webp':
                  $imageExtension = 'webp';
                  break;
                case 'image/bmp':
                  $imageExtension = 'bmp';
                  break;
                case 'image/svg+xml':
                  $imageExtension = 'svg';
                  break;
                case 'image/x-icon':
                case 'image/vnd.microsoft.icon':
                  $imageExtension = 'ico';
                  break;
                case 'image/tiff':
                  $imageExtension = 'tiff';
                  break;
                default:
                  $imageExtension = 'jpg'; // fallback default
              }
            }

            $storagePath = "img/ingredients/{$imageName}.{$imageExtension}";

            // Save the image to the public directory
            Storage::disk('public')->put($storagePath, $imageContents);
            // Store the public URL of the image
            $URL = Storage::url($storagePath);
          } else {
            $URL = null; // Set to null if the image download fails
          }
        } catch (\Exception $e) {
          // Handle the exception (e.g., log the error)
          $URL = null; // Set to null if an exception occurs
        }
      }

      Ingredient::create([
        'name'      => $ingredient['name'],
        'slug'      => $ingredient['slug'],
        'image_url' => $URL
      ]);
    }
  }
}
