<script setup>
import { computed, ref } from "vue";
import { mdiTrashCan } from "@mdi/js";
import CardBoxModal from "@/components/CardBoxModal.vue";
import TableCheckboxCell from "@/components/TableCheckboxCell.vue";
import BaseButtons from "@/components/BaseButtons.vue";
import BaseButton from "@/components/BaseButton.vue";

const props = defineProps({
  checkable: Boolean,
  resources: Object,
  label: {
    type: String,
    required: false
  }
});

const confirmDelete = ref(false);

const checkedRows = ref([]);

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
  //todo
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
  if (!props.resources.data) {
    return [];
  }
  return Object.keys(props.resources.data[0]);
});

const selectedModel = ref(null);


/* try to find the label of the model if not provided */
const modelNames = ['name', 'title', 'label', 'username'];

const modelLabel = computed(() => {
  if (props.label) {
    return props.label;
  }
  if (!props.resources.data) {
    return modelNames[0];
  }
  const keys = Object.keys(props.resources.data[0]);
  return keys.find(v => modelNames.includes(v));
})
console.log(modelLabel.value);
</script>

<template>
  <CardBoxModal v-model="confirmDelete" v-if="selectedModel" title="Please confirm" button="danger" has-cancel
    @confirm="destroy">
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
          {{ value.title || value.username || value }}
        </td>
        <td class="before:hidden lg:w-1 whitespace-nowrap">
          <BaseButtons type="justify-start lg:justify-end" no-wrap>
            <!-- <BaseButton color="info" :icon="mdiEye" small @click="isModalActive = true" /> -->
            <BaseButton color="danger" :icon="mdiTrashCan" small @click="confirmDelete = true; selectedModel = item;" />
          </BaseButtons>
        </td>
      </tr>
    </tbody>
  </table>
</template>
