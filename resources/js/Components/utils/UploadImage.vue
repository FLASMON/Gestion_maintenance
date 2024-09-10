<template>

  <a-card style="width: 100%;">
    <template #cover>
      <div style="display: flex">
        <a-image
            width="100%"
            style="border-radius: 3px; object-fit: cover;"
            :height="height"
            fallback="/img/placeholder/image.png"
            :src="file_url ?? ''" />
<!--        <a-upload-->
<!--            :action="`${axios.defaults.baseURL}/upload/images`"-->
<!--            :multiple="false"-->
<!--            accept="image/png, image/jpeg"-->
<!--            @change="handleChange"-->
<!--            :headers="{ authorization: `Bearer ${token}` }"-->
<!--            list-type="picture"-->
<!--            :maxCount="1"-->
<!--            :show-upload-list="false"-->
<!--            @remove="onRemove"-->
<!--            style="position: absolute; bottom: 10px; right: 10px;"-->
<!--        >-->
            <a-upload
            :action="`${axios.defaults.baseURL}/upload/images`"
            :multiple="false"
            accept="image/png, image/jpeg"
            @change="handleChange"
            :headers="{ authorization: `Bearer ${token}` }"
            list-type="picture"
            :maxCount="1"
            :show-upload-list="false"
            @remove="onRemove"
            style="position: absolute; bottom: 10px; right: 10px;"
        >
          <a-button :loading="loading" style="width: 50px; height: 50px; border-radius: 50%;">
            <div  v-if="!loading">
              <EditOutlined v-if="file_url"/>
              <PlusOutlined v-else/>
            </div>
          </a-button>
        </a-upload>
      </div>
    </template>
  </a-card>
</template>

<script setup>
import { ref, watch} from "vue";
import { UploadOutlined, EditOutlined, PlusOutlined } from '@ant-design/icons-vue'
// import {JwtToken} from "../../composables/JwtToken.js";
import { notification} from "ant-design-vue";
import axios from "axios";

const loading = ref(false)
const file_url = defineModel('value')
// const token = JwtToken.getToken()

const props = defineProps({
  height: {
    type: Number,
    default: 300
  }
})

watch(file_url, (value, oldValue) => {
  if (value) {

  }
})

const handleChange = (info) => {
  const status = info.file.status
  if(status === 'uploading'){
    loading.value = true
  }
  else if(status === 'done'){
    file_url.value = info.file.response.url
    loading.value = false
  }
  else if(status === 'error'){
    file_url.value = ''
    loading.value = false
    notification.error({
      message: "Erreur de téléchargement d'image",
      placement: "bottomRight"
    })
  }
}

const onRemove = () => {
  file_url.value = ''
}

</script>

<style scoped>

</style>
