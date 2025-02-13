<?php

namespace App\Http\Controllers\Api;

use App\Factories\RestaurantFactory;
use App\Http\Controllers\Controller;
use App\Http\Resources\RestaurantResource;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RestaurantController extends Controller
{
    public function index()
    {
        return RestaurantResource::collection(Restaurant::all());
    }

    public function show()
    {
        $restaurant = RestaurantFactory::make();
        if ($slug = request()->route('restaurant')) {
            $restaurant = Restaurant::where('slug', $slug)->firstOrFail();
        }

        if (! $restaurant) {
            throw new NotFoundHttpException('Restaurant not found');
        }

        return RestaurantResource::make($restaurant);
    }
}
