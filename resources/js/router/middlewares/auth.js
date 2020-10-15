import store from "@/store";

export default async ({ next, router }) => {
    if (!store.getters["auth/authenticated"]) {
        return router.push({ name: "login" });
    } else {
        next();
    }
};
