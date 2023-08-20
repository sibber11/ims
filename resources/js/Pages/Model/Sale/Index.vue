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
            <SectionTitleLineWithButton :icon="mdiTableBorder" title="Sale" main>
                <BaseButton route-name="sales.create" label="Point of Sale" color="info" rounded-full/>
            </SectionTitleLineWithButton>
            <CardBox class="mb-6" has-table>
                <TableModel :resources="resources" route-name="sales" v-if="resources.data.length"/>
                <p class="m-6 text-center text-lg font-bold" v-else>There is no data.</p>
            </CardBox>
        </SectionMain>
    </LayoutAuthenticated>
</template>
