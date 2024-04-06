<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Models\Recipe;
use Inertia\Inertia;
use App\Models\Ingredient;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // display a list of all recipes title and userid in admin list
        $recipes = Recipe::all();

      //  dd($recipes->toArray());

        //return AdminRecettes.vue
        return Inertia::render('AdminRecettes', [
            'recipes' => $recipes
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // get to a create a new recipe page
       // return view('admin/create');

       //return AdminRecettes.vue
         return Inertia::render('AdminCreateRecette');

    }

    /**
     * Store a newly created recipe in storage.
     */
    public function store(Request $request)
    {
       //dd($request->all());
        $request->validate([
            'title' => 'required',
            'content' => 'required',
           // 'ingredients' => 'array',
            //price is a number, is min 0, and is not required
            'price' => 'numeric|min:0'
        ]);

        //store the recipe
        $recipe = new Recipe;
        //USER ID CODE EN DUR
        $recipe->user_id = 1;
        $recipe->title = $request->input('title');
        $recipe->content = $request->input('content');
        $recipe->price = $request->input('price');
        $recipe->url = $request->input('title');
        $recipe->save();

        //les ingredients sont créés s'ils n'existent pas déjà et sont attachés à la recette
        foreach ($request->input('ingredients') as $ingredientData) {
            $ingredient = Ingredient::firstOrCreate(['name' => $ingredientData['name']]);
            $recipe->ingredients()->attach($ingredient->id);
        }
        //return the same vue with success message
        return redirect()->back();
    }


    /**
     * Montre un formulaire pour editer une recette
     */
    public function edit(string $id)
    {
        // Get the recipe and its associated ingredients
        $recipe = Recipe::with(['tags', 'ingredients'])->where('id', $id)->first();

        //dd the ingredients. correctly passed to the view.
        // dd($recipe->ingredients->toArray());

        // Pass the recipe and ingredient names to the view
        return Inertia::render('AdminEditRecette', [
            'recipe' => $recipe,
        ]);
    }

    /**
     * Met à jour la recette dans la base de données
     */
    public function update(Request $request, string $id)
    {

        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'price' => 'numeric|min:0',
            'ingredients' => 'array',

        ]);

        // Validation passed, update the recipe
        $recipe = Recipe::find($id);
        $recipe->title = $validatedData['title'];
        $recipe->content = $validatedData['content'];
        $recipe->price = $validatedData['price'];
        $recipe->save();

        // Detach all ingredients from the recipe
        $recipe->ingredients()->detach();

         // Update or create ingredients
        foreach ($validatedData['ingredients'] as $ingredientData) {
            // Check si l'ingredient existe dans la db
            $ingredient = Ingredient::where('name', $ingredientData['name'])->first();
            if (!$ingredient) {
                // s'il existe pas, il est créé et sauvegardé, et updaté dans la table ingredient_recipe
                $ingredient = new Ingredient();
                $ingredient->name = $ingredientData['name'];
            } else {
                // s'il existe, il est updaté
                $ingredient->name = $ingredientData['name'];
            }
            $ingredient->save();

            //on attache l'ingredient a la recette
            $recipe->ingredients()->attach($ingredient->id);
            // // un ingredient modifié est attaché à la recette (table ingredient_recipe)
        }

        return redirect()->back();
    }


    /**
     * Supprime la recette de la db
     */
    public function destroy(string $id)
    {
        //delete $id recipe
        $recipe = Recipe::findOrFail($id);
        $recipe->delete();
        return redirect('/admin/recettes');

    }
}
