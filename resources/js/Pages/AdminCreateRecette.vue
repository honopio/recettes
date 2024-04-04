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
                <input v-model="title" type="text" id="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="content" class="subtitle has-text-grey">Content</label>
                <textarea v-model="content" id="content" class="form-control message-textarea" required rows="10"></textarea>
            </div>

            <!-- SOCCUPER DES INGREDIENTS -->

            <!-- <div class="form-group">
                <label for="ingredients" class="subtitle has-text-grey">Ingredients</label>
                <textarea v-model="ingredients" id="ingredients" class="form-control message-textarea" required></textarea>
            </div> -->

            <div class="form-group">
                <label for="price" class="subtitle has-text-grey">Price</label>
                <input v-model="price" type="number" id="price" class="form-control" required>
            </div>
            <br>
            <button type="submit" class="btn btn-primary subtitle has-text-grey rounded">Ajouter</button>
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
            ingredients: '',
            price: null
            }
        };
    },
    methods: {
        async createRecipe() {
            await this.$inertia.post(route('recettes.store'), this.newRecipeData);
            console.log('Response from server:', response);

            this.success = `Vous avez créé la recette ${this.title} avec succès !`;
            console.log('Success:', this.success);
        }
    },
    components: {
        Layout,
        Link
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
.container {
    margin: 20px;
}
</style>
