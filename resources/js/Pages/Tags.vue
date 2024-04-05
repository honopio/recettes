<template>
    <Layout :title="'Liste des tags'">
        <div class="tout">
        <template v-if="tags.length === 0">
            <p><em>pas de tags</em></p>
        </template>

        <!-- display la liste des tags s'ils existent -->
        <template v-else>
            <p class="has-text-grey-dark is-size-5">Cliquez sur un tag pour voir les recettes associées !</p><br>

            <li v-for="tag in tags" :key="tag.id">

                <Link :href="`/tags/${tag.name}`">
                    <span class="is-size-5 has-text-weight-bold has-text-grey-dark">{{ tag.name }}</span>
                </Link>

            </li>

        </template>
        </div>
    </Layout>
</template>

<script>
import Layout from './Layout.vue';
import { Link } from '@inertiajs/inertia-vue3';
export default {
    name: 'Tags.vue',
    components: {
        Link,
        Layout,
    },
    props: {
        tags: {
            type: Array,
            required: true
        }
    }
}
</script>

<style scoped>
    @import './../../css/stylesheet.css';
</style>
