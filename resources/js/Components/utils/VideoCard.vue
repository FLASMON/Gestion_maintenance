<template>
    <div class="single-post-area mb-80">
      <div class="post-thumbnail">
        <img :src="image" alt="" class="video-box">
        <a :href="`/video/${yid}`" class="glightbox play-btn mb-4"></a>
        <span class="video-duration">{{ dure }}</span>
      </div>
      <div class="post-content">
        <div class="btn-tag_date">
          <a href="#" class="post-tag tag-sm tag-success">{{ category }}</a>
          <span><i class="fa-solid fa-calendar-days" aria-hidden="true"></i> {{ date }}</span>
        </div>
        <a :href="`/video/${yid}`" class="post-title">
          {{ title }}
        </a>
        <div class="post-descript">
         <p style="white-space: pre-wrap;">{{ description }}</p>
        </div>
      </div>
    </div>
</template>
<script setup>

const props = defineProps({
    title: String,
    description: String,
    date: String,
    dure: String,
    image: String,
    yid: String,
    category: String
})

</script>
<style lang="">
    
</style>