export const module_comment = {
    namespaced: true,

    state: {
        new_comments_selected_reply: null,
        new_comments_dialog_login: false,
    },

    getters: {},

    mutations: {
        SET_NEW_COMMENTS_SELECTED_REPLY: (state, payload) => {
            state.new_comments_selected_reply = payload;
        },
        SET_NEW_COMMENTS_DIALOG_LOGIN: (state, payload) => {
            state.new_comments_dialog_login = payload;
        },
    },

    actions: {},
};
