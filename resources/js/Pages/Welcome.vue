<template>
    <Layout :title="'Home page'">
    <div>


     <!-- If recipes is undefined or empty -->
     <template v-if="!recipes || recipes.length === 0">
        <p>No recipes found</p>
      </template>

      <!-- Display recipes if available -->
      <template v-else>
        <h1 class="mt-2 mb-2 is-size-3 is-size-4-mobile has-text-weight-bold">Les 3 dernières recettes : </h1>
        <br><br>
        <div class="columns is-multiline">

          <!-- Loop through each recipe -->
          <div class="column is-4 mb-5" v-for="recipe in recipes" :key="recipe.id">
            <span><small class="has-text-grey-dark">{{ recipe.updated_at }}</small></span>
            <Link :href="`/recettes/${recipe.url}`" class="has-text-grey-dark">
                <h2 class="mt-2 mb-2 is-size-3 is-size-4-mobile has-text-weight-bold">{{ recipe.title }}</h2>
            </Link>

            <!-- Display the user who created the recipe. "user" a été passé dans le controller -->
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
            <p class="subtitle has-text-grey">{{ recipe.content.substring(0, 250) }}...</p>

            <!-- Display the tags -->
            <p class="subtitle has-text-grey">
              <strong><em>Tags</em></strong> :
              <span v-if="recipe.tags.length === 0"><em>pas de tags</em></span>
              <template v-else>
                <!-- avec ':' pcq c un attribut dynamique. sans quand c un attribut statique. c un shortcut pour v-bind:href-->
                <span v-for="tag in recipe.tags" :key="tag.id">
                    <Link :href="`/tags/${tag.name}`" class="tag">{{ tag.name }}</Link>
                </span>
              </template>
            </p>

            <!-- Link to the recipe URL -->
            <Link class="has-text-grey-dark" :href="`/recettes/${recipe.url}`"><em>> Lire en entier <</em></Link>
          </div>
        </div>
      </template>
    </div>
    </Layout>
  </template>

  <script>
  import Layout from './Layout.vue';
 import { Link } from '@inertiajs/inertia-vue3';
//  import { Link } from 'vue-router' //finalement j'utilise pas ça

  export default {
    name: 'Recipes.vue',
    components: {
        Link,
        Layout,
    },
    props: {
      recipes: {
        type: Array,
        required: true
      }
    }
  }
  </script>

  <style scoped>
  /* add margin right and left to the whole page*/
    .columns {
        margin-right: 1rem;
        margin-left: 1rem;
    }

    .tag {
        margin-right: 0.5rem;
    }

  </style>
