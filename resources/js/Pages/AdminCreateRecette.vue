<!-- COMPONENT POUR FORMULAIRE DE CREATION DE RECETTE -->

<template>
    <Layout title="Admin : créer une recette">
    <div class="tout">
        <div v-if="success" class="alert alert-success">
            <p style="color: green; font-style: italic; font-size: 18px;">{{ success }}</p>
        </div>
        <h1 class="mt-2 mb-4 is-size-1 is-size-3-mobile has-text-weight-bold">Créer la Recette</h1>

        <form @submit.prevent="createRecipe">
            <div class="form-group">
                <label for="title" class="subtitle has-text-grey">Title</label>
                <input v-model="newRecipeData.title" type="text" id="title" class="form-control box" required>
            </div>
            <div class="form-group">
                <label for="content" class="subtitle has-text-grey">Content</label>
                <textarea v-model="newRecipeData.content" id="content" class="form-control textarea box" required rows="10"></textarea>
            </div>

            <div class="form-group">
                <label for="ingredients" class="subtitle has-text-grey">Ingredients</label>
                <div v-for="(ingredient, index) in newRecipeData.ingredients" :key="index" style="display: flex; align-items: center;">
                    <input v-model="ingredient.name" type="text" id="ingredients" class="form-control box" required>
                    <button @click="newRecipeData.ingredients.splice(index, 1)" class="btn btn-primary has-text-grey rounded" style="margin-left: 10px">Supprimer</button>
                </div>
                <br><button @click="addIngredient" class="btn btn-primary has-text-grey rounded">Ajouter un ingredient</button>
            </div>
            <br>
            <div class="form-group">
                <label for="price" class="subtitle has-text-grey">Price</label>
                <input v-model="newRecipeData.price" type="number" id="price" class="btn btn-primary form-control box" required>
            </div>
            <br>
            <button type="submit" class="btn btn-primary has-text-grey rounded box" style="font-size: 20px;">Poster la recette</button>
        </form>

              <!-- retour" button that goes back to /admin/recettes -->
            <br>
            <button @click="$inertia.visit('/admin/recettes')" class="btn btn-primary  has-text-grey rounded">Retour</button>
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
            newRecipeData: {
            title: '',
            content: '',
            price: null,
            ingredients : []
            }
        };
    },
    methods: {
        async createRecipe() {
            console.log(this.newRecipeData)
            try {
                await this.$inertia.post(route('recettes.store'), this.newRecipeData);
                this.success = `Vous avez créé la recette ${this.newRecipeData.title} avec succès !`;
            } catch (error) {
                console.error('Error creating recipe:', error);
                if (error.response && error.response.data) {
                    console.error('Server response:', error.response.data);
                }
            }
        },

        addIngredient() {
            this.newRecipeData.ingredients.push({ name: '' });
        },
    },
    components: {
        Layout,
        Link
    },

};
</script>

<style scoped>
    @import './../../css/stylesheet.css';

</style>
