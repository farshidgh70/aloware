<template>
    <div class="new_comment" :id="`new_comment_${item.id}`">
        <div class="new_comment__item">
            <div class="new_comment__avatar">
                <img :src="item.user.avatar" alt="" />
            </div>
            <div class="new_comment__content_block">
                <div class="new_comment__header">
                    <div class="new_comment__header__title">
                        {{ item.user.name }}
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
                            <!-- <v-icon>mdi-reply</v-icon> -->
                            Answer
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
            <NewCommentsItems
                :items="item.children"
                :type="type"
                :objectId="objectId"
            />
        </div>
    </div>
</template>
<script>
import CommentsPost from "./CommentsPost";
import CommentsItems from "./CommentsItems";
export default {
    name: "CommentsItem",
    components: { CommentsPost, CommentsItems },
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
        font-family: vazir;
    }
    &__avatar {
        width: 10%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #ccc;
        border-radius: 50%;
        margin: 0 0 0 10px;
        width: 50px;
        height: 50px;
        // max-width: 50px;
        // max-height: 50px;
        img {
            width: 100%;
            border-radius: 50%;
        }
    }
    &__header {
        display: flex;
        &__time {
            margin-right: auto;
            font-family: IS;
            font-size: 12px;
        }
        &__title {
            font-weight: bold;
        }
    }
    &__footer {
        display: flex;
        &__like {
            margin-right: auto;
            display: flex;
            align-items: center;
            margin-left: 10px;
            font-family: IS;
            font-size: 12px;
            // color: red;
        }
        &__dislike {
            display: flex;
            align-items: center;
            font-family: IS;
            color: red;
        }
        &__reply {
            font-size: 12px;
            cursor: pointer;
            &:hover {
                color: #a50034;
            }
            div {
                display: flex;
                align-items: center;
            }
        }
    }
    &__children {
        padding-right: 30px;
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
