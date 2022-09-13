import React, {ReactNode} from 'react';
import {Head} from "@inertiajs/inertia-react";
import {Layout} from "antd";

export default function FullScreenLayout(props: { title: string, children: ReactNode }) {
    return (
        <>
            <Head>
                <title>{props.title + " - HiCulture ERP"}</title>
            </Head>
            <Layout className="h-screen flex">
                <div className="m-auto flex">
                    {props.children}
                </div>
            </Layout>
        </>
    )
}
