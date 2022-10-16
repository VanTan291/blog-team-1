<template src="./edit.html"></template>

<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import { mapActions, mapGetters } from 'vuex';
import { utils } from '../../../../helper/function'

export default {
    name: 'blog',
    data() {
        return {
            listTagOption: [],
            listSeriesOption: [],
            editor: ClassicEditor,
            editorData: '',
            editorConfig: {},
            loader: false,
            isDisable: false,
        };
    },
    mixins: [utils],
    async mounted() {
        await this.listSeries();
        await this.listCategories();
        await this.listTag();
        await this.editBlog(this.$route.params.id);
        this.listTagOption = this.params.tags;
        this.listSeriesOption = this.params.series;
    },
    computed: {
        ...mapGetters({
            series: 'Blog/listSeries',
            categories: 'Category/listCategory',
            tags: 'Tag/listTag',
            params: 'Blog/params',
            errorRequest: 'Blog/errorRequest',
        })
    },
    methods: {
        ...mapActions({
            listSeries: 'Blog/getListSeries',
            listCategories: 'Category/getListCategory',
            listTag: 'Tag/getListTag',
            updateBlog: 'Blog/update',
            editBlog: 'Blog/edit'
        }),
        addSeries(newSeries) {
            const item = {
                id: '',
                title: newSeries,
                user_id: ''
            };
            this.series.push(item);
            this.listSeriesOption = item;
        },
        addTag(newTag) {
            alert('ss');
            const item = {
                id: '',
                name: newTag,
                status: 1
            }
            this.tags.push(item);
            this.listTagOption.push(item);
        },
        uploadFile() {
            this.params.thumbnail = this.$refs.thumbnail.files[0];
        },
        async update() {
            console.log(this.listSeriesOption.title);
            this.loader = true;
            this.isDisable = true;
            this.params.tag = this.listTagOption;
            this.params.series = this.listSeriesOption.title;
            this.params.id = this.$route.params.id;

            await this.updateBlog(this.params).then(result => {
                    if (result.code == 200) {
                        this.$router.push({ name: 'blog' });
                        this.toastSuccess(result.message);
                        window.location.reload();
                    }

                    this.loader = false;
                    this.isDisable = false;
                })
                .catch(error => {
                    this.unverifiedEmail = true;
                    this.loader = false;
                    this.isDisable = false;
                });
        },
    }
};
</script>
