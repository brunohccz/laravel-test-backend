import auth from "@/router/middlewares/auth";

import Home from "@/views/Home";
import Login from "@/views/Auth/Login";
import Properties from "@/views/Property/Index";
import PropertyCreate from "@/views/Property/Create";
import Customers from "@/views/Customer/Index";
import Contracts from "@/views/Contract/Index";

const routes = [
    {
        path: "/",
        name: "home",
        component: Home,
        meta: {
            middleware: auth
        }
    },
    {
        path: "/properties",
        name: "properties",
        component: Properties,
        meta: {
            middleware: auth
        }
    },
    {
        path: "/properties/create",
        name: "properties.create",
        component: PropertyCreate,
        meta: {
            middleware: auth
        }
    },
    {
        path: "/customers",
        name: "customers",
        component: Customers,
        meta: {
            middleware: auth
        }
    },
    {
        path: "/contracts",
        name: "contracts",
        component: Contracts,
        meta: {
            middleware: auth
        }
    },
    {
        path: "/login",
        name: "login",
        component: Login
    }
];

export default routes;
