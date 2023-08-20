<script setup>
import {onMounted, ref} from "vue";
import {mdiAccountPlus, mdiBallotOutline} from "@mdi/js";
import SectionMain from "@/components/SectionMain.vue";
import CardBox from "@/components/CardBox.vue";
import FormField from "@/components/FormField.vue";
import FormControl from "@/components/FormControl.vue";
import BaseButton from "@/components/BaseButton.vue";
import BaseButtons from "@/components/BaseButtons.vue";
import LayoutAuthenticated from "@/layouts/LayoutAuthenticated.vue";
import SectionTitleLineWithButton from "@/components/SectionTitleLineWithButton.vue";
import {useForm} from "@inertiajs/vue3";
import VueSelect from "vue-select";
import AddCustomer from "./AddCustomer.vue";
import {debounce} from "lodash";
import AddItem from "./AddItem.vue";
import SaleTable from "./SaleTable.vue";
import {fetchFromServer} from "@/helpers.js";

const props = defineProps({
    payment_methods: Object,
})

const saleTable = ref(null);

const items = ref([]);

const customerModal = ref(false);

const itemModal = ref(false);

// const customer = ref(null);

const customers = ref({data: []});

const addItemRef = ref(null);

const editItem = ref(null);

const form = useForm({
    customer: '',
    payment_method: props.payment_methods.data[0].label,
    change_given: '',
    notes: '',
});

const submit = () => {
    form.transform((data) => ({
        ...data,
        items: saleTable.value.items,
    }))
        .post(route('sales.store'), {
            onSuccess: () => {
                form.reset();
                saleTable.value.reset();
            }
        })
};

function addCustomer(data) {
    customers.value.data.push(data);
    form.customer = data;
}

const fetchCustomers = debounce((search, loading) => fetchFromServer(search, loading, route('customers.index')).then(r=>customers.value = r), 500);

onMounted(() => {
    fetchCustomers('', ()=>{});
});
function addItem(item) {
    saleTable.value.addItem(item);
}

function edit(item) {
    editItem.value = item;
    itemModal.value = true;
}

</script>

<template>
    <LayoutAuthenticated>
        <SectionMain>
            <SectionTitleLineWithButton :icon="mdiBallotOutline" main title="Welcome to the Point of Sale">
            </SectionTitleLineWithButton>

            <AddCustomer ref="customer" v-model="customerModal" @confirm="addCustomer"/>

            <AddItem v-model="itemModal" @confirm="addItem" ref="addItemRef" :edit-item="editItem"/>

            <CardBox :is-form="true" @submit.prevent="submit">

                <FormField>
                    <FormField label="Customer">
                        <div class="grid grid-cols-6 gap-2">
                            <VueSelect v-model="form.customer" :filterable="false" :options="customers.data"
                                       class="col-span-5" label="name" @search="fetchCustomers">
                                <template #search="{attributes, events}">
                                    <input
                                        :required="!form.customer"
                                        class="vs__search"
                                        v-bind="attributes"
                                        v-on="events"
                                    />
                                </template>
                                <template v-slot:option="option">
                                    <p class="font-bold">{{ option.name }}</p>
                                    <cite>{{ option.phone }}</cite>
                                </template>
                            </VueSelect>
                            <BaseButton :icon="mdiAccountPlus" icon-size="24" @click="customerModal = true;"/>
                        </div>
                    </FormField>

                    <FormField label="Payment Method">
                        <VueSelect v-model="form.payment_method" :options="payment_methods.data" label="label" :reduce="item => item.label">
                            <template #search="{attributes, events}">
                                <input
                                    :required="!form.payment_method"
                                    class="vs__search"
                                    v-bind="attributes"
                                    v-on="events"
                                />
                            </template>
                        </VueSelect>
                    </FormField>
                </FormField>

                <FormField label="Notes">
                    <FormControl v-model="form.notes" type="textarea"/>
                </FormField>

                <template #footer>
                    <BaseButtons>
                        <BaseButton color="info" label="Submit" type="submit"/>
                        <BaseButton color="danger" label="Reset" outline type="reset"/>
                    </BaseButtons>
                </template>
            </CardBox>

            <SectionTitleLineWithButton :icon="mdiBallotOutline" title="Items">
                <BaseButton label="Add Item" @click="itemModal = true"></BaseButton>
            </SectionTitleLineWithButton>

            <SaleTable ref="saleTable" @edit="edit"></SaleTable>
        </SectionMain>
    </LayoutAuthenticated>
</template>
