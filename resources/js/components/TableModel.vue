<script setup>
import { computed, ref } from "vue";
import { mdiTrashCan } from "@mdi/js";
import CardBoxModal from "@/components/CardBoxModal.vue";
import TableCheckboxCell from "@/components/TableCheckboxCell.vue";
import BaseLevel from "@/components/BaseLevel.vue";
import BaseButtons from "@/components/BaseButtons.vue";
import BaseButton from "@/components/BaseButton.vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
  checkable: Boolean,
  resources: Object,
  routeName: {
    type: String,
    required: true
  },
  label:{
    type: String,
    required: false
  }
});

const confirmDelete = ref(false);

const checkedRows = ref([]);

const numPages = computed(() => props.resources.meta.total);

const currentPageHuman = computed(() => props.resources.meta.current_page);

const pagesList = computed(() => {
  return props.resources.meta.links;
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
  if (props.resources.data.length == 0) {
    return [];
  }
  return Object.keys(props.resources.data[0]);
});

const selectedModel= ref(null);


/* try to find the label of the model if not provided */
const modelNames = ['name', 'title', 'label'];

const modelLabel = computed(()=>{
  if (props.label) {
    return props.label;
  }
  if (!props.resources.data[0]) {
    return modelNames[0];
  }
  const keys = Object.keys(props.resources.data[0]);
  return keys.find(v=>modelNames.includes(v));
})
console.log(modelLabel.value);
</script>

<template>
    <CardBoxModal v-model="confirmDelete" v-if="selectedModel" title="Please confirm" button="danger" has-cancel @confirm="destroy">
    <p>Are you sure you want to delete <b>{{ selectedModel.title }}</b></p>
    <p>Click delete button to proceed.</p>
  </CardBoxModal>

  <div v-if="checkedRows.length" class="p-3 bg-gray-100/50 dark:bg-slate-800">
    <span v-for="checkedRow in checkedRows" :key="checkedRow.id"
      class="inline-block px-2 py-1 rounded-sm mr-2 text-sm bg-gray-100 dark:bg-slate-700">
      {{ checkedRow[modelLabel] }}
    </span>
  </div>

  <table>
    <thead>
      <tr>
        <th v-if="checkable" />
        <th v-for="item in headers" :key="item">
          {{ item }}
        </th>
        <th />
      </tr>
    </thead>
    <tbody>
      <tr v-for="item in resources.data" :key="item.id">
        <TableCheckboxCell v-if="checkable" @checked="checked($event, item)" />
        <td :data-label="key" v-for="(value, key) in item">
          {{ value }}
        </td>
        <td class="before:hidden lg:w-1 whitespace-nowrap">
          <BaseButtons type="justify-start lg:justify-end" no-wrap>
            <!-- <BaseButton color="info" :icon="mdiEye" small @click="isModalActive = true" /> -->
            <BaseButton color="danger" :icon="mdiTrashCan" small
              @click="confirmDelete = true; selectedModel = item;" />
          </BaseButtons>
        </td>
      </tr>
    </tbody>
  </table>
  <div class="p-3 lg:px-6 border-t border-gray-100 dark:border-slate-800">
    <BaseLevel>
      <BaseButtons>

        <BaseButton v-for="page in pagesList" :label="page.label" :href="page.url" html color="lightDark"
          :active="page.active" />
      </BaseButtons>
      <small>Page {{ currentPageHuman }} of {{ numPages }}</small>
    </BaseLevel>
  </div>
</template>
