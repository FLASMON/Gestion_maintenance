<template>
    <Editor
        id="app-editor"
        api-key="no-api-key"
        v-model:model-value="editorValue"
        :plugins="[
      'advlist', 'link', 'lists', 'charmap', 'searchreplace', 'wordcount', 'table', 'emoticons', 'image'
    ]"
        toolbar="undo redo |  bold italic underline strikethrough superscript subscript code
      | forecolor backcolor | alignleft aligncenter alignright alignjustify
      | bullist numlist | outdent indent | link charmap | table | image"
        :init="{
        menubar: false,
        toolbar_mode: 'sliding',
        skin: false,
        statusbar: false,
        content_css: '/css/text-editor.css',
        images_upload_handler: handleImageUpload
      }"

    />
</template>

<script setup>
import { ref } from 'vue';
import 'tinymce/tinymce';
import 'tinymce/icons/default/icons';
import 'tinymce/themes/silver/theme';
import 'tinymce/models/dom/model';
import 'tinymce/plugins/lists/plugin';
import 'tinymce/plugins/link/plugin';
import 'tinymce/plugins/table/plugin';
import 'tinymce/plugins/wordcount/plugin';
import 'tinymce/plugins/advlist/plugin';
import 'tinymce/plugins/charmap/plugin';
import 'tinymce/plugins/emoticons/plugin';
import 'tinymce/plugins/emoticons/js/emojis';
import 'tinymce/plugins/searchreplace/plugin';
import 'tinymce/plugins/image/plugin';
import 'tinymce/skins/ui/oxide/skin.css';
import 'tinymce/skins/ui/oxide/content.css';
import Editor from '@tinymce/tinymce-vue';

const editorValue = defineModel('value')

</script>

<style>

.tox-tinymce {
    border: 2px solid #eeeeee;
    border-radius: 3px;
}

.tox-editor-header {
    box-shadow: none !important;
}

</style>
