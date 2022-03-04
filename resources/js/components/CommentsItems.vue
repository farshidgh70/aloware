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
        items: {
            type: Array,
            default: () => [],
        },
    },
    data: () => ({
        finalItems: [],
    }),
    mounted() {
        this.finalItems = this.items;
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
