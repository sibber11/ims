<script setup>
import { mdiBallotOutline } from "@mdi/js";
import SectionMain from "@/components/SectionMain.vue";
import CardBox from "@/components/CardBox.vue";
import FormField from "@/components/FormField.vue";
import FormControl from "@/components/FormControl.vue";
import BaseButton from "@/components/BaseButton.vue";
import BaseButtons from "@/components/BaseButtons.vue";
import LayoutAuthenticated from "@/layouts/LayoutAuthenticated.vue";
import SectionTitleLineWithButton from "@/components/SectionTitleLineWithButton.vue";
import { onMounted } from "vue";
import { useForm } from "@inertiajs/vue3";
import { useMainStore } from "@/stores/main.js";
import {setData} from '@/helpers.js'
import { computed } from "vue";

const props = defineProps({
    brand: {
        type: Object,
        default: null
    }
})

const mainStore = useMainStore();

const form = useForm({
    title: '',
    summary: '',
    content: ''
});

const submit = () => {
    form.post(route('brand.store'), {
        onSuccess: () => {
            form.reset();
            mainStore.unDismissNotification();
        }
    })
};

onMounted(() => {
    if (props.brand) {
        setData(form,props.brand);
    }
});

const title = computed(()=>{
    return !props.brand? 'Create Brand':'Edit Brand';
})

</script>

<template>
    <LayoutAuthenticated>
        <SectionMain>
            <SectionTitleLineWithButton :icon="mdiBallotOutline" :title="title" main>
            </SectionTitleLineWithButton>
            <CardBox :is-form="true" @submit.prevent="submit">

                <FormField label="Brand Name" :error="form.errors.title">
                    <FormControl v-model="form.title" placeholder="Enter Brand Name..." />
                </FormField>

                <FormField label="Summary" :error="form.errors.summary">
                    <FormControl v-model="form.summary" placeholder="Enter summary..." />
                </FormField>

                <FormField label="Content" :error="form.errors.content">
                    <FormControl v-model="form.content" placeholder="Enter content..." />
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
