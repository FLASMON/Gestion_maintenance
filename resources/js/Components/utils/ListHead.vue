<template>
  <a-row :style="{marginBottom: '20px', marginTop: '10px'}"
         :gutter="[10, 10]">

    <a-col :span="24" >
      <a-row align="middle">

        <a-col flex="auto" >
          <h1 style="text-align: left">{{ title }}</h1>
        </a-col>

        <a-col :span="24" :md="12" :lg="10" style=" text-align: end;">
          <a-row :gutter="[10, 10]" align="end" >

            <a-col :xs="24" :sm="12">
              <a-button
                  class="button-option"
                  v-if="showRefresh"
                  :loading="loadingRefresh"
                  @click="onRefresh">
                <ReloadOutlined v-if="!loadingRefresh"/>
                Actualiser
              </a-button>
            </a-col>

            <a-col :xs="24" :sm="12" v-if="showAdd">
              <a-button
                  class="button-option"
                  type="primary"
                  @click="onNew">
                <PlusOutlined/>
                Nouveau
              </a-button>
            </a-col>

          </a-row>
        </a-col>

      </a-row>
    </a-col>

    <a-col :span="24" v-if="showSearch">
      <a-input-search
          v-model:value="search"
          placeholder="Recherche"
          :loading="loadingSearch"
          enter-button
          @search="onSearch"
          size="large"
      />
    </a-col>

  </a-row>

</template>

<script setup>
import { PlusOutlined, ReloadOutlined } from '@ant-design/icons-vue'
import {watch} from "vue";

const search = defineModel('searchValue')
const loadingSearch = defineModel('loadingSearch')
const loadingRefresh = defineModel('loadingRefresh')
const props = defineProps({
  title: String,
  showSearch: {
    type: Boolean,
    default: true
  },
  showRefresh: {
    type: Boolean,
    default: true
  },
  showAdd: {
    type: Boolean,
    default: true
  },
})

const emit = defineEmits(['onRefresh', 'onSearch', 'onNew'])

watch(search, (value, oldValue) => {
  if(value === ''){
    emit('onRefresh')
  }
})

function onRefresh(){
  loadingRefresh.value = true;
  emit('onRefresh')
}

function onSearch(){
  if(search.value){
    loadingSearch.value = true;
    emit('onSearch')
  }
}

function onNew(){
  emit('onNew')
}

</script>

<style>

.button-option{
  width: 100%;
}

</style>