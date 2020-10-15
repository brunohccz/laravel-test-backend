import axios from "axios";

export const fetch = async () => {
    return await axios.get("/api/properties/features/types");
};

export const store = async form => {
    return await form.post("/api/properties/features/types");
};

export default { fetch, store };
