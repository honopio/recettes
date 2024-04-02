<template>
    <Layout>
    <div class="tout">
        <br>
        <style>
            .btn {
                background-color: #f5f5f5;
                color: #363636;
                border: 1px solid #363636;
                padding: 10px 20px;
                border-radius: 5px;
                cursor: pointer;
            }

            .btn:hover {
                background-color: #a5a5a5;
                color: #000000;
            }

            .box {
                /* Style the boxes. used for comments, input fields, textareas */
                border: 1px solid #f5f5f5;
                padding: 20px;
                margin-bottom: 20px;
            }
            .box:hover {
                border: 1px solid #363636;
            }

            .textarea {
                width: 100%;
                height: 100px;
                padding: 10px;
                margin-bottom: 20px;
            }
            .textarea:hover {
                border: 1px solid #363636;
            }
            .formulaire {
                margin: 30px 0;
            }
        </style>

        <div class="columns is-multiline">
            <div class="column is-offset-1 is-10">
                <span><small class="has-text-grey-dark">{{ recipe.updated_at }}</small></span>

                <a class="has-text-grey-dark" :href="`recettes/${recipe.url}`">
                    <h2 class="mt-2 mb-2 is-size-3 is-size-4-mobile has-text-weight-bold">{{ recipe.title }}</h2>
                </a>
                <p class="subtitle has-text-grey"><em>par {{ recipe.user.name }}</em></p>

                <span class="subtitle has-text-grey"><strong><em>Ingredients</em></strong> :</span>
                <span
                    v-for="(ingredient, index) in recipe.ingredients"
                    :key="index"
                    class="subtitle has-text-grey"
                >
                    {{ ingredient.name }}
                    <span v-if="index !== recipe.ingredients.length - 1" class="subtitle has-text-grey">,</span>
                </span>

                <br><br>
                <p class="subtitle has-text-grey">{{ recipe.content }}</p>

                <p class="subtitle has-text-grey">
                    <strong><em>Tags</em></strong> :
                    <em v-if="recipe.tags.length === 0">pas de tags</em>
                    <a v-else v-for="tag in recipe.tags" :key="tag.name" :href="`tags/${tag.name}`">
                        <span class="tag">{{ tag.name }}</span>
                    </a>
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
                    <form action="comment" method="post">
                        @csrf
                        <input type="hidden" name="recipe_id" :value="recipe.id">
                        <div class="field">
                            <div class="control">
                                <label class="subtitle">Ajoutez un commentaire</label><br>
                                <textarea class="textarea" name="content" placeholder="Ecrivez votre commentaire"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn subtitle has-text-grey border-radius=5px">Envoyer</button>
                    </form>
                </div>

                <div v-if="success" class="alert alert-success">
                    <p style="color: green; font-style: italic; font-size: 18px;">{{ success }}</p>
                </div>
                <br>

                <div v-if="!isLoggedIn" class="subtitle has-text-grey">
                    <em>Connectez-vous pour ajouter un commentaire</em>
                </div>

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

export default {
    components: {
        Link,
        Layout,
    },


};
</script>
