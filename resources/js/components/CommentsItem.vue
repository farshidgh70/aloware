<template>
    <div class="new_comment" :id="`new_comment_${item.id}`">
        <div class="new_comment__item">
            <div class="new_comment__avatar">
                <strong>{{ item.name.charAt(1).toUpperCase() }}</strong>
            </div>
            <div class="new_comment__content_block">
                <div class="new_comment__header">
                    <div class="new_comment__header__title">
                        {{ item.name }}
                    </div>
                    <div class="new_comment__header__time"></div>
                </div>
                <div class="new_comment__content" v-html="item.content"></div>
                <div class="new_comment__footer">
                    <div
                        class="new_comment__footer__reply"
                        @click="
                            $store.commit(
                                'comment/SET_NEW_COMMENTS_SELECTED_REPLY',
                                item
                            )
                        "
                    >
                        <div
                            v-if="
                                $store.state.comment
                                    .new_comments_selected_reply !== item
                            "
                        >
                            <i class="fa fa-reply" aria-hidden="true"></i>
                            <span class="ml-2">reply</span>
                        </div>
                    </div>
                </div>
                <div>
                    <transition name="fade">
                        <CommentsPost
                            v-if="
                                $store.state.comment
                                    .new_comments_selected_reply === item
                            "
                            :type="type"
                            :parent="item.id"
                            :objectId="objectId"
                            placeholder="your answer to this comment..."
                            showCancelBtn
                        />
                    </transition>
                </div>
            </div>
        </div>
        <div class="new_comment__children" v-if="item.children">
            <CommentsItems
                :items="item.children"
                :type="type"
                :objectId="objectId"
            />
        </div>
    </div>
</template>
<script>
import CommentsPost from "./CommentsPost";
export default {
    name: "CommentsItem",
    components: {
        CommentsPost,
        CommentsItems: () => import("./CommentsItems.vue"),
    },
    props: {
        item: {
            type: Object,
            required: true,
        },
        type: {
            type: String,
            required: true,
        },
        objectId: {
            type: Number,
            default: 0,
        },
    },
};
</script>
<style scoped lang="scss">
.new_comment {
    &__item {
        display: flex;
        align-items: flex-start;
        width: 100%;
    }
    &__content_block {
        width: 90%;
        border-bottom: 1px dashed #ccc;
        padding-bottom: 10px;
    }
    &__content {
        font-size: 14px;
        text-align: justify;
        margin: 10px 0 5px;
    }
    &__avatar {
        width: 10%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #a50034;
        color: white;
        border-radius: 50%;
        margin: 0 10px 0 0;
        width: 50px;
        height: 50px;
        img {
            width: 100%;
            border-radius: 50%;
        }
    }
    &__header {
        display: flex;
        &__time {
            margin-right: auto;
            font-size: 12px;
        }
        &__title {
            font-weight: bold;
        }
    }
    &__footer {
        display: flex;
        &__reply {
            font-size: 12px;
            cursor: pointer;
            margin-right: 10px;
            &:hover {
                color: #a50034;
            }
        }
    }
    &__children {
        padding-left: 30px;
        margin-top: 10px;
        .new_comment__avatar {
            max-width: 40px;
            max-height: 40px;
        }
    }
    .fade-enter-active,
    .fade-leave-active {
        transition: opacity 0.2s;
    }
    .fade-enter,
    .fade-leave-to {
        opacity: 0;
    }
}

@media only screen and (max-width: 480px) {
    .new_comment {
        &__avatar {
            width: 45px;
            height: 45px;
        }
        &__header {
            &__title {
                font-size: 12px;
            }
        }
    }
}
</style>
