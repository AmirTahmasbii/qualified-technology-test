<template>
    <Editor
      v-model="modelValue"
      :init="editorInit"
      @blur="onBlur"
    />
  </template>
  
  <script setup>
  import { Editor } from '@tinymce/tinymce-vue';
  import { defineProps, defineEmits } from 'vue';
  
  const props = defineProps({
    modelValue: String,
  });
  const emit = defineEmits(['update:modelValue']);
  
  const onBlur = (e) => {
    emit('update:modelValue', e.target.getContent());
  };
  
  const editorInit = {
    height: 300,
    menubar: false,
    plugins: 'link image code lists',
    toolbar: 'undo redo | bold italic underline | bullist numlist | link image | code',
    branding: false,
    promotion: false,
    content_style: "body { font-family:Helvetica,Arial,sans-serif; font-size:14px }",
  };
  </script>
  