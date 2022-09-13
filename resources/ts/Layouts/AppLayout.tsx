import {DashboardOutlined, SmileOutlined,} from "@ant-design/icons";
import React, {ReactNode} from "react";
import {ProLayout} from "@ant-design/pro-components";
import {LogoSquare} from "@/Components/Logo";
import AvatarDropdown from "@/Components/AvatarDropdown";
import {InertiaLink} from "@inertiajs/inertia-react";
import {Route} from "@ant-design/pro-layout/es/typings";

export default function AppLayout(props: { children: ReactNode }) {

    const menuRoute: Route = {
        path: '/',
        routes: [
            {
                path: '/welcome',
                name: '欢迎',
                icon: <SmileOutlined/>,
            },
            {
                path: '/dashboard',
                name: '控制台',
                icon: <DashboardOutlined/>,
            },
        ],
    }

    return (
        <ProLayout
            title={"管理平台"}
            logo={<LogoSquare className={"h-8 w-8 fill-brand"}/>}
            layout={'mix'}
            navTheme={'light'}
            fixedHeader={true}
            fixSiderbar={true}
            splitMenus={true}
            route={menuRoute}
            menuItemRender={(item, dom) => {
                return item.isUrl
                    ? <a href={item.path as string}>{dom}</a>
                    : <InertiaLink href={item.path as string}>{dom}</InertiaLink>
            }}
            breadcrumbProps={{
                itemRender: (route) => (
                    <InertiaLink href={route.path}>{route.breadcrumbName}</InertiaLink>
                )
            }}
            actionsRender={() => [
                <AvatarDropdown/>
            ]}
        >
            {props.children}
        </ProLayout>
    )
}
