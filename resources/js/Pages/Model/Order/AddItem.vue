<script setup>
import FormField from "@/components/FormField.vue";
import FormControl from "@/components/FormControl.vue";
import VueSelect from "vue-select";
import {computed, reactive} from "vue";
import {mdiClose} from "@mdi/js";
import BaseButton from "@/components/BaseButton.vue";
import BaseButtons from "@/components/BaseButtons.vue";
import CardBox from "@/components/CardBox.vue";
import OverlayLayer from "@/components/OverlayLayer.vue";
import CardBoxComponentTitle from "@/components/CardBoxComponentTitle.vue";

const props = defineProps({
    products: Object,
    brands: Object,
    suppliers: Object,
    hasCancel: {
        type: Boolean,
        default: true,
    },
    modelValue: {
        type: [String, Number, Boolean],
        default: null,
    },
});

const emit = defineEmits(["update:modelValue", "cancel", "confirm"]);

const value = computed({
    get: () => props.modelValue,
    set: (value) => emit("update:modelValue", value),
});

const confirmCancel = (mode) => {
    value.value = false;
    emit(mode);
};

const confirm = () => confirmCancel("confirm");

const cancel = () => confirmCancel("cancel");

window.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && value.value) {
        cancel();
    }
});

const initial = {
    // stock: '',
    retail_price: '',
    discount: '',
    price: '',
    quantity_received: '',
    // sold: '',
    // available: '',
    defective: '',
    product_id: '',
    brand_id: '',
    supplier_id: ''
};

const form = reactive({...initial})

function reset() {
    Object.assign(form, initial);
}

defineExpose({form, reset})

</script>

<template>
    <OverlayLayer v-show="value" @overlay-click="cancel">
        <CardBox
            v-show="value"
            class="shadow-lg max-h-modal w-11/12 md:w-4/5 lg:w-3/5 xl:w-3/5 z-50 overflow-y-auto"
            is-form
            @submit.prevent="confirm"
        >
            <CardBoxComponentTitle title="Add Item">
                <BaseButton
                    v-if="hasCancel"
                    :icon="mdiClose"
                    color="whiteDark"
                    rounded-full
                    small
                    @click.prevent="cancel"
                />
            </CardBoxComponentTitle>

            <div class="space-y-3">
                <FormField>
                    <FormField label="Supplier" class="mb-0">
                        <VueSelect aria-required="true" v-model="form.supplier_id" :options="suppliers.data" required>
                            <template #search="{attributes, events}">
                                <input
                                    class="vs__search"
                                    :required="!form.supplier_id"
                                    v-bind="attributes"
                                    v-on="events"
                                />
                            </template>
                        </VueSelect>
                    </FormField>
                    <FormField label="Brand">
                        <VueSelect v-model="form.brand_id" :options="brands.data" required>
                            <template #search="{attributes, events}">
                                <input
                                    class="vs__search"
                                    :required="!form.brand_id"
                                    v-bind="attributes"
                                    v-on="events"
                                />
                            </template>
                        </VueSelect>
                    </FormField>
                </FormField>

                <FormField label="Product">
                    <VueSelect v-model="form.product_id" :options="products.data" required>
                        <template #search="{attributes, events}">
                            <input
                                class="vs__search"
                                :required="!form.product_id"
                                v-bind="attributes"
                                v-on="events"
                            />
                        </template>
                    </VueSelect>
                </FormField>

                <FormField>
                    <FormField label="Stock" label2="Defective">
                        <FormControl v-model="form.quantity_received" placeholder="Enter quantity_received..." required
                                     type="number"/>
                    </FormField>

                    <FormField label="Defective">
                        <FormControl v-model="form.defective" placeholder="Enter defective..." required type="number"/>
                    </FormField>
                </FormField>

                <FormField>
                    <FormField label="Price">
                        <FormControl v-model="form.price" placeholder="Enter price..." required type="number"/>
                    </FormField>

                    <FormField label="Max Retail Price">
                        <FormControl v-model="form.retail_price" placeholder="Enter retail_price..." required
                                     type="number"/>
                    </FormField>
                </FormField>

                <FormField label="Discounted by Supplier">
                    <FormControl v-model="form.discount" placeholder="Enter discount..." required type="number"/>
                </FormField>

                <!-- <FormField label="discount"></FormField> -->

                <!-- <FormField label="sold">
                <FormControl v-model="form.sold" placeholder="Enter sold..." type="number" />
                <FormControl v-model="form.available" placeholder="Enter available..." type="number" />
            </FormField> -->

                <!-- <FormField label="available"></FormField> -->
            </div>

            <template #footer>
                <BaseButtons>
                    <BaseButton color="success" label="Add" type="submit"/>
                    <BaseButton
                        v-if="hasCancel"
                        color="danger"
                        label="Cancel"
                        outline
                        @click="cancel"
                    />
                </BaseButtons>
            </template>
        </CardBox>
    </OverlayLayer>
</template>
