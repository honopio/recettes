<!--  PAGE ADMIN : LISTE DES RECETTES -->

<style>
    @import './../../css/stylesheet.css';
</style>

<template>
    <Layout :title="'Admin : liste des recettes'">
    <div class="tout">
        <div v-if="success" class="alert alert-success">
            <p style="color: green; font-style: italic; font-size: 18px;">{{ success }}</p>
        </div>
        <br>
        <br><br>
        <div class="container">

            <!-- href to this route : Route::get('/admin/recettes/create', [AdminController::class, 'create']); -->
            <Link :href="`/admin/recettes/create`">Ajouter une recette</Link>
            <br><br>
            <table class="table">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Numéro utilisateur</th>
                        <th>Edition</th>
                        <th>Suppression</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="recette in recipes" :key="recette.id">
                        <td>{{ recette.title }}</td>
                        <td>{{ recette.user_id }}</td>
                        <td>
                            <!-- link that goes to admin/recettes/edit/{{the id of the recipe}}, with <Link> -->
                            <Link :href="`/admin/recettes/edit/${recette.id}`">Modifier</Link>

                        </td>
                        <td>
                            <Link href="#" @click="deleteRecipe(recette.id)">Supprimer</Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
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
            recipes: [],
        };
    },
    props: {
        recipes: {
            type: Array,
            required: true
        }
    },
    components: {
        Link,
        Layout,
    },

    methods: {

        createRoute() {
            return "{{ route('recettes.create') }}";
        },

        /*
        * on passe en parametre de cette methode l'id de la recette pour pouvoir l'utiliser dans la route
        * redirige vers l'URL /admin/recettes/edit/{id}
        */
        editRoute(id) {
            return "{{ route('recettes.edit', '') }}/" + id;
        },

    async deleteRecipe(id) {
        if (confirm('Êtes-vous sûr de vouloir supprimer cette recette?')) {
            try {
                // Faire une requête DELETE à la route de suppression
                await this.$inertia.delete(route('recettes.destroy', id));
                // Mettre à jour les données après la suppression
                this.recipes = this.recipes.filter(recipe => recipe.id !== id);
                // Afficher un message de succès
                this.success = 'Recette supprimée avec succès.';
            } catch (error) {
                console.error('Erreur lors de la suppression de la recette :', error);
            }
        }
    }
}


};
</script>
