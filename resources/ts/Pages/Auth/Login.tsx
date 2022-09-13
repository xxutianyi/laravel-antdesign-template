import {Button, Checkbox, Form, Input, message, Space, Tabs} from "antd";
import FullScreenLayout from "@/Layouts/FullScreenLayout";
import {Logo} from "@/Components/Logo";
import {useState} from "react";
import {usePage} from "@inertiajs/inertia-react";
import {Inertia, RequestPayload} from "@inertiajs/inertia";
import route, {RouteParamsWithQueryOverload} from "ziggy-js";
import {LockOutlined, UserOutlined} from "@ant-design/icons";

export default function () {

    const {TabPane} = Tabs;

    const [loading, setLoading] = useState(false);

    const {user_wecom_id} = usePage().props;

    const onFinish = (values: RequestPayload | undefined) => {

        const params = {
            'user_wecom_id': user_wecom_id
        }

        Inertia.post(route('login.store', params as unknown as RouteParamsWithQueryOverload), values, {
            onProgress: () => {
                setLoading(true);
            },
            onError: (errors) => {
                setLoading(false);
                message.error(errors.mobile);
            }
        })
    };

    return (
        <FullScreenLayout title="登录">
            <Space direction="vertical" className="w-full text-center">
                <Logo className="w-32 mx-auto mb-4 fill-brand"/>
                <h1>{user_wecom_id ? "绑定账号" : "业务管理平台"}</h1>
                <Tabs defaultActiveKey="1" centered className="h-80 w-80 mx-auto">
                    <TabPane tab="密码登录" key="1">
                        <Form
                            name="password"
                            initialValues={{
                                remember: true,
                            }}
                            onFinish={onFinish}
                            className="text-left"
                        >
                            <Form.Item
                                name="mobile"
                                rules={[
                                    {
                                        required: true,
                                        message: '请输入手机号',
                                    },
                                ]}
                            >
                                <Input prefix={<UserOutlined/>} placeholder="手机号"/>
                            </Form.Item>
                            <Form.Item
                                name="password"
                                rules={[
                                    {
                                        required: true,
                                        message: '请输入密码',
                                    },
                                ]}
                            >
                                <Input
                                    prefix={<LockOutlined/>}
                                    type="password"
                                    placeholder="密码"
                                />
                            </Form.Item>

                            <Form.Item name="remember" valuePropName="checked">
                                <Checkbox>在此浏览器中自动登录</Checkbox>
                            </Form.Item>

                            <Form.Item>
                                <Button block type="primary" htmlType="submit" loading={loading}>
                                    登录
                                </Button>
                            </Form.Item>
                        </Form>
                    </TabPane>
                </Tabs>
            </Space>
        </FullScreenLayout>
    )
}
