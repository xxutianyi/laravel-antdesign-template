//styles
import 'antd/dist/antd.less';
import '../css/app.css';

import {createInertiaApp} from "@inertiajs/inertia-react";
import {InertiaProgress} from "@inertiajs/progress";

//antd配置
import {ConfigProvider} from "antd";
import zhCN from "antd/lib/locale/zh_CN";

//moment配置
import moment from "moment";
import "moment/locale/zh-cn";

//inertiajs
import React from "react";
import {render} from "react-dom";

InertiaProgress.init({
    color: "#ff4539"
});

moment.locale("zh-cn");


createInertiaApp({
    resolve: name => import(`./Pages/${name}`),
    setup({el, App, props}) {
        render(
            <ConfigProvider locale={zhCN}>
                <App {...props} />
            </ConfigProvider>
            , el);

    },
});
