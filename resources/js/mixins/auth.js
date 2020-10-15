import { mapGetters } from "vuex";

export default {
    computed: {
        ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user"
        })
    }
};
