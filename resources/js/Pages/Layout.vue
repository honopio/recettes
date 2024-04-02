<template>
    <div>
        <nav class="navbar py-4">
            <div class="container">
                <div class="navbar-brand">
                    <Link class="navbar-item" :href="'/'">
                        <span class="icon">
                            <i class="fas fa-utensils" style="font-size:26px; width:26px"></i>
                        </span>
                    </Link>
                    <Link class="navbar-burger" role="button" aria-label="menu" aria-expanded="false">
                        <span aria-hidden="true"></span>
                        <span aria-hidden="true"></span>
                        <span aria-hidden="true"></span>
                    </Link>
                </div>
                <div class="navbar-menu">
                    <div class="navbar-start">
                        <Link class="navbar-item" href="/">Home</Link>
                        <Link class="navbar-item" href="/recettes">Recettes</Link>
                        <Link class="navbar-item" href="/contact">Contact</Link>
                        <Link class="navbar-item" href="/tags">Tags</Link>
                        <Link class="navbar-item" href="/phpliteadmin.php">DBADMIN</Link>
                    </div>
                    <div class="navbar-item">
                        <!-- Search form -->
                        <form id="search-form" action="/recettes/search" method="GET">
                            <div class="field has-addons">
                                <div class="control">
                                    <input class="input" id="search-input" type="search" placeholder="Search" aria-label="Search" name="recipe">
                                </div>
                                <div class="control">
                                    <button id="search-button" class="button" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </nav>

        <section class="section">
            <div class="container">
                <div class="mb-6 columns is-multiline is-centered">
                    <div class="column is-8 has-text-centered">
                        <span class="has-text-grey-dark">{{ title }}</span>
                        <h2 class="mt-2 mb-4 is-size-1 is-size-3-mobile has-text-weight-bold">Recettes</h2>
                        <p class="subtitle has-text-grey">Le meilleur de la cuisine</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <slot></slot>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    name: "Layout",
    components: {
        Link,
    },
    props: {
        title: String, // Define title prop to receive page title
        component: Object // Define component prop to receive Inertia component
    },



}
</script>

<style scoped>
/* Your CSS styles for the layout go here */
</style>
