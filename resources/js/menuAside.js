import {mdiAccountCircle, mdiGithub, mdiLock, mdiMonitor, mdiReact, mdiTable, mdiViewList,} from "@mdi/js";

export default [
    {
        route: "dashboard",
        icon: mdiMonitor,
        label: "Dashboard",
    },
    {
        route: "category.index",
        label: "Category",
        icon: mdiTable,
    },
    {
        route: "brand.index",
        label: "Brand",
        icon: mdiTable,
    },
    {
        route: "product.index",
        label: "Product",
        icon: mdiTable,
    },
    {
        route: "order.index",
        label: "Order",
        icon: mdiTable,
    },
    {
        route: "item.index",
        label: "Items",
        icon: mdiTable,
    },
    {
        route: "sales.index",
        label: "Sales",
        icon: mdiTable,
    },
    {
        route: "profile.edit",
        label: "Profile",
        icon: mdiAccountCircle,
    },
    {
        route: "login",
        label: "Login",
        icon: mdiLock,
    },

    {
        label: "Dropdown",
        icon: mdiViewList,
        menu: [
            {
                label: "Item One",
            },
            {
                label: "Item Two",
            },
        ],
    },
    {
        href: "https://github.com/justboil/admin-one-vue-tailwind",
        label: "GitHub",
        icon: mdiGithub,
        target: "_blank",
    },
    {
        href: "https://github.com/justboil/admin-one-react-tailwind",
        label: "React version",
        icon: mdiReact,
        target: "_blank",
    },
];
