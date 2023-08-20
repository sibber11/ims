<script setup>
import FormField from "@/components/FormField.vue";
import FormControl from "@/components/FormControl.vue";
import VueSelect from "vue-select";
import { computed, onMounted, ref } from "vue";
import { mdiClose } from "@mdi/js";
import BaseButton from "@/components/BaseButton.vue";
import BaseButtons from "@/components/BaseButtons.vue";
import CardBox from "@/components/CardBox.vue";
import OverlayLayer from "@/components/OverlayLayer.vue";
import CardBoxComponentTitle from "@/components/CardBoxComponentTitle.vue";
import { fetchFromServer } from "@/helpers.js";
import { debounce } from "lodash";

const props = defineProps({
    hasCancel: {
        type: Boolean,
        default: true,
    },
    modelValue: {
        type: [String, Number, Boolean],
        default: null,
    }
});

const emit = defineEmits(["update:modelValue", "cancel", "confirm"]);

const value = computed({
    get: () => props.modelValue,
    set: (value) => emit("update:modelValue", value),
});
const confirmCancel = (mode) => {
    value.value = false;
    emit(mode, { ...form.value });
    reset();
};

const confirm = () => confirmCancel("confirm");

const cancel = () => confirmCancel("cancel");

window.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && value.value) {
        cancel();
    }
});

const initial = {
    product: '',
    price: '',
    discount: '',
    quantity: '',
    content: '',
};

const form = ref({ ...initial })

function reset() {
    Object.assign(form.value, initial);
}

const products = ref({});

onMounted(() => {


    fetchProducts('', () => {
    });
});

const fetchProducts = debounce((search, loading) => fetchFromServer(search, loading, route('products.index')).then(r => products.value = r), 500);

</script>

<template>
    <OverlayLayer v-show="value" @overlay-click="cancel">
        <CardBox v-show="value" class="shadow-lg max-h-modal w-11/12 md:w-4/5 lg:w-3/5 xl:w-3/5 z-50 overflow-y-auto"
            is-form @submit.prevent="confirm">
            <CardBoxComponentTitle title="Add Item">
                <BaseButton v-if="hasCancel" :icon="mdiClose" color="whiteDark" rounded-full small
                    @click.prevent="cancel" />
            </CardBoxComponentTitle>

            <!--            {{ suppliers }}-->
            <div class="space-y-3">
                <FormField>
                    <FormField label="Product">
                        <VueSelect v-model="form.product" :filterable="false" :options="products.data" label="title"
                            required @search="fetchProducts"
                            :reduce="item => ({ id: item.id, title: item.title, price: item })">
                            <template #search="{ attributes, events }">
                                <input :required="!form.product" class="vs__search" v-bind="attributes" v-on="events" />
                            </template>
                        </VueSelect>
                    </FormField>
                    <FormField>
                        <FormField label="Price">
                            <FormControl v-model="form.product.retail_price" disabled />
                        </FormField>
                        <FormField label="Quantity">
                            <FormControl v-model="form.quantity" placeholder="Enter quantity" required type="number" />
                        </FormField>
                    </FormField>
                </FormField>

                <FormField>
                    <FormField label="Discount">
                        <FormControl v-model="form.discount" placeholder="Enter discount..." required type="number" />
                    </FormField>
                    {{ form.product }}
                </FormField>
                <FormField label="Content">
                    <FormControl type="textarea" v-model="form.content" />
                </FormField>


            </div>

            <template #footer>
                <BaseButtons>
                    <BaseButton color="success" label="Add" type="submit" />
                    <BaseButton v-if="hasCancel" color="danger" label="Cancel" outline @click="cancel" />
                </BaseButtons>
            </template>
        </CardBox>
    </OverlayLayer>
</template>
