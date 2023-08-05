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
            <SectionTitleLineWithButton :icon="mdiTableBorder" title="Categories" main>
            </SectionTitleLineWithButton>
            <CardBox class="mb-6" has-table>
                <TableModel :resources="resources" checkable route-name="category"/>
            </CardBox>
        </SectionMain>
    </LayoutAuthenticated>
</template>
