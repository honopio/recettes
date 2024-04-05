<template>
    <Layout title="Admin : créer une recette">
    <div class="container">
        <div v-if="success" class="alert alert-success">
            <p style="color: green; font-style: italic; font-size: 18px;">{{ success }}</p>
        </div>
        <h1 class="mt-2 mb-4 is-size-1 is-size-3-mobile has-text-weight-bold">Créer la Recette</h1>

        <form @submit.prevent="createRecipe">
            <div class="form-group">
                <label for="title" class="subtitle has-text-grey">Title</label>
                <input v-model="title" type="text" id="title" class="form-control box" required>
            </div>
            <div class="form-group">
                <label for="content" class="subtitle has-text-grey">Content</label>
                <textarea v-model="content" id="content" class="form-control textarea box" required rows="10"></textarea>
            </div>

            <!-- SOCCUPER DES INGREDIENTS -->

            <!-- <div class="form-group">
                <label for="ingredients" class="subtitle has-text-grey">Ingredients</label>
                <textarea v-model="ingredients" id="ingredients" class="form-control message-textarea" required></textarea>
            </div> -->

            <div class="form-group">
                <label for="price" class="subtitle has-text-grey">Price</label>
                <input v-model="price" type="number" id="price" class="form-control box" required>
            </div>
            <br>
            <button type="submit" class="btn btn-primary subtitle has-text-grey rounded box">Ajouter</button>
        </form>
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
            price: null
            }
        };
    },
    methods: {
        async createRecipe() {
            try {
                await this.$inertia.post(route('recettes.store'), {
                    title: this.title,
                    content: this.content,
                    price: this.price
                });
                this.success = `Vous avez créé la recette ${this.title} avec succès !`;
            } catch (error) {
                console.error('Error creating recipe:', error);
            }
        }
    },
    components: {
        Layout,
        Link
    }
};
</script>

<style scoped>
    @import './../../css/stylesheet.css';

</style>
