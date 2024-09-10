<template>
  <a-select
      v-model:value="value"
      :placeholder="placeholder"
      :options="options"
      :show-search="true"
      :default-active-first-option="false"
      :show-arrow="false"
      :filter-option="false"
      :not-found-content="null"
      @select="onSelect"
      @search="onSearch"
  >
  </a-select>
</template>

<script setup>
import {onMounted, ref} from 'vue';
import axios from "axios";
import { _ } from "lodash"

const value = defineModel('value')
const props = defineProps({
  placeholder: {
    type: String,
    default: 'Input here'
  },
  apiRoute: {
    type: String,
    required: true
  },
  initValue: null
})
const options = ref([])

const onSearch = _.debounce( (searchText) => {
  if(searchText !== ''){
    const params = {search: searchText, page: 1, per_page: 5}
    axios.get(props.apiRoute, {params})
        .then((data) => {
          options.value = data.data.data.map(val => {
            return {
              label: val.designation,
              value: val.id
            }
          })
        })
        .catch((error) => {
          console.log(error)
        })
  }
  else {
    options.value = []
  }
}, 300)

const onSelect = value => {
  // emit('onValueChange', value)
};

onMounted(() => {
  if(props.initValue){
    options.value = [props.initValue]
  }
})

</script>

<style scoped>

</style>