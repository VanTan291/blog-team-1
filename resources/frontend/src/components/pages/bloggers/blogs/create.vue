<template src="./create.html"></template>

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
    mounted() {
        this.listSeries();
        this.listCategories();
        this.listTag();
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
            storeBlog: 'Blog/store',
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
        async create() {
            this.loader = true;
            this.isDisable = true;
            this.params.tag = this.listTagOption;
            this.params.series = this.listSeriesOption.title;
            await this.storeBlog(this.params).then(result => {
                    if (result.code == 200) {
                        console.log('ss', result);
                        this.toastSuccess(result.message);
                        this.$router.push({ name: 'blog' });
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
