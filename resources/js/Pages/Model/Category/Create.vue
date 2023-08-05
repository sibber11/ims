<script setup>
import { ref } from "vue";
import { mdiBallotOutline } from "@mdi/js";
import SectionMain from "@/components/SectionMain.vue";
import CardBox from "@/components/CardBox.vue";
import FormField from "@/components/FormField.vue";
import FormControl from "@/components/FormControl.vue";
import BaseButton from "@/components/BaseButton.vue";
import BaseButtons from "@/components/BaseButtons.vue";
import LayoutAuthenticated from "@/layouts/LayoutAuthenticated.vue";
import SectionTitleLineWithButton from "@/components/SectionTitleLineWithButton.vue";
import { computed } from "vue";
import { kebabCase } from 'lodash/string';
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    categories: {
        type: Object,
        default: []
    }
})

const form = useForm({
    title: "",
    parent_id: '',
    meta_title: '',
    content: ''
});
const slug = computed(()=>kebabCase(form.title));

const submit = () => {
    form.post(route('category.store'))
};

</script>

<template>
    <LayoutAuthenticated>
        <SectionMain>
            <SectionTitleLineWithButton :icon="mdiBallotOutline" title="Create Category" main>
            </SectionTitleLineWithButton>
            <CardBox :is-form="true" @submit.prevent="submit">
                <FormField label="Category Name" :error="form.errors.title">
                    <FormControl v-model="form.title" placeholder="Enter Category Name..." />
                </FormField>

                <FormField label="Slug">
                    <FormControl v-model="slug" disabled />
                </FormField>

                <FormField label="Meta Title" :error="form.errors.meta_title">
                    <FormControl v-model="form.meta_title" disabled />
                </FormField>

                <FormField label="Content" :error="form.errors.content">
                    <FormControl v-model="form.content" disabled />
                </FormField>


                <FormField label="Parent" :error="form.errors.parent_id">
                    <FormControl v-model="form.parent_id" :options="categories.data" />
                </FormField>

                <template #footer>
                    <BaseButtons>
                        <BaseButton type="submit" color="info" label="Submit" />
                        <BaseButton type="reset" color="danger" outline label="Reset" />
                    </BaseButtons>
                </template>
            </CardBox>
        </SectionMain>
    </LayoutAuthenticated>
</template>
