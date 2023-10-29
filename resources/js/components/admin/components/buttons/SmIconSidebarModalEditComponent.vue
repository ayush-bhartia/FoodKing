<template>
    <button data-modal="#sidebar" class="btn-lg edit text-center" style="
        width:75px
    ">
        <i class="lab lab-edit-line text-red-600">

        </i>
        <span style="font-size: 0.715rem;
        line-height: 1.25rem;
    }">Quick Edit</span>
        <span class="db-tooltip">{{ $t('button.edit') }}</span><br />

    </button>
</template>

<script>
export default {
    name: "SmIconSidebarModalEditComponent",
}
</script>

<style scoped></style>
