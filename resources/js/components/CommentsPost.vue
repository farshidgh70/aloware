<template>
    <div class="new_comments__post" id="new_comments__post">
        <textarea
            v-model="formData.content"
            :placeholder="placeholder"
            rows="10"
        />
        <div>
            <button
                v-if="showCancelBtn"
                @click.stop="
                    $store.commit(
                        'comment/SET_NEW_COMMENTS_SELECTED_REPLY',
                        null
                    )
                "
            >
                Cancel
            </button>
            <button @click="submit">
                <strong>Send</strong>
            </button>
        </div>
    </div>
</template>
<script>
import axios from "axios";
export default {
    props: {
        objectId: {
            type: Number,
            default: 0,
        },
        parent: {
            type: Number,
            default: 0,
        },
        type: {
            type: String,
            required: true,
        },
        placeholder: {
            type: String,
            default: "Share your comment ...",
        },
        showCancelBtn: {
            type: Boolean,
            default: false,
        },
    },
    data: () => ({
        formData: {
            name: "",
            content: "",
        },
        loading: false,
    }),
    methods: {
        async submit() {
            this.loading = true;
            let fd = new FormData();
            fd.append("o", this.objectId);
            fd.append("content", this.formData.content);
            fd.append("parent", this.parent);
            fd.append("type", this.type);
            const res = await axios.post(`api/comments/new`, fd);
            if (res.data.success) {
                this.formData.content = "";
                alert("success");
                this.$store.commit(
                    "comment/SET_NEW_COMMENTS_SELECTED_REPLY",
                    null
                );
                this.$emit("newPost");
            } else {
                alert(res.data.message);
            }
            this.loading = false;
        },
    },
};
</script>
