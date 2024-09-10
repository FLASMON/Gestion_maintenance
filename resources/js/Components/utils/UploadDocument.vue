<template>
  <a-upload
      :action="`${apiHost}/api/upload/documents`"
      :multiple="false"
      accept="application/pdf, application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
      @change="handleChange"
      list-type="picture"
      :headers="{ authorization: `Bearer ${token}` }"
      :maxCount="1"
      @remove="onRemove"
  >

    <a-button style="margin-bottom: 10px">
      <UploadOutlined />
      {{file_url ? 'Modifier le fichier' : 'Séléctioner fichier'}}
    </a-button>

  </a-upload>
</template>

<script setup>

import {inject, onMounted, ref, watch} from "vue";
import { UploadOutlined } from '@ant-design/icons-vue'
import {JwtToken} from "../../composables/JwtToken.js";
import {message, notification} from "ant-design-vue";

const fileList = ref([])
const apiHost = inject('apiHost');
const file_url = defineModel('value')
const token = JwtToken.getToken()

const handleChange = (info) => {
  const status = info.file.status
  if(status === 'done'){
    file_url.value = info.file.response.url
  }
  else if(status === 'error'){
    file_url.value = ''
    notification.error({
      message: "Erreur de téléchargement de fichier",
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