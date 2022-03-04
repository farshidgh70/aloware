<template>
    <div class="new_comments__post" id="new_comments__post">
        <div class="form-floating mb-2">
            <input
                v-model="formData.name"
                placeholder="Enter your name here ..."
                class="w-100 mb-2 form-control"
                id="name"
            />
            <label for="name">Name:</label>
        </div>
        <div class="form-floating mb-2">
            <textarea
                v-model="formData.content"
                :placeholder="placeholder"
                rows="10"
                class="w-100 form-control"
                style="height: 250px"
            ></textarea>
            <label for="name">Name:</label>
        </div>

        <div class="mb-5">
            <button
                v-if="showCancelBtn"
                @click.stop="
                    $store.commit(
                        'comment/SET_NEW_COMMENTS_SELECTED_REPLY',
                        null
                    )
                "
                class="btn btn-secondary"
                type="button"
            >
                Cancel
            </button>
            <button @click="submit" class="btn btn-primary" type="button">
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
            fd.append("name", this.formData.name);
            fd.append("content", this.formData.content);
            fd.append("parent", this.parent);
            fd.append("type", this.type);
            const res = await axios.post(`/api/comments/new`, fd);
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
