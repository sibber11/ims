<script setup>
import {computed, ref} from "vue";
import {mdiEye, mdiPen, mdiTrashCan} from "@mdi/js";
import CardBoxModal from "@/components/CardBoxModal.vue";
import TableCheckboxCell from "@/components/TableCheckboxCell.vue";
import BaseLevel from "@/components/BaseLevel.vue";
import BaseButtons from "@/components/BaseButtons.vue";
import BaseButton from "@/components/BaseButton.vue";
import {router} from "@inertiajs/vue3";

const props = defineProps({
    checkable: Boolean,
    resources: Object,
    routeName: {
        type: String,
        required: true
    },
    label: {
        type: String,
        required: false
    },
    hasShow: Boolean,
    hasEdit: Boolean
});

const confirmDelete = ref(false);

const checkedRows = ref([]);

const numPages = computed(() => props.resources.meta?.last_page);
// console.log(props.resources.meta);
const currentPageHuman = computed(() => props.resources.meta?.current_page);

const pagesList = computed(() => {
    return props.resources.meta?.links;
});

const remove = (arr, cb) => {
    const newArr = [];

    arr.forEach((item) => {
        if (!cb(item)) {
            newArr.push(item);
        }
    });

    return newArr;
};

const destroy = () => {
    if (checkedRows.value.length) {
        checkedRows.value.forEach((item) => {
            router.delete(route(props.routeName + '.destroy', item.id));
        });
        checkedRows.value = [];
        return;
    }
    if (!selectedModel.value) {
        return;
    }
    router.delete(route(props.routeName + '.destroy', selectedModel.value));
};

const checked = (isChecked, item) => {
    if (isChecked) {
        checkedRows.value.push(item);
    } else {
        checkedRows.value = remove(
            checkedRows.value,
            (row) => row.id === item.id
        );
    }
};
/* automatically get the head name of the tables */
const headers = computed(() => {
    if (props.resources.data?.length === 0) {
        return [];
    }
    return Object.keys(props.resources.data[0]);
});

const selectedModel = ref(null);


/* try to find the label of the model if not provided */
const modelNames = ['username', 'name', 'title', 'label', 'email', 'slug', 'id'];

const modelLabel = computed(() => {
    if (props.label) {
        return props.label;
    }
    if (!props.resources.data[0]) {
        return modelNames[0];
    }
    const keys = Object.keys(props.resources.data[0]);
    return keys.find(v => modelNames.includes(v));
})
</script>

<template>
    <CardBoxModal v-if="selectedModel" v-model="confirmDelete" button="danger" has-cancel title="Please confirm"
                  @confirm="destroy">
        <p>Are you sure you want to delete <b>{{ selectedModel.title }}</b></p>
        <p>Click delete button to proceed.</p>
    </CardBoxModal>

    <div v-if="checkedRows.length" class="p-3 bg-gray-100/50 dark:bg-slate-800">
    <span v-for="checkedRow in checkedRows" :key="checkedRow.id"
          class="inline-block px-2 py-1 rounded-sm mr-2 text-sm bg-gray-100 dark:bg-slate-700">
      {{ checkedRow[modelLabel] }}
    </span>
        <BaseButton :icon="mdiTrashCan" color="danger" small
                    @click="confirmDelete = true; selectedModel = checkedRows;"/>
    </div>

    <table>
        <thead>
        <tr>
            <th v-if="checkable"/>
            <th v-for="item in headers" :key="item">
                {{ item }}
            </th>
            <th/>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in resources.data" :key="item.id">
            <TableCheckboxCell v-if="checkable" @checked="checked($event, item)"/>
            <td v-for="(value, key) in item" :data-label="key" class="text-sm">
                {{ value }}
            </td>
            <td class="before:hidden lg:w-1 whitespace-nowrap">
                <BaseButtons no-wrap type="justify-start lg:justify-end">
                    <!-- <BaseButton color="info" :icon="mdiEye" small @click="isModalActive = true" /> -->
                    <BaseButton :icon="mdiTrashCan" color="danger" small
                                @click="confirmDelete = true; selectedModel = item;"/>
                    <BaseButton v-if="hasShow" :href="route(props.routeName + '.show', item)" :icon="mdiEye" color="success"
                                small/>
                    <BaseButton v-if="hasEdit" :href="route(props.routeName + '.edit', item)" :icon="mdiPen" color="info"
                                small/>
                </BaseButtons>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="p-3 lg:px-6 border-t border-gray-100 dark:border-slate-800">
        <BaseLevel>
            <BaseButtons>

                <BaseButton v-for="page in pagesList" :active="page.active" :href="page.url" :label="page.label" color="lightDark"
                            html/>
            </BaseButtons>
            <small>Page {{ currentPageHuman }} of {{ numPages }}</small>
        </BaseLevel>
    </div>
</template>
