<template>
    <div class="new_comments__container" id="new_comments">
        <div class="d-flex align-items-center">
            <slot name="labelnewcomment"></slot>
            <label
                for="new_comments"
                class="fs20"
                v-if="!$slots.labelnewcomment"
            >
                Your comment:
            </label>
        </div>
        <CommentsPost
            v-if="!$store.state.comment.new_comments_selected_reply"
            :type="type"
            :parent="parent"
            :objectId="objectId"
            ref="comments_post"
            @newPost="fetch"
        />

        <CommentsItems
            ref="comments_items"
            :type="type"
            :objectId="objectId"
            class="mt2"
            :items="items"
        />
    </div>
</template>
<script>
import axios from "axios";
import CommentsPost from "./CommentsPost";
import CommentsItems from "./CommentsItems";
export default {
    components: { CommentsPost, CommentsItems },
    props: {
        objectId: {
            type: Number,
            default: 0,
        },
        type: {
            type: String,
            default: "article",
        },
    },
    data: () => ({
        parent: 0,
        items: [],
    }),
    mounted() {
        this.fetch();
    },
    methods: {
        async fetch() {
            const res = await axios.get(
                `/api/comments/items/${this.type}/${this.objectId}`
            );
            if (res.data.success) {
                this.items = res.data.result;
            }
        },
    },
};
</script>
