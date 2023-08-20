<script setup>
import { ref } from "vue";
import CardBoxModal from "@/components/CardBoxModal.vue";
import TableCheckboxCell from "@/components/TableCheckboxCell.vue";
import BaseButton from "@/components/BaseButton.vue";
import { mdiPencil, mdiTrashCan } from "@mdi/js";
import BaseButtons from "@/components/BaseButtons.vue";

const emit = defineEmits(['edit']);

const items = ref([]);

const isModalActive = ref(false);

const isModalDangerActive = ref(false);

function addItem(item) {
    items.value.push(item);
}

function reset() {
    items.value = [];
}

defineExpose({ addItem, items, reset });

</script>

<template>
    <CardBoxModal v-model="isModalActive" title="Sample modal">
        <p>Lorem ipsum dolor sit amet <b>adipiscing elit</b></p>
        <p>This is sample modal</p>
    </CardBoxModal>

    <CardBoxModal v-model="isModalDangerActive" button="danger" has-cancel title="Please confirm">
        <p>Lorem ipsum dolor sit amet <b>adipiscing elit</b></p>
        <p>This is sample modal</p>
    </CardBoxModal>


    <div class="rounded-lg bg-gray-900 overflow-auto" v-if="items">
        <table>
            <thead class="">
                <tr>
                    <!--                <th>#</th>-->
                    <th v-for="(value, key) in items[0]">{{ key }}</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in items" :key="index">
                    <!--                <TableCheckboxCell @checked="checked($event, item)"/>-->
                    <td v-for="(value, key) in item" :key="key" :data-label="key">{{ value.title ?? value }}</td>
                    <td>
                        <BaseButtons>
                            <BaseButton color="danger" rounded-lg small @click.prevent="isModalActive = true"
                                :icon="mdiTrashCan">
                            </BaseButton>
                            <BaseButton color="info" rounded-lg small @click.prevent="$emit('edit', item)" :icon="mdiPencil">
                            </BaseButton>
                        </BaseButtons>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
