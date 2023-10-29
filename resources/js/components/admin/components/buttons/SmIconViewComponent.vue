<template>
    <router-link class="btn-lg bg-red view text-center" :to="{ name: this.$props.link, params: { id: this.$props.id } }">
        <span class="text-white mt-1 text-sm">Edit</span>
        <span class="db-tooltip">"{{ $t('button.view') }}"</span>
    </router-link>
</template>

<script>
export default {
    name: "SmIconViewComponent",
    props: {
        link: String,
        id: Number
    }
}
</script>
