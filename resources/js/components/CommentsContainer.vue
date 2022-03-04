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
        <NewCommentsPost
            v-if="!$store.state.new_comments_selected_reply"
            :type="type"
            :parent="parent"
            :objectId="objectId"
            ref="new_comments_post"
            @newPost="refreshItems"
            RoundButton
        />

        <NewCommentsItems
            :items="items"
            ref="new_comments_items"
            :type="type"
            :objectId="objectId"
            class="mt2"
        />
    </div>
</template>
<script>
export default {
    props: {
        objectId: {
            type: Number,
            default: 0,
        },
        items: {
            type: Array,
            default: () => [],
        },
        type: {
            type: String,
            required: true,
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
            this.$refs.new_comments_items.fetch();
        },
    },
};
</script>
