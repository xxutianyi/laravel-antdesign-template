import {Logo} from "@/Components/Logo";
import {Space} from "antd";
import AppLayout from "@/Layouts/AppLayout";
import {PageContainer} from "@ant-design/pro-layout";
import {ProCard} from "@ant-design/pro-components";

export default function () {
    return (
        <AppLayout>
            <PageContainer>
                <ProCard>
                    <Space direction={"vertical"} className="w-full text-center">
                        <Logo className="w-32 mx-auto mb-4 fill-brand"/>
                        <a href="https://www.hiculture.com.cn/">
                            <p className="text-sm text-gray-800">&copy;上海认识一下文化发展有限公司</p>
                        </a>
                        <a href="https://beian.miit.gov.cn/">
                            <p className="text-sm text-gray-800">沪ICP备2021035845号</p>
                        </a>
                    </Space>
                </ProCard>
            </PageContainer>
        </AppLayout>
    )
}
