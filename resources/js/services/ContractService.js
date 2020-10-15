import axios from "axios";

export const fetch = async () => {
    return await axios.get("/api/contracts");
};

export const store = async form => {
    return await form.post("/api/contracts");
};

export const destroy = async id => {
    return await axios.delete(`/api/contracts/${id}`);
};

export default { fetch, store, destroy };
