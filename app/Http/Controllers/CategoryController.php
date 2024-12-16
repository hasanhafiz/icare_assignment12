<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Knuckles\Scribe\Attributes\Group;
use App\Http\Resources\CategoryResource;

#[Group('Categories')]

class CategoryController extends Controller
{
    /**
     * Category List
     *
     * Returns a list of categories
     */
    public function index() {
        $categories = Category::all();
        // return $categories;
        return CategoryResource::collection( $categories );
        // return response()->json( new CategoryResource( $categories ) );
    }
    
    /**
     * Get Category
     * 
     * Get a single category using an ID
     */
    public function show( Category $category ) {
        return new CategoryResource( $category );
        // return response()->json( new CategoryResource( $category ) );
    }
    
    /**
     * Create Category
     * 
     * This creates a Category object
     */
    public function store( Request $request ) {
        
Category::insert([
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        ]);
    
        return response()->json([
            'success' => 'Categoy Created successfully.'
        ]);
    }
}
