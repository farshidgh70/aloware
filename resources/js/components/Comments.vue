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
            v-if="!$store.state.new_comments_selected_reply"
            :type="type"
            :parent="parent"
            :objectId="objectId"
            ref="comments_post"
            @newPost="refreshItems"
            RoundButton
        />

        <CommentsItems
            ref="comments_items"
            :type="type"
            :objectId="objectId"
            class="mt2"
        />
        {{ objectId }}
    </div>
</template>
<script>
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
        RoundButton: {
            type: Boolean,
            default: false,
        },
    },
    data: () => ({
        parent: 0,
    }),
    methods: {
        refreshItems() {
            this.$refs.comments_items.fetch();
        },
    },
};
</script>
