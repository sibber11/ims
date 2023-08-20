<script setup>
import {computed, onMounted} from "vue";
import {mdiBallotOutline} from "@mdi/js";
import SectionMain from "@/components/SectionMain.vue";
import CardBox from "@/components/CardBox.vue";
import FormField from "@/components/FormField.vue";
import FormControl from "@/components/FormControl.vue";
import BaseButton from "@/components/BaseButton.vue";
import BaseButtons from "@/components/BaseButtons.vue";
import LayoutAuthenticated from "@/layouts/LayoutAuthenticated.vue";
import SectionTitleLineWithButton from "@/components/SectionTitleLineWithButton.vue";
import {kebabCase} from 'lodash/string';
import {useForm} from "@inertiajs/vue3";
import {useMainStore} from "@/stores/main.js";
import { setData } from "@/helpers";

const props = defineProps({
    item: {
        type: Object,
        default: () => ({})
    }
})

const mainStore = useMainStore();

const form = useForm({
    stock: '',
    retail_price: '',
    discount: '',
    price: '',
    quantity_received: '',
    sold: '',
    available: '',
    defective: '',
});
const slug = computed(() => kebabCase(form.title));

const submit = () => {
    if (props.item){
        form.patch(route('item.update', props.item), {
            onSuccess: () => {
                // form.reset();
                mainStore.unDismissNotification();
            }
        })
    }else{
        form.post(route('item.store'), {
            onSuccess: () => {
                form.reset();
                mainStore.unDismissNotification();
            }
        });
    }
};

onMounted(() => {
    if (props.item) {
        setData(form, props.item);
    }
});

const title = computed(()=>!props.item?'Create Item':'Edit Item');


</script>

<template>
    <LayoutAuthenticated>
        <SectionMain>
            <SectionTitleLineWithButton :icon="mdiBallotOutline" main :title="title">
            </SectionTitleLineWithButton>
            <CardBox is-form @submit.prevent="submit">

                <FormField>
                    <FormField :error="form.errors.stock" label="Stock">
                        <FormControl v-model="form.stock" placeholder="Enter stock..." type="number"/>
                    </FormField>

                    <FormField :error="form.errors.quantity_received" label="quantity_received">
                        <FormControl v-model="form.quantity_received" placeholder="Enter quantity_received..."
                                     type="number"/>
                    </FormField>
                </FormField>

                <FormField :error="form.errors.defective" label="defective">
                    <FormControl v-model="form.defective" placeholder="Enter defective..." type="number"/>
                </FormField>

                <FormField :error="form.errors.price" label="price">
                    <FormControl v-model="form.price" placeholder="Enter price..." type="number"/>
                </FormField>

                <FormField :error="form.errors.retail_price" label="retail_price">
                    <FormControl v-model="form.retail_price" placeholder="Enter retail_price..." type="number"/>
                </FormField>

                <FormField :error="form.errors.discount" label="discount">
                    <FormControl v-model="form.discount" placeholder="Enter discount..." type="number"/>
                </FormField>

                <FormField :error="form.errors.sold" label="sold">
                    <FormControl v-model="form.sold" placeholder="Enter sold..." type="number"/>
                </FormField>

                <FormField :error="form.errors.available" label="available">
                    <FormControl v-model="form.available" placeholder="Enter available..." type="number"/>
                </FormField>

                <template #footer>
                    <BaseButtons>
                        <BaseButton :label="item?'Update':'Save'" color="info" type="submit"/>
                        <BaseButton color="danger" label="Reset" outline type="reset"/>
                    </BaseButtons>
                </template>
            </CardBox>
        </SectionMain>
    </LayoutAuthenticated>
</template>
