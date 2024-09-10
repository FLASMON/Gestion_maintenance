<template>
  <div class="clearfix">

    <a-upload
        :action="`${axios.defaults.baseURL}/upload/images`"
        @change="handleChange"
        accept="image/png, image/jpeg"
        :headers="{ authorization: `Bearer ${token}` }"
        :show-upload-list="false"
        multiple
    >
      <a-button class="py-3">
        <plus-outlined />
        <span>Ajouter</span>
      </a-button>
    </a-upload>

    <div style="display: flex; flex-direction: column;">
      <div class="list-item" v-for="file in fileList">
        <div style="display: flex; align-items: center;width: 100px; height: 100px;" v-if="!file.url">
          <LoadingOutlined style="margin-left: auto; margin-right: auto" />
        </div>
        <a-image v-else style="width: 100px; height: 100px; object-fit: cover;" :src="file.url" />
        <a-textarea
            v-model:value="file.description"
            style="width: 100%"
            :auto-size="{ minRows: 3, maxRows: 3}"
            :bordered="false"
            placeholder="tapez ici la description de l'image"
            :show-count="false"
        />
        <a-button type="primary" style="background-color: #cc0000"  @click="removeItem(file.uid)">
          <DeleteOutlined />
        </a-button>
      </div>
    </div>

  </div>
</template>

<script setup>
import axios from 'axios';
import {PlusOutlined, LoadingOutlined} from '@ant-design/icons-vue';
import {JwtToken} from "../../composables/JwtToken.js";
import {DeleteOutlined} from '@ant-design/icons-vue';

const token = JwtToken.getToken()
const fileList = defineModel('value', {
  type: Array,
  default: []
});

const handleChange = (info) => {
  if(info.file.status === "uploading" && info.file.percent === 0){
      fileList.value.push({
        uid: info.file.uid,
        url: null,
        description: null,
      });
  }
  else if(info.file.status === "done"){
    fileList.value.find(f => f.uid === info.file.uid).url = info.file.response.url
  }
  else if(info.file.status === "error"){
    removeItem(info.file.uid)
  }
}

const removeItem = (uid) => {
  const index = fileList.value.indexOf(fileList.value.find(f => f.uid === uid));
  fileList.value.splice(index, 1)
}

</script>

<style>
/* you can make up upload button and sample style by using stylesheets */
.ant-upload-select-picture-card i {
  font-size: 32px;
  color: #999;
}

.ant-upload-select-picture-card .ant-upload-text {
  margin-top: 8px;
  color: #666;
}

.list-item{
  margin: 10px 0px;
  padding: 10px;
  border-style: solid;
  border-width: 1px !important;
  border-color: #eee !important;
  border-radius: 3px;
  display: flex;
  gap: 10px;
  align-items: center;
}

.list-item .ant-input-textarea-show-count::after{
  display: none !important;
}

</style>