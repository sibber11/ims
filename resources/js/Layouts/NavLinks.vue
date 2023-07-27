<template>
    <NavLink :active="route().current('dashboard')" :href="route('dashboard')">
        Dashboard
    </NavLink>

</template>
<script setup>
import NavLink from "@/Components/NavLink.vue";

</script>
