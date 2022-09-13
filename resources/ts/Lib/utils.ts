import numeral from "numeral";
import {usePage} from "@inertiajs/inertia-react";

const manSize = (size: any) => {
    const unitsList = ['KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB'];

    let unit = 'B';

    let value: numeral.Numeral = numeral(size);

    unitsList.forEach((item) => {
        if (<number>value.value() >= 1024) {
            value = value.divide(1024);
            unit = item;
        }

    });

    return [numeral(value).format('0,0.00'), unit];
}

function useCan(resource: string, permission: string) {
    const {permissions, root} = <{ permissions: string[], root: boolean }>usePage().props.auth;

    return permissions.includes(`${resource}.${permission}`) || permissions.includes(`${resource}.*`) || root
}

export {
    manSize,
    useCan
}
