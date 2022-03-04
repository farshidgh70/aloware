<template>
    <div class="new_comments">
        <CommentsItem
            v-for="(item, i) in finalItems"
            :item="item"
            :key="i"
            :type="type"
            :objectId="objectId"
        />
    </div>
</template>
<script>
import axios from "axios";
import CommentsItem from "./CommentsItem";
export default {
    name: "CommentsItems",
    components: { CommentsItem },
    props: {
        type: {
            type: String,
            required: true,
        },
        objectId: {
            type: Number,
            default: 0,
        },
    },
    mounted() {
        this.fetch();
    },
    data: () => ({
        finalItems: [],
    }),
    methods: {
        async fetch() {
            const res = await axios.get(`api/comments/items/article`);
            if (res.data.success) {
                this.finalItems = res.result;
            }
        },
    },
    watch: {
        items(val, old) {
            if (val.length !== old.length) {
                this.finalItems = val;
            }
        },
    },
};
</script>
