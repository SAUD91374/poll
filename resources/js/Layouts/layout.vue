<!-- Layout.vue -->
<template>
    <div class="flex flex-col min-h-screen font-rajdhani">
        <Header v-if="$page.props.auth.user" />
        <main class="mt-6">
            <slot />
        </main>
        <Footer v-if="$page.props.auth.user" />
    </div>
</template>

<script>
import Header from "./Header.vue";
import Footer from "./Footer.vue";
import { Link } from "@inertiajs/vue3";


export default {
    components: {
        Header,
        Footer,
    },
};
</script>
