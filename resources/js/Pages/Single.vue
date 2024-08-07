<!--  COMPONENT POUR AFFICHER UNE SEULE RECETTE -->

<template>
    <Layout>
    <div class="tout">
        <br>


        <div class="columns is-multiline">
            <div class="column is-offset-1 is-10">
                <span><small class="has-text-grey-dark">{{ recipe.updated_at }}</small></span>

                <Link :href="`/recettes/${recipe.url}`" class="has-text-grey-dark">
                    <h2 class="mt-2 mb-2 is-size-3 is-size-4-mobile has-text-weight-bold">{{ recipe.title }}</h2>
                </Link>
                <p class="subtitle has-text-grey"><em>par {{ recipe.user.name }}</em></p>

            <!-- Display the list of ingredients -->
            <span class="subtitle has-text-grey"><strong><em>Ingredients</em></strong> : </span>
            <span class="subtitle has-text-grey" v-for="(ingredient, key) in recipe.ingredients" :key="key">
                <Link class="has-text-grey-dark" :href="`/recettes/search?recipe=${ingredient.name}`">{{ ingredient.name }}</Link>
                <!-- Add a comma between ingredients (after every ingredient, except for the last one)-->
                <span v-if="key < recipe.ingredients.length - 1" class="subtitle has-text-grey">, </span>
            </span>

            <!-- Display the content of the recipe -->
            <br><br>
            <p class="subtitle has-text-grey">{{ recipe.content }}</p>

            <!-- Display the tags -->
            <p class="subtitle has-text-grey">
            <strong><em>Tags</em></strong> :
            <!-- If there are no tags, say "pas de tags" -->
            <span v-if="!recipe.tags || recipe.tags.length === 0">pas de tags</span>
            <!-- If there are tags, display them -->
            <template v-else>
                <span v-for="tag in recipe.tags" :key="tag.id">
                    <Link :href="`/tags/${tag.name}`" class="tag">{{ tag.name }}</Link>
                </span>
            </template>
            </p>

            </div>
        </div>
        <br><br>

        <div class="columns is-multiline">
            <div class="column is-offset-1 is-10">
                <h2 class="mt-2 mb-2 is-size-3 is-size-4-mobile has-text-weight-bold">
                    Commentaires ({{ recipe.comments.length }})
                </h2>

                <div class="formulaire">
                    <form @submit.prevent="createComment">
                        <input type="hidden" name="recipe_id" :value="recipe.id">
                        <div class="field">
                            <div class="control">
                                <label class="subtitle">Ajoutez un commentaire</label><br>
                                <textarea v-model="content" class="textarea" name="content" placeholder="Ecrivez votre commentaire"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="field">
                            <div class="control">
                                <a @click="loadCaptcha" class="has-text-grey">Charger un autre captcha</a><br><br>
                                <p v-html="captchaImage"></p><br>
                                <label for="captcha" class="subtitle has-text-grey">Saisissez le résultat : </label>
                                <input v-model="captcha" type="text" name="captcha" id="captcha" class="form-control box" required>
                            </div>
                        </div>
                        <button type="submit" class="btn subtitle has-text-grey border-radius=5px">Envoyer</button>
                    </form>
                </div>

                <!-- Success message -->
                <div v-if="feedback" class="notification">
                    {{ feedback }}
                </div>
                <br>


                <div v-for="comment in recipe.comments" :key="comment.id" class="box">
                    <p class="is-size-5">{{ comment.user.name }}</p>
                    <p><small class="has-text-grey-dark">{{ comment.created_at }}</small></p>
                    <p>{{ comment.content }}</p>
                </div>
            </div>
        </div>
    </div>
    </Layout>
</template>

<script>
import Layout from './Layout.vue';
import { Link } from '@inertiajs/inertia-vue3';
import axios from 'axios';

export default {
    data() {
        return {
            isLoggedIn: false,
            content: '',
            captcha: '',
            captchaImage: '',
        };
    },

    methods: {
        async createComment() {
            try {
                const response = await this.$inertia.post(route('comments.store', { recipe: this.recipe.id }), {
                    content: this.content,
                    recipe_id: this.recipe.id,
                    captcha: this.captcha,
                });

                // After a successful submission, add the new comment to the recipe.comments array
                this.recipe.comments.push(response.data);

                this.content = '';
                this.captcha = '';
                this.loadCaptcha();

                // Reload the page
                location.reload();
            } catch (err) {
                console.error('Error creating comment:', err);
                this.loadCaptcha();
            }
        },

        async loadCaptcha() {
            try {
                const response = await axios.get('/captcha', { responseType: 'blob' });
                const url = URL.createObjectURL(response.data);
                this.captchaImage = `<img src="${url}" alt="Captcha Image" />`;
            } catch (err) {
                console.error('Error fetching captcha:', err);
            }
        },
    },
    mounted() {
        this.loadCaptcha();
    },
    components: {
        Link,
        Layout,
    },
    props: {
        recipe: {
            type: Object,
            required: true,
        },
        //pour passer un message de succès
        feedback: {
            type: String,
            default: null
        },
    }
};
</script>
<style>
    @import './../../css/stylesheet.css';

</style>

