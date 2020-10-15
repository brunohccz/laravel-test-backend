import axios from "axios";

export const login = async form => {
    await axios.get("/sanctum/csrf-cookie");
    await form.submit("post", "/login");
};

export const logout = async () => {
    await axios.post("/logout");
};

export const me = async () => {
    return await axios.get("/api/user");
};

export default { login, logout, me };
