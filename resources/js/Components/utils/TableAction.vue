<template>

  <a-dropdown placement="bottomRight" :trigger="['click']">
    <a-button :style="{paddingTop: '0px', paddingBottom: '0px', height: '25px'}">
      <EllipsisOutlined />
    </a-button>

    <template #overlay>
      <a-menu>

        <a-menu-item v-if="view">
          <a-button @click="onView" class="button-action" type="text">
            <EyeOutlined />
            Voir
          </a-button>
        </a-menu-item>

        <a-menu-item v-if="print">
          <a-button @click="onPrint" class="button-action" type="text">
            <PrinterOutlined />
            Imprimer
          </a-button>
        </a-menu-item>

        <a-menu-item v-if="update">
          <a-button @click="onUpdate" class="button-action" type="text">
            <EditOutlined />
            Modifier
          </a-button>
        </a-menu-item>

        <a-menu-item v-if="deletes">
          <a-button @click="onDelete" class="button-action" type="text" danger>
            <DeleteOutlined />
            Supprimer
          </a-button>
        </a-menu-item>

      </a-menu>
    </template>
  </a-dropdown>

</template>

<script setup>
import {
  EllipsisOutlined,
  EditOutlined,
  DeleteOutlined,
  ExclamationCircleOutlined,
  EyeOutlined, CarOutlined,
  PrinterOutlined
} from '@ant-design/icons-vue'
import {createVNode, ref} from "vue";
import {Modal, notification} from "ant-design-vue";
import axios from "axios";

const emit = defineEmits(['onUpdate', 'deleteSuccess', 'onView', 'onPrint']);
const props = defineProps({
  deleteContent: String,
  deleteRoot: String,
  update: {
    type: Boolean,
    default: true
  },
  deletes: {
    type: Boolean,
    default: true
  },
  view: {
    type: Boolean,
    default: false
  },
  print: {
    type: Boolean,
    default: false
  },
})
const visible = ref(false)

function onUpdate(){
  visible.value = false;
  emit('onUpdate')
}

function onVariant() {
  emit('onVariation')
}

function onView() {
  emit('onView')
}

function onLivrer(){
  emit('onLivrer')
}

function onPrint(){
  emit('onPrint')
}

function onDelete(){
  visible.value = false;
  Modal.confirm({
    title: 'Etes vous sur de vouloir supprimer ?',
    icon: createVNode(ExclamationCircleOutlined),
    content: props.deleteContent,
    okText: 'Supprimer',
    okType: 'danger',
    cancelText: 'Annuler',
    onOk() {
      return new Promise((resolve, reject) => {
        axios.delete(`${props.deleteRoot}`)
          .then((data) => {
            resolve()
            emit('deleteSuccess');
            notification.success({
              message: 'Suppression succès',
              placement: "bottomRight"
            })
          })
          .catch((error) => {
            reject()
            notification.success({
              message: 'Erreur survenue :(',
              placement: "bottomRight"
            })
          })
      }).catch(() => console.log("Error"))
    },
    onCancel() {

    },
  });
}

</script>

<style>

.button-action{
  width: 100%;
  text-align: left;
  border-radius: 0px;
}

.ant-dropdown-menu{
  padding: 10px 0px !important;
}

.ant-dropdown-menu-item{
  padding: 0px !important;
  border-radius: 0px !important;
}

</style>