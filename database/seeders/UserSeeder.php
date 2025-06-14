<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class UserSeeder extends Seeder
{
  public function run(): void
  {
    $folder_path = resource_path('json/recipes');
    $files = scandir($folder_path);
    $files = array_diff($files, ['.', '..']);

    $password = bcrypt('12345678');
    $users = collect();

    $cdnUrl = 'https://cdn.yummy.co.id/';

    $json = file_get_contents(resource_path('json/recipes.json'));
    $data = json_decode($json, true);

    foreach ($data['data']['recipes'] as $recipe) {
      if (isset($recipe['author']) && isset($recipe['author']['username'])) {
        $users->push([
          'name'      => $recipe['author']['name'],
          'username'  => $recipe['author']['username'],
          'password'  => $password,
          'avatar'    => $recipe['author']['avatar'],
          'created_at' => now(),
          'updated_at' => now(),
        ]);
      }
    }

    $users = $users->unique('username')->map(function ($user) use ($cdnUrl) {
      $URL = null;

      if (isset($user['avatar'])) {
        // Get the image URL from the CDN
        $imageURLWithoutQuery = explode('?', $user['avatar'])[0];
        $imageURL = $cdnUrl . $imageURLWithoutQuery;

        // Use Laravel HTTP client to download the image
        try {
          $response = Http::get($imageURL);
          if ($response->successful()) {
            $imageContents = $response->body();
            $imageName = Uuid::uuid4()->toString();

            // Get Image extension from the URL
            $imageExtension = pathinfo($imageURL, PATHINFO_EXTENSION);
            $storagePath = "img/avatars/{$imageName}.{$imageExtension}";

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

      return [
        'name'      => $user['name'],
        'username'  => $user['username'],
        'password'  => bcrypt($user['password']),
        'avatar'    => $URL ?? null,
        'created_at' => now(),
        'updated_at' => now(),
      ];
    });

    User::insert($users->toArray());
  }
}
