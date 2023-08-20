<script setup>
import {mdiTableBorder,} from "@mdi/js";
import SectionMain from "@/components/SectionMain.vue";
import CardBox from "@/components/CardBox.vue";
import LayoutAuthenticated from "@/layouts/LayoutAuthenticated.vue";
import SectionTitleLineWithButton from "@/components/SectionTitleLineWithButton.vue";
import TableModel from "@/components/TableModel.vue";
import BaseButton from "@/components/BaseButton.vue";
import {computed} from "vue";

const props = defineProps({
    resources: {
        type: Object,
        required: true,
    }
})
const headers = computed(() => {
    if (props.resources.data?.length === 0) {
        return [];
    }
    let keys = Object.keys(props.resources.data[0]);
    keys = keys.map((key) => {
        return {field: key, key: key, title: key};
    });
    return keys;
});

</script>

<template>
    <LayoutAuthenticated>
        <SectionMain>
            <SectionTitleLineWithButton :icon="mdiTableBorder" main title="Order">
                <BaseButton color="info" label="Create Order" rounded-full route-name="order.create"/>
                <!--                <BaseButton label="Delete Brands" color="danger" rounded-full @click="delete_all"/>-->

            </SectionTitleLineWithButton>
            <CardBox class="mb-6 overflow-x-auto" has-table>
                <TableModel :resources="resources" checkable route-name="order" has-show/>
            </CardBox>

        </SectionMain>
    </LayoutAuthenticated>
</template>
