<?php
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\DietController;
use App\Http\Controllers\HealthRecordController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ResignationController;


use App\Http\Controllers\Shop\VendorController;
use App\Http\Controllers\Shop\CategoryController;
use App\Http\Controllers\Shop\ProductController;
use App\Http\Controllers\Shop\OrderController;
use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\Shop\ReviewController;
// Auth publique
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

// Routes protégées
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me',      [AuthController::class, 'me']);

    // Joueurs
    Route::apiResource('players', PlayerController::class);
    Route::get('players/{id}/stats', [StatsController::class, 'byPlayer']);

    // Matchs
    Route::apiResource('matches', MatchController::class);
    Route::get('matches/{id}/stats', [StatsController::class, 'byMatch']);

    // Stats
    Route::get('stats/top-scorers', [StatsController::class, 'topScorers']);
    Route::apiResource('stats', StatsController::class);

    // Équipes
    Route::apiResource('teams', TeamController::class);
    Route::get('teams/{id}/stats', [StatsController::class, 'byTeam']);


    Route::post('upload', [UploadController::class, 'upload']);
    Route::delete('upload', [UploadController::class, 'delete']);


    // Entraînements
    Route::apiResource('trainings', TrainingController::class);

// Workouts
    Route::apiResource('workouts', WorkoutController::class);

// Régimes
    Route::apiResource('diets', DietController::class);

// Santé
    Route::apiResource('health-records', HealthRecordController::class);

// Blog
    Route::apiResource('posts', PostController::class);
    Route::post('posts/{id}/approve', [PostController::class, 'approve']);
    Route::post('posts/{id}/reject',  [PostController::class, 'reject']);

// Démissions
    Route::apiResource('resignations', ResignationController::class);
    Route::post('resignations/{id}/approve', [ResignationController::class, 'approve']);
    Route::post('resignations/{id}/reject',  [ResignationController::class, 'reject']);    


    // Catégories
Route::apiResource('shop/categories', CategoryController::class);

// Produits
Route::get('shop/products/featured',    [ProductController::class, 'featured']);
Route::get('shop/products/top-sellers', [ProductController::class, 'topSellers']);
Route::apiResource('shop/products', ProductController::class);

// Vendeurs
Route::get('shop/vendors',              [VendorController::class, 'index']);
Route::post('shop/vendors',             [VendorController::class, 'store']);
Route::get('shop/vendors/{id}',         [VendorController::class, 'show']);
Route::put('shop/vendors/{id}',         [VendorController::class, 'update']);
Route::delete('shop/vendors/{id}',      [VendorController::class, 'destroy']);
Route::post('shop/vendors/{id}/approve',[VendorController::class, 'approve']);
Route::post('shop/vendors/{id}/reject', [VendorController::class, 'reject']);

// Panier
Route::get('shop/cart',           [CartController::class, 'index']);
Route::post('shop/cart',          [CartController::class, 'store']);
Route::put('shop/cart/{id}',      [CartController::class, 'update']);
Route::delete('shop/cart/{id}',   [CartController::class, 'destroy']);
Route::delete('shop/cart',        [CartController::class, 'clear']);

// Commandes
Route::get('shop/orders',                    [OrderController::class, 'index']);
Route::post('shop/orders',                   [OrderController::class, 'store']);
Route::get('shop/orders/{id}',               [OrderController::class, 'show']);
Route::get('shop/admin/orders',              [OrderController::class, 'allOrders']);
Route::put('shop/admin/orders/{id}/status',  [OrderController::class, 'updateStatus']);

// Avis
Route::post('shop/reviews',        [ReviewController::class, 'store']);
Route::delete('shop/reviews/{id}', [ReviewController::class, 'destroy']);
});