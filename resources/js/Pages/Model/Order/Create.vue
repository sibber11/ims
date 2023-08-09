<script setup>
import {mdiBallotOutline, mdiTrashCan} from "@mdi/js";
import SectionMain from "@/components/SectionMain.vue";
import CardBox from "@/components/CardBox.vue";
import FormField from "@/components/FormField.vue";
import FormControl from "@/components/FormControl.vue";
import BaseButton from "@/components/BaseButton.vue";
import BaseButtons from "@/components/BaseButtons.vue";
import LayoutAuthenticated from "@/layouts/LayoutAuthenticated.vue";
import SectionTitleLineWithButton from "@/components/SectionTitleLineWithButton.vue";
import {computed, ref} from "vue";
import {kebabCase, startCase} from 'lodash/string';
import {useForm} from "@inertiajs/vue3";
import {useMainStore} from "@/stores/main.js";
import AddItem from "./AddItem.vue";
import BaseDivider from "@/components/BaseDivider.vue";

const props = defineProps({
    products: Object,
    brands: Object,
    suppliers: Object
})

const mainStore = useMainStore();

const items = ref([{
    "retail_price": 38,
    "discount": 5,
    "price": 110,
    "quantity_received": 89,
    "defective": 39,
    "product_id": {"id": 3, "label": "repudiandae"},
    "brand_id": {"id": 2, "label": "et"},
    "supplier_id": {"id": 61, "label": "verda.oberbrunner"}
}, {
    "retail_price": 52,
    "discount": 4,
    "price": 46,
    "quantity_received": 63,
    "defective": 69,
    "product_id": {"id": 3, "label": "repudiandae"},
    "brand_id": {"id": 7, "label": "consequatur"},
    "supplier_id": {"id": 60, "label": "vandervort.pearline"}
}, {
    "retail_price": 70,
    "discount": 5,
    "price": 55,
    "quantity_received": 50,
    "defective": 5,
    "product_id": {"id": 4, "label": "ducimus"},
    "brand_id": {"id": 7, "label": "consequatur"},
    "supplier_id": {"id": 62, "label": "qprosacco"}
}]);

const total = computed(() => {
    return items.value.reduce((acc, item) => {
        return acc + ((item.price - item.discount) * item.quantity_received);
    }, 0);
});

const grand_total = computed(() => {
    return Math.round(total.value + (total.value * form.tax / 100) + form.shipping - form.promo_discount);
});

const form = useForm({
    type: 'purchase',
    promo: '',
    promo_discount: 0,
    tax: 0,
    shipping: 0,
    content: '',
});
const slug = computed(() => kebabCase(form.title));

const submit = () => {
    form.transform((data) => ({
        ...data,
        items: items.value,
    }))
        .post(route('order.store'), {
            onSuccess: () => {
                form.reset();
                resetItems();
                mainStore.unDismissNotification();
            }
        })
};

const createItemModal = ref(false);

const currentItem = ref(null);

function addItem() {
    // console.log(!some(currentItem.value.form, isEmpty));
    // console.log({ ...currentItem.value.form });
    // if (!some(currentItem.value.form, isEmpty)) {

    // }
    items.value.push({...currentItem.value.form});

    currentItem.value.reset();
}

function remove(item) {
    items.value = items.value.filter(el => el !== item);
}

function resetItems() {
    items.value = [];
}

function keyName(key) {
    return startCase(key.replace('id', ''));
}

</script>

<template>
    <LayoutAuthenticated>
        <SectionMain>

            <AddItem ref="currentItem" v-model="createItemModal" v-bind="$props" @confirm="addItem"/>

            <SectionTitleLineWithButton :icon="mdiBallotOutline" main title="Create Order">
                <BaseButton label="Add Item" @click="createItemModal = true"/>
            </SectionTitleLineWithButton>
            <CardBox :is-form="true" @submit.prevent="submit">
                <!-- <FormField label="Brand">
                    <VueSelect v-model="form.brand_id" :options="brands" label="title" :reduce="brand => brand.id" />
                </FormField> -->

                <FormField>
                    <FormField label="Discount" :error="form.errors.promo">
                        <FormControl v-model="form.promo" placeholder="Promo code..."/>
                    </FormField>
                    <FormField label="Promo Discount" :error="form.errors.promo_discount">
                        <FormControl v-model="form.promo_discount" placeholder="Promo discount..." type="number"/>
                    </FormField>
                </FormField>

                <FormField>
                    <FormField label="Tax" :error="form.errors.tax">
                        <FormControl v-model="form.tax" placeholder="Tax..." type="number"/>
                    </FormField>
                    <FormField label="Shipping" :error="form.errors.shipping">
                        <FormControl v-model="form.shipping" placeholder="Shipping..." type="number"/>
                    </FormField>
                </FormField>

                <FormField>
                    <FormField label="Total">
                        <FormControl v-model="total" disabled placeholder="Total..." type="number"/>
                    </FormField>
                    <FormField label="Grand Total">
                        <FormControl v-model="grand_total" disabled placeholder="Grand total..." type="number"/>
                    </FormField>
                </FormField>

                <FormField label="Content" :error="form.errors.content">
                    <FormControl v-model="form.content" placeholder="Content..." type="textarea"/>
                </FormField>

                <BaseDivider></BaseDivider>

                <table v-if="items">
                    <thead>
                    <tr>
                        <th v-for="(value, key) in items[0]">
                            {{ keyName(key) }}
                        </th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in items" :key="item">
                        <td v-for="(value, key) in item" :data-label="keyName(key)" class="text-sm">
                            <span v-if="typeof value == 'object'">{{ value.label }}</span>
                            <span v-else>{{ value }}</span>
                        </td>
                        <td>
                            <BaseButton :icon="mdiTrashCan" color="danger" outline small @click="remove(item)"/>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <template #footer>
                    <BaseButtons>
                        <BaseButton color="info" label="Submit" type="submit"/>
                        <BaseButton color="danger" label="Reset" outline type="reset" @click="resetItems()"/>
                    </BaseButtons>
                </template>
            </CardBox>
        </SectionMain>
    </LayoutAuthenticated>
</template>

<style scoped>
:deep() {
    --vs-controls-color: #664cc3;
    --vs-border-color: #664cc3;

    --vs-dropdown-bg: #282c34;
    --vs-dropdown-color: #cc99cd;
    --vs-dropdown-option-color: #cc99cd;

    --vs-selected-bg: #664cc3;
    --vs-selected-color: #eeeeee;

    --vs-search-input-color: #eeeeee;

    --vs-dropdown-option--active-bg: #664cc3;
    --vs-dropdown-option--active-color: #eeeeee;
}
</style>
