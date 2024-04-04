<template>
    <Layout>
    <div class="container">
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
                <!-- textarea that displays the names of the ingredients of the recipe.
                now that we've implemented a ingredients table, we need to change the form
            -->
                <!-- <textarea v-model="recipe.ingredients" name="ingredients" id="ingredients" class="form-control message-textarea" required rows="5"></textarea> -->
            </div>
            <br>

            <div class="form-group">
                <label for="price" class="subtitle has-text-grey">Prix</label>
                <input v-model="recipe.price" type="number" name="price" id="price" class="form-control" required>
            </div>
            <br>

            <button type="submit" class="btn btn-primary subtitle has-text-grey rounded">Submit</button>
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
            recipeData: {
                title: '',
                content: '',
                ingredients: '',
                price: 0
            }
        };
    },
    methods: {
        submitForm() {
            // modifie la recette. soumission du formulaire
            this.$inertia.post(`/admin/recettes/edit/${this.recipe.id}`, this.recipe)
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
</style>
