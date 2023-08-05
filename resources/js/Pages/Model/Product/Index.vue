<script setup>
import {
    mdiMonitorCellphone,
    mdiTableBorder,
    mdiTableOff,
    mdiGithub,
} from "@mdi/js";
import SectionMain from "@/components/SectionMain.vue";
import CardBox from "@/components/CardBox.vue";
import LayoutAuthenticated from "@/layouts/LayoutAuthenticated.vue";
import SectionTitleLineWithButton from "@/components/SectionTitleLineWithButton.vue";
import TableModel from "@/components/TableModel.vue";
import BaseButton from "@/components/BaseButton.vue";

const props = defineProps({
    resources: {
        type: Object,
        required: true,
    }
})
</script>

<template>
    <LayoutAuthenticated>
        <SectionMain>
            <SectionTitleLineWithButton :icon="mdiTableBorder" title="Product" main>
                <BaseButton route-name="product.create" label="Create Product" color="info"/>
            </SectionTitleLineWithButton>
            <CardBox class="mb-6" has-table>
                <TableModel :resources="resources" checkable route-name="product"/>
            </CardBox>
        </SectionMain>
    </LayoutAuthenticated>
</template>
