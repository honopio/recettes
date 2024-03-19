 <?php
 namespace App\Http\Controllers;

 use Illuminate\Http\Request;
 use App\Models\Recipe;

 class AdminController extends Controller
 {
    // permet l'affichage d'une liste complète des recettes
    function index(){
        $recipes = Recipe::all(); //get all recipes

        return view('admin',array(
            'recipes' => $recipes
        ));
    }

    // permet l'ajout d'une recette
    function add(){
        return view('admin/add');
    }

    // permet l'édition d'une recette
    public function edit($recipe_id) {
        $recipe = \App\Models\Recipe::where('id',$recipe_id)->first(); //get first recipe with recipe_nam == $recipe_name

        return view('admin/edit',array( //Pass the recipe to the view
            'recipe' => $recipe
        ));
    }

    // permet la suppression d'une recette.
    public function delete($recipe_id) {
        $recipe = \App\Models\Recipe::where('id',$recipe_id)->first(); //get first recipe with recipe_nam == $recipe_name
        $recipe->delete();
        return redirect('/admin');
    }
 }
    ?>
