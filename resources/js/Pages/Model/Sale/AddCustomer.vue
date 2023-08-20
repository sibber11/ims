<script setup>
import FormField from "@/components/FormField.vue";
import FormControl from "@/components/FormControl.vue";
import {computed, reactive} from "vue";
import {mdiClose} from "@mdi/js";
import BaseButton from "@/components/BaseButton.vue";
import BaseButtons from "@/components/BaseButtons.vue";
import CardBox from "@/components/CardBox.vue";
import OverlayLayer from "@/components/OverlayLayer.vue";
import CardBoxComponentTitle from "@/components/CardBoxComponentTitle.vue";

const props = defineProps({
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

const confirmCancel = (mode,data) => {
    value.value = false;
    emit(mode,data);
};

const confirm = () => {
    axios.post(route('customers.store'), form)
        .then(r=>{
        confirmCancel('confirm', r.data.data);
    });
};

const cancel = () => confirmCancel("cancel");

window.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && value.value) {
        cancel();
    }
});

const initial = {
    name: "",
    email: "",
    phone: ""
};

const form = reactive({...initial});

function reset() {
    Object.assign(form, initial);
}

defineExpose({form, reset});

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
                <FormField label="Name">
                    <FormControl v-model="form.name" placeholder="Enter name of customer" type="text" name="name"/>
                </FormField>
                <FormField label="Email">
                    <FormControl v-model="form.email" class="w-full" placeholder="Enter customer email" type="email"/>
                </FormField>

                <FormField label="Phone">
                    <FormControl v-model="form.phone" class="w-full" placeholder="Enter phone number" name="phone"/>
                </FormField>
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
