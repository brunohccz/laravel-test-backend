import axios from "axios";

export const fetch = async () => {
    return await axios.get("/api/properties");
};

export const store = async form => {
    return await form.post("/api/properties");
};

export const destroy = async id => {
    return await axios.delete(`/api/properties/${id}`);
};

export default { fetch, store, destroy };
