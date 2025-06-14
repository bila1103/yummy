<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Recipe;
use App\Models\FoodTag;
use App\Models\FoodInfo;
use App\Models\Ingredient;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class WebController extends Controller
{
    public function index()
    {
        // Cache stories for 1 hour
        $this->data['stories'] = Cache::remember('home_stories', 3600, function () {
            return Recipe::with('user')
                ->select('id', 'user_id', 'title', 'slug', 'image', 'cooking_time', 'rating', 'serving_min', 'serving_max', 'price', 'created_at')
                ->inRandomOrder()
                ->take(10)
                ->get();
        });

        // Cache favorites for 1 hour
        $this->data['favorites'] = Cache::remember('home_favorites', 3600, function () {
            return Recipe::with('user')
                ->select('id', 'user_id', 'title', 'slug', 'image', 'cooking_time', 'rating', 'serving_min', 'serving_max', 'price', 'created_at')
                ->where('rating', '>', 4)
                ->inRandomOrder()
                ->take(10)
                ->get();
        });

        // Cache today menus for 1 hour
        $this->data['todayMenus'] = Cache::remember('home_today_menus', 3600, function () {
            $verified = Recipe::with('user')
                ->whereHas('user', function ($query) {
                    $query->where('is_verified', true);
                })
                ->select('id', 'user_id', 'title', 'slug', 'image', 'cooking_time', 'rating', 'serving_min', 'serving_max', 'price', 'created_at')
                ->latest('created_at')
                ->take(5)
                ->get();

            $unverified = Recipe::with('user')
                ->whereHas('user', function ($query) {
                    $query->where('is_verified', false);
                })
                ->select('id', 'user_id', 'title', 'slug', 'image', 'cooking_time', 'rating', 'serving_min', 'serving_max', 'price', 'created_at')
                ->latest('created_at')
                ->take(5)
                ->get();

            return $verified->merge($unverified)->shuffle();
        });

        // Cache ingredients for 1 hour
        $this->data['ingredients'] = Cache::remember('home_ingredients', 3600, function () {
            return Ingredient::select('id', 'name', 'slug', 'image_url')
                ->where('image_url', '!=', null)
                ->inRandomOrder()
                ->take(14)
                ->get();
        });

        // Cache premium recipes for 1 hour
        $this->data['premiumRecipes'] = Cache::remember('home_premium_recipes', 3600, function () {
            return Recipe::with('user')
                ->select('id', 'user_id', 'title', 'slug', 'image', 'cooking_time', 'rating', 'price', 'created_at')
                ->inRandomOrder()
                ->take(10)
                ->get();
        });

        // Cache official accounts for 1 hour
        $this->data['officialAccounts'] = Cache::remember('home_official_accounts', 3600, function () {
            return User::with([
                'recipes' => function ($query) {
                    $query->select('id', 'user_id', 'title', 'image')
                        ->latest()
                        ->take(3);
                }
            ])
                ->withCount('recipes')
                ->where('is_verified', true)
                ->has('recipes', '>', 3)
                ->inRandomOrder()
                ->take(10)
                ->get();
        });

        // Cache yummy recipes for 1 hour
        $this->data['yummyRecipes'] = Cache::remember('home_yummy_recipes', 3600, function () {
            return Recipe::with('user')
                ->select(
                    'id',
                    'user_id',
                    'title',
                    'slug',
                    'image',
                    'cooking_time',
                    'rating',
                    'serving_min',
                    'serving_max',
                    'price',
                    'created_at',
                    'cooking_step'
                )
                ->inRandomOrder()
                ->take(10)
                ->get()
                ->map(function ($recipe) {
                    $recipe->total_steps = is_array($recipe->cooking_step)
                        ? count($recipe->cooking_step)
                        : 0;
                    return $recipe;
                });
        });

        // Cache healthy dishes for 1 hour
        $this->data['healthyDishes'] = Cache::remember('home_healthy_dishes', 3600, function () {
            $tagIds = [15, 41];

            return Recipe::whereHas('foodTags', function ($query) use ($tagIds) {
                $query->whereIn('food_tags.id', $tagIds);
            })
                ->with(['user', 'foodTags'])
                ->select(
                    'recipes.id',
                    'recipes.user_id',
                    'recipes.title',
                    'recipes.slug',
                    'recipes.image',
                    'recipes.cooking_time',
                    'recipes.rating',
                    'recipes.serving_min',
                    'recipes.serving_max',
                    'recipes.price',
                    'recipes.visited_count',
                    'recipes.created_at'
                )
                ->inRandomOrder()
                ->take(10)
                ->get();
        });

        // Cache simple dishes for 1 hour
        $this->data['simpleDishes'] = Cache::remember('home_simple_dishes', 3600, function () {
            $tagIdSederhana = [92];

            return Recipe::where(function ($query) use ($tagIdSederhana) {
                $query->whereHas('foodTags', function ($subQuery) use ($tagIdSederhana) {
                    $subQuery->whereIn('food_tags.id', $tagIdSederhana);
                })
                    ->orWhere('title', 'like', '%simpel%');
            })
                ->with(['user', 'foodTags'])
                ->select(
                    'recipes.id',
                    'recipes.user_id',
                    'recipes.title',
                    'recipes.slug',
                    'recipes.image',
                    'recipes.cooking_time',
                    'recipes.rating',
                    'recipes.serving_min',
                    'recipes.serving_max',
                    'recipes.price',
                    'recipes.visited_count',
                    'recipes.created_at'
                )
                ->inRandomOrder()
                ->take(10)
                ->get();
        });

        $this->data['title'] = 'Yummy Recipes - Aplikasi Resep Makanan';
        return view('pages.web.home', $this->data);
    }

    public function detail($slug)
    {
        $this->data['favorites'] = Recipe::with('user')
            ->select('id', 'user_id', 'title', 'slug', 'image', 'cooking_time', 'rating', 'serving_min', 'serving_max', 'price', 'created_at')
            ->where('rating', '>', 4)
            ->inRandomOrder()
            ->take(10)
            ->get();

        $this->data['recipe'] = Recipe::with(['user', 'foodTags', 'ingredients', 'foodInfos'])
            ->select(
                'id',
                'user_id',
                'category_id',
                'title',
                'slug',
                'image',
                'cooking_time',
                'rating',
                'serving_min',
                'serving_max',
                'price',
                'visited_count',
                'calories',
                'cooking_step',
                'ingredient_type',
                'rating_user',
                'premium_content'
            )
            ->where('slug', $slug)
            ->firstOrFail();

        $this->data['recipe']->increment('visited_count');

        $this->data['recipe']->cooking_step = is_string($this->data['recipe']->cooking_step)
            ? json_decode($this->data['recipe']->cooking_step, true)
            : $this->data['recipe']->cooking_step;

        $this->data['recipe']->ingredient_type = is_string($this->data['recipe']->ingredient_type)
            ? json_decode($this->data['recipe']->ingredient_type, true)
            : $this->data['recipe']->ingredient_type;

        $this->data['recipe']->total_steps = is_array($this->data['recipe']->cooking_step)
            ? count($this->data['recipe']->cooking_step)
            : 0;

        $ingredientIds = $this->data['recipe']->ingredients->pluck('id')->toArray();

        $this->data['related_recipes'] = Recipe::with(['user', 'foodTags'])
            ->select('id', 'user_id', 'title', 'slug', 'image', 'cooking_time', 'rating', 'serving_min', 'serving_max', 'price', 'visited_count', 'calories', 'created_at')
            ->whereHas('ingredients', function ($query) use ($ingredientIds) {
                $query->whereIn('ingredient_id', $ingredientIds);
            })
            ->where('slug', '!=', $slug)
            ->distinct()
            ->take(10)
            ->get();

        $this->data['categories_recipes'] = Recipe::with(['user', 'foodTags'])
            ->select('id', 'user_id', 'title', 'slug', 'image', 'cooking_time', 'rating', 'serving_min', 'serving_max', 'price', 'visited_count', 'calories', 'created_at')
            ->where('category_id', $this->data['recipe']->category_id)
            ->where('slug', '!=', $slug)
            ->latest()
            ->take(10)
            ->get();
        $this->data['title'] = 'Detail Resep';
        return view('pages.web.detail', $this->data);
    }

    public function resep_populer()
    {
        $recipes = Recipe::with('user')
            ->select('id', 'user_id', 'title', 'slug', 'image', 'cooking_time', 'rating', 'serving_min', 'serving_max', 'price', 'visited_count', 'created_at')
            ->where('rating', '>', 4)
            ->where('visited_count', '>', 50)
            ->orderBy('visited_count', 'desc')
            ->paginate(12);

        $this->data['recipes'] = $recipes;
        $this->data['breadcrumbs'] = [
            'title' => 'Resep Populer',
            'description' => 'Temukan resep makanan terpopuler yang telah dinilai tinggi oleh pengguna kami. Dapatkan inspirasi masakan lezat dan mudah dibuat di rumah.',
            'sub' => 'resep'
        ];

        return view('pages.web.resep', $this->data);
    }

    public function resep_terbaru()
    {
        $recipes = Recipe::with('user')
            ->select('id', 'user_id', 'title', 'slug', 'image', 'cooking_time', 'rating', 'serving_min', 'serving_max', 'price', 'visited_count', 'created_at')
            ->latest()
            ->paginate(12);

        $this->data['recipes'] = $recipes;
        $this->data['breadcrumbs'] = [
            'title' => 'Resep Terbaru',
            'description' => 'Temukan resep makanan terbaru yang telah ditambahkan oleh pengguna kami. Dapatkan inspirasi masakan lezat dan mudah dibuat di rumah.',
            'sub' => 'resep'
        ];


        return view('pages.web.resep', $this->data);
    }

    public function resep_terfavorit()
    {
        $recipes = Recipe::with('user')
            ->select('id', 'user_id', 'title', 'slug', 'image', 'cooking_time', 'rating', 'serving_min', 'serving_max', 'price', 'visited_count', 'created_at')
            ->where('rating', '>', 4)
            ->inRandomOrder()
            ->paginate(12);

        $this->data['recipes'] = $recipes;
        $this->data['breadcrumbs'] = [
            'title' => 'Resep Terfavorit',
            'description' => 'Temukan resep makanan terfavorit yang telah dinilai tinggi oleh pengguna kami. Dapatkan inspirasi masakan lezat dan mudah dibuat di rumah.',
            'sub' => 'resep'
        ];

        return view('pages.web.resep', $this->data);
    }

    public function resep_teruji()
    {
        $recipes = Recipe::with('user')
            ->select('id', 'user_id', 'title', 'slug', 'image', 'cooking_time', 'rating', 'serving_min', 'serving_max', 'price', 'visited_count', 'calories', 'created_at')
            ->where('premium_content', true)
            ->paginate(12);

        $this->data['recipes'] = $recipes;
        $this->data['breadcrumbs'] = [
            'title' => 'Resep Teruji',
            'description' => 'Temukan resep makanan teruji yang telah dinilai tinggi oleh pengguna kami. Dapatkan inspirasi masakan lezat dan mudah dibuat di rumah.',
            'sub' => 'resep'
        ];

        return view('pages.web.resep_teruji', $this->data);
    }

    public function kategori($slug)
    {
        $tag = FoodTag::where('slug', $slug)->first();

        if ($slug === 'yummy') {
            $recipes = Recipe::with('user')
                ->where('user_id', 22)
                ->select('id', 'user_id', 'title', 'slug', 'image', 'cooking_time', 'rating', 'serving_min', 'serving_max', 'price', 'visited_count', 'created_at')
                ->paginate(12);
            $title = 'Resep Yummy';
        } elseif ($slug === 'sobat') {
            $recipes = Recipe::with('user')
                ->where('user_id', '!=', 1)
                ->select('id', 'user_id', 'title', 'slug', 'image', 'cooking_time', 'rating', 'serving_min', 'serving_max', 'price', 'visited_count', 'created_at')
                ->paginate(12);
            $title = 'Resep Sobat';
        } elseif (in_array($slug, ['masakan-goreng', 'masakan-bakar', 'masakan-rebus', 'masakan-panggang', 'masakan-kukus', 'masakan-tumis'])) {
            $keyword = match ($slug) {
                'masakan-goreng' => 'goreng',
                'masakan-bakar' => 'bakar',
                'masakan-rebus' => 'rebus',
                'masakan-panggang' => 'panggang',
                'masakan-kukus' => 'kukus',
                'masakan-tumis' => 'tumis',
            };

            $recipes = Recipe::with('user')
                ->where('title', 'like', '%' . $keyword . '%')
                ->select('id', 'user_id', 'title', 'slug', 'image', 'cooking_time', 'rating', 'serving_min', 'serving_max', 'price', 'visited_count', 'created_at')
                ->paginate(12);
            $title = 'Resep Makanan ' . ucfirst($keyword);
        } elseif (in_array($slug, ['ayam', 'telur', 'tahu', 'kentang', 'tempe'])) {
            $recipes = Recipe::with('user')
                ->where('title', 'like', '%' . $slug . '%')
                ->select('id', 'user_id', 'title', 'slug', 'image', 'cooking_time', 'rating', 'serving_min', 'serving_max', 'price', 'visited_count', 'created_at')
                ->paginate(12);
            $title = 'Resep dengan ' . ucfirst($slug);
        } elseif ($tag) {
            $recipes = $tag->recipes()
                ->with('user')
                ->select('recipes.id', 'recipes.user_id', 'recipes.title', 'recipes.slug', 'recipes.image', 'recipes.cooking_time', 'recipes.rating', 'recipes.serving_min', 'recipes.serving_max', 'recipes.price', 'recipes.visited_count', 'recipes.created_at')
                ->paginate(12);
            $title = $tag->name;
        } else {
            $recipes = Recipe::with('user')
                ->inRandomOrder()
                ->select('id', 'user_id', 'title', 'slug', 'image', 'cooking_time', 'rating', 'serving_min', 'serving_max', 'price', 'visited_count', 'created_at')
                ->paginate(12);
            $title = 'Kategori Tidak Ditemukan';
        }

        $this->data['breadcrumbs'] = [
            'title' => $title,
            'description' => 'Temukan berbagai kategori resep makanan yang telah disediakan. Dapatkan inspirasi masakan lezat dan mudah dibuat di rumah.',
            'sub' => 'kategori'
        ];

        $this->data['recipes'] = $recipes;

        return view('pages.web.kategori', $this->data);
    }


    public function filterByIngredients(Request $request)
    {
        $ingredientIds = $request->input('ingredients', []);
        $page = $request->input('page', 1);

        $recipesQuery = Recipe::with(['user', 'ingredients']);

        if (count($ingredientIds) > 0) {
            $recipesQuery->whereHas('ingredients', function ($q) use ($ingredientIds) {
                $q->whereIn('ingredients.id', $ingredientIds);
            });
        }

        $recipes = $recipesQuery->latest()->paginate(12);
        $totalCount = $recipesQuery->count();

        // Pass the pagination instance for rendering in the view
        $paginationHtml = '';
        if ($recipes->hasPages()) {
            $paginationHtml = view('components.ingredients.pagination', [
                'currentPage' => $recipes->currentPage(),
                'totalPages' => $recipes->lastPage(),
                'url' => '/filter-resep-bahan'
            ])->render();
        }

        return response()->json([
            'html' => view('components.ingredients.recipes-filter', compact('recipes'))->render(),
            'paginationHtml' => $paginationHtml,
            'count' => $recipes->count(),
            'total' => $totalCount
        ]);
    }

    public function ingredient_filter()
    {
        // Get all ingredients that are used the most in recipes this week
        $this->data['bahan_populer'] = Ingredient::select('id', 'name', 'slug', 'image_url')
            ->whereNotNull('image_url')
            ->whereHas('recipes', function ($query) {
                $query->where('created_at', '>=', now()->subDays(7));
            })
            ->withCount(['recipes' => function ($query) {
                $query->where('created_at', '>=', now()->subDays(7));
            }])
            ->orderBy('recipes_count', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($ingredient) {
                return [
                    'id' => $ingredient->id,
                    'name' => $ingredient->name,
                    'slug' => $ingredient->slug,
                    'image_url' => $ingredient->image_url,
                    'checked' => false // Initialize as unchecked
                ];
            });

        // Get all ingredients that are used the most in recipes this month, grouped by first letter
        $bahanLainCollection = Ingredient::select('id', 'name', 'slug', 'image_url')
            ->whereNotNull('image_url')
            ->whereHas('recipes', function ($query) {
                $query->where('created_at', '>=', now()->subDays(30));
            })
            ->whereNotIn('id', $this->data['bahan_populer']->pluck('id')) // Exclude popular ingredients
            ->withCount(['recipes' => function ($query) {
                $query->where('created_at', '>=', now()->subDays(30));
            }])
            ->orderBy('name')
            ->get()
            ->map(function ($ingredient) {
                return [
                    'id' => $ingredient->id,
                    'name' => $ingredient->name,
                    'slug' => $ingredient->slug,
                    'image_url' => $ingredient->image_url,
                    'checked' => false // Initialize as unchecked
                ];
            })
            ->groupBy(function ($item) {
                return strtoupper(Str::substr($item['name'], 0, 1));
            });

        $this->data['bahan_lain'] = $bahanLainCollection;
        // Initialize with empty recipes array - we'll show the empty state image
        $this->data['recipes'] = [];
        $this->data['title'] = 'Filter Berdasarkan Bahan';

        return view('pages.web.bahan-makanan', $this->data);
    }

    public function userRecipes($username, Request $request)
    {
        // Find user by username
        $user = User::where('username', $username)->firstOrFail();

        // Build query for recipes
        $recipesQuery = Recipe::where('user_id', $user->id)
            ->with(['user']);

        // Apply search if provided
        if ($request->has('search') && !empty($request->get('search'))) {
            $search = $request->get('search');
            $recipesQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Get recipes with pagination
        $recipes = $recipesQuery->latest()->paginate(12);

        // Count total recipes by user
        $recipesCount = Recipe::where('user_id', $user->id)->count();

        return view('pages.web.user-recipes', compact('user', 'recipes', 'recipesCount'));
    }

    public function recipeCreators(Request $request)
    {
        // Build query for all users who have created recipes
        $creatorsQuery = User::whereHas('recipes')
            ->withCount('recipes');  // Count recipes for each user

        // Apply search if provided
        if ($request->has('search') && !empty($request->get('search'))) {
            $search = $request->get('search');
            $creatorsQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%");
            });
        }

        // Get paginated creators
        $creators = $creatorsQuery->paginate(12);

        return view('pages.web.all-user-recipes', compact('creators'));
    }

    public function allRecipes(Request $request)
{
    // Build base query for recipes
    $recipesQuery = Recipe::with(['user']);
    
    // Handle search if provided
    if ($request->has('search') && !empty($request->get('search'))) {
        $search = $request->get('search');
        $recipesQuery->where(function($query) use ($search) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        });
    }
    
    // Default sort by newest
    $recipesQuery->orderByDesc('created_at');
    
    // Get paginated recipes
    $recipes = $recipesQuery->paginate(16);
    
    return view('pages.web.all-recipes', compact('recipes'));
}
}
