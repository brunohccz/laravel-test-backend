import axios from "axios";

export const NATURAL_PERSON = 0;

export const LEGAL_PERSON = 1;

export const fetch = async () => {
    return await axios.get("/api/customers");
};

export const store = async form => {
    return await form.post("/api/customers");
};

export const destroy = async id => {
    return await axios.delete(`/api/customers/${id}`);
};

export default { fetch, store, destroy, NATURAL_PERSON, LEGAL_PERSON };
