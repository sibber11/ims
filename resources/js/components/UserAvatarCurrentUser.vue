<script setup>
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import UserAvatar from "@/components/UserAvatar.vue";

const firstName = computed(() => usePage().props.auth.user.first_name);
const lastName = computed(() => usePage().props.auth.user.last_name)
</script>

<template>
  <UserAvatar :username="firstName + ' ' + lastName" api="initials">
    <slot />
  </UserAvatar>
</template>