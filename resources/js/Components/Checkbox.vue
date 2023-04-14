<!-- <script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
    checked: {
        type: [Array, Boolean],
        default: false,
    },
    value: {
        type: String,
        default: null,
    },
});

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit('update:checked', val);
    },
});
</script>


<template>
    <input
        v-model="proxyChecked"
        type="checkbox"
        :value="value"
        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
    >
</template> -->

<script setup>
import { computed, watch } from "vue";
const props = defineProps({
  modelValue: {
    type: [Array, Boolean]
  },
  value: {
    type: [String, Number],
    default: null
  },
  idName: {
    type: String,
    required: false,
  },
  nameGroup: {
    type: String,
    required: false,
  },
    checked: {
        type: Boolean,
        default: false,
    },
  disabled: {
    type: Boolean,
    default: false,
  },
  verticalAlign: {
    type: Boolean,
    default: false,
  },
});

const emit = defineEmits(["update:modelValue"]);

const model = computed({
  get() {
    return props.modelValue;
  },
  set(value) {
    emit("update:modelValue", value);
  },
});

</script>

<template>
  <div class="control" :class="{ 'control--vertical-align': verticalAlign }">
    <div class="relative flex items-start gap-2">
      <div class="flex h-5 items-center">
          <input
            :id="idName"
            :aria-describedby="`${idName}-description`"
            :name="nameGroup"
            type="checkbox"
            v-model="model"
            :value="value"
            :checked="checked"
            :disabled="disabled"
            class="h-4 w-4 rounded border-gray-300 text-green-600 focus:ring-green-500" />
      </div>
      <div class="text-sm">
          <label :for="idName" class="font-medium" :class="disabled ? 'text-gray-500' : 'text-gray-700'">
            <slot />
          </label>
      </div>
    </div>
  </div>
</template>
