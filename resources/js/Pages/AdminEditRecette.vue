<template>

    <Layout :title="'Admin : modification de recette'">
    <div class="container">
        <!-- display success -->
        <div v-if="success" class="alert alert-success">
            <p style="color: green; font-style: italic; font-size: 18px;">{{ success }}</p>
        </div>
        <br>

        <h1 class="mt-2 mb-4 is-size-1 is-size-3-mobile has-text-weight-bold">Modifier la Recette</h1>

        <!-- prevent pour éviter le page reload et soumettre le form avec JS-->
        <form @submit.prevent="submitForm">
            <div class="form-group">
                <label for="title" class="subtitle has-text-grey">Titre</label>
                <input v-model="recipe.title" type="text" name="title" id="title" class="form-control" required>
            </div>
            <br>

            <div class="form-group">
                <label for="content" class="subtitle has-text-grey">content</label>
                <textarea v-model="recipe.content" name="content" id="content" class="form-control message-textarea" required rows="5"></textarea>
            </div>
            <br>

            <div class="form-group">
                <label for="ingredients" class="subtitle has-text-grey">Ingrédients</label>

                <!-- displays the names of the ingredients of the recipe. one text area for each ingredient of the recipe -->
                <div v-for="(ingredient, index) in recipe.ingredients" :key="index">
                    <input v-model="ingredient.name" type="text" name="ingredients" id="ingredients" class="form-control" required>
                    <!-- button to remove this ingredient from the recipe -->
                    <button @click="recipe.ingredients.splice(index, 1)" class="btn btn-primary subtitle has-text-grey rounded">Supprimer</button>
                </div>

            </div>
            <br>

            <div class="form-group">
                <label for="price" class="subtitle has-text-grey">Prix</label>
                <input v-model="recipe.price" type="number" name="price" id="price" class="form-control" required>
            </div>
            <br>

            <button type="submit" class="btn btn-primary subtitle has-text-grey rounded">Enregistrer</button>
        </form>

        <!-- retour" button that goes back to /admin/recettes -->
        <br>
        <button @click="$inertia.visit('/admin/recettes')" class="btn btn-primary subtitle has-text-grey rounded">Retour</button>
        <br>
    </div>
    </Layout>
</template>

<script>
import Layout from './Layout.vue';
import { Link } from '@inertiajs/inertia-vue3';

export default {
    data() {
        return {
            success: null,
            // recipeData: {
            //     title: '',
            //     content: '',
            //     // ingredients: [],
            //     price: 0
            // }
        };
    },
    methods: {
        submitForm() {
            // modifie la recette. soumission du formulaire
            this.$inertia.post(`/admin/recettes/edit/${this.recipe.id}`, this.recipe)
            this.success = `Vous avez modifié la recette ${this.recipe.title} avec succès !`;
        }

    },
    components: {
        Link,
        Layout,
    },
    props: {
        recipe: {
            type: Object,
            required: true
        },

    }
};
</script>

<style scoped>
.form-group {
    margin-bottom: 20px;
}

.subtitle {
    display: block;
}

.message-textarea {
    width: 80%;
}


/* style for buttons. with a border */
.btn {
    border: 1px solid #000;
    padding: 10px 20px;
    text-align: center;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 16px;
}
</style>
