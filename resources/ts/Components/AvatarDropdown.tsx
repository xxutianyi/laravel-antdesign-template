import {Avatar, Dropdown, Menu} from "antd";
import {LogoutOutlined} from "@ant-design/icons";
import {usePage} from "@inertiajs/inertia-react";
import route from "ziggy-js";
import {Inertia} from "@inertiajs/inertia";
import {User} from "@/types";

export default function () {

    const {user} = usePage().props.auth as { user: User };

    const {wecom} = usePage().props.env as { wecom: boolean };

    const avatar = user ? (user.name).substr(0, 1).toUpperCase() : "U"

    const menuItem = [
        {
            key: route('login.destroy'),
            label: "退出登录",
            icon: <LogoutOutlined/>,
            disabled: wecom
        },
    ]

    const menuClick = (props: { key: string }) => {
        Inertia.get(props.key);
    }

    const menu = (
        <Menu
            items={menuItem}
            onClick={menuClick}
        />
    );

    return (
        <Dropdown overlay={menu} placement="bottomRight" trigger={['click']}>
            <Avatar className="my-auto" style={{color: '#ffffff', backgroundColor: '#ff4539'}}>{avatar}</Avatar>
        </Dropdown>
    )
}
