<template src="./create.html"></template>

<script>import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

export default {
  name: 'blog',
  data() {
    return {
        value: [
            { name: 'Javascript'}
        ],
        options: [
            { name: 'Vue.js'},
            { name: 'Javascript'},
            { name: 'Open Source'}
        ],
        editor: ClassicEditor,
        editorData: '<b>Content of the editor.</b>',
        editorConfig: {

        }
    };
  },
  methods: {
    addSeries (newSeries) {
      const series = {
        name: newSeries
      }
        this.options.push(series)
        this.value.push(series)
    },
    addCategory (newCategory) {
        const category = {
          name: newCategory
        }
        this.options.push(category)
        this.value.push(category)
    },
    addTag (newTag) {
        const tag = {
            name: newTag,
        }
        this.options.push(tag)
        this.value.push(tag)
    },
  }
};
</script>
