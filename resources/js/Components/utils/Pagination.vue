<template>
  <div class="d-flex justify-content-center align-items-center" v-if="pageCount > 1">
    <div class="pagination">
      <button type="button" class="btn-prev"
              @click="curentPage = curentPage - 1"
              :disabled="curentPage === 1">
        <i class="fa-solid fa-arrow-left"></i>
      </button>

      <ul class="ul-link">
        <li v-for="index in pageCount" :key="index"
            :class="`${index === curentPage ? 'link active' : 'link'}`"
            @click="curentPage = index">
          {{ index }}
        </li>
      </ul>

      <button type="button" class="btn-next"
              @click="curentPage = curentPage + 1"
              :disabled="curentPage === pageCount">
        <i class="fa-solid fa-arrow-right"></i>
      </button>
    </div>
  </div>
</template>

<script setup>

import {ref, watch} from "vue";

const curentPage = ref(1)
const props = defineProps({
  pageCount: {
    type: Number,
    default: 1
  },
  scroolTo: String
})
const emit = defineEmits(['onChange'])

watch(curentPage, (value, oldValue) => {
  if(value) {
    emit('onChange', value)
    if(props.scroolTo){
      document.getElementById(props.scroolTo).scrollIntoView({behavior: 'smooth'})
    }
  }
})

</script>

<style scoped>

.pagination .btn-prev,
.pagination .btn-next {
  color: #6AA98B;
  font-weight: 500;
  text-align: center;
  display: inline-block;
  cursor: pointer;
  font-size: 25px;
  position: relative;
  box-shadow: none;
  border: none;
  background: none;
  vertical-align: middle;
  padding: 14px 30px;
  overflow: hidden;
  transition: all 0.3s ease;
}

.list-card-pdf .pagination {
  display: flex;
  width: 600px;
  height: 114px;
  margin-top: 150px;
  justify-content: center;
  justify-content: space-between;
  align-items: center;
}

.pagination .btn-prev:enabled:hover,
.pagination .btn-next:enabled:hover {
  color: var(--color-green);
  transform: scale(1.2);
}

.pagination .btn-prev:disabled,
.pagination .btn-next:disabled {
  color: var(--color-gris);
}

.ul-link {
  margin: 20px 30px;
}

.ul-link .link {
  display: inline-block;
  margin:  0 10px;
  background-color: #6AA98B;
  color: var(--color-white);
  width: 45px;
  height: 45px;
  border-radius: 50%;
  text-align: center;
  font-size: 22px;
  font-weight: 500;
  line-height: 45px;
  cursor: pointer;
  transition: all ease .3s;
}

.ul-link .active {
  color: var(--color-white);
  background: var(--color-green);
  transform: scale(1.2);
}

</style>